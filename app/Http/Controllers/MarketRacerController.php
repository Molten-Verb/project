<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Racer;
use Illuminate\View\View;
use App\Enums\CurrencyType;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RacerBuyRequest;
use App\Http\Services\Wallet\WalletService;

class MarketRacerController extends Controller
{
    public function index(Request $request): View
    {
        $sortColumn = $request->query('sort') ?? 'id';
        $sortDirection = $request->query('order')?? 'asc';
        $racersList = Racer::orderBy($sortColumn, $sortDirection)->get();

        $allUsers = User::get();

        return view('market', compact('racersList', 'allUsers'));
    }

    public function buy(Racer $racer, RacerBuyRequest $request)
    {
        $user = Auth::user();
        $walletUSD = $user->neededWallet(CurrencyType::USD);

        $walletService = new WalletService;
        $balanceUSD = $walletService->getWalletBalance($walletUSD);

        $validated = $request->validated([$balanceUSD]);
        dd($validated);

        if ($request->validated())
        try {
            DB::beginTransaction();

                    $walletUSD->transactions()->create([
                        'value' => -$racer->value('price') //убрать, сразу проверить баланс в валидации
                    ]);

                    $racer->update([ // метод atach модели
                        'user_id' => $user->id
                    ]);

                    //throw new \Exception('Недостаточно средств'); //написать rule в реквесте что недостаочно средств

            DB::commit();
        } catch (\Exception $exeption) {
            DB::rollback();
            return redirect()->route('market.index')->with('status', 'unsuccessfully purchased'); //вместмо сообщения перменная с текстом
        }

        return redirect()->route('market.index')->with('status', 'successfully purchased');
    }

    public function sell(Request $request)
    {
        $user = Auth::user();
        $walletUSD = $user->neededWallet(CurrencyType::USD);

        $walletService = new WalletService;
        $balanceUSD = $walletService->getWalletBalance($walletUSD);

        try {
            DB::transaction(function () use ($racer, $walletUSD, $user) {

                if($racer->value('user_id') === $user->id) {
                    $walletUSD->transactions()->create([
                        'value' => $racer->value('price')
                    ]);

                    $racer->update([
                        'user_id' => null
                    ]);
                } else {
                    throw new \Exception('Гонщик не приобритен');
                }
            });
        } catch (\Exception $exeption) {

            return redirect()->route('market.index')->with('status', 'unsuccessfully sold');
        }

        return redirect()->route('market.index')->with('status', 'successfully sold');
    }
}
