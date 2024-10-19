<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Racer;
use Illuminate\View\View;
use App\Enums\CurrencyType;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\Wallet\WalletService;

class MarketRacerController extends Controller
{
    public function index(Request $request): View
    {
        $sortColumn1 = $request->sort_column1 ?? 'id';
        $sortDirection1 = $request->sort_direction1 ?? 'asc';
        $sortColumn2 = $request->sort_column2 ?? 'id';
        $sortDirection2 = $request->sort_direction2 ?? 'asc';

        $racersList = Racer::orderBy($sortColumn1, $sortDirection1)
                            ->orderBy($sortColumn2, $sortDirection2)->get();

        $allUsers = User::get();

        return view('market', compact('racersList', 'allUsers'));
    }

    public function buy(Request $request)
    {
        $user = Auth::user();
        $userWallets = $user->wallets;
        $racerId = $request->route('racer_id');

        $walletService = new WalletService;
        $balance = $walletService->getBalance($userWallets);

        $walletUSD = $userWallets->firstWhere('currency_type', CurrencyType::USD->value);

        $racer = Racer::where('id', $racerId);

        try {
            DB::transaction(function () use ($balance, $racer, $walletUSD, $user) {

                if($balance[CurrencyType::USD->value] >= $racer->value('price')) {
                    $walletUSD->transactions()->create([
                        'value' => -$racer->value('price')
                    ]);

                    $racer->update([
                        'user_id' => $user->id
                    ]);
                } else {
                    throw new \Exception('Недостаточно средств');

                }
            });
        } catch (\Exception $exeption) {
            return redirect()->route('market.index')->with('status', 'unsuccessfully purchased');
        }

        return redirect()->route('market.index')->with('status', 'successfully purchased');
    }

    public function sell(Request $request)
    {
        $user = Auth::user();
        $userWallets = $user->wallets;
        $racerId = $request->route('racer_id');

        $walletService = new WalletService;
        $balance = $walletService->getBalance($userWallets);

        $walletUSD = $userWallets->firstWhere('currency_type', CurrencyType::USD->value);

        $racer = Racer::where('id', $racerId);

        try {
            DB::transaction(function () use ($balance, $racer, $walletUSD, $user) {

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
