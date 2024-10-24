<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Racer;
use Illuminate\View\View;
use App\Enums\CurrencyType;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RacerBuyRequest;
use App\Http\Services\Wallet\WalletService;

class MarketRacerController extends Controller
{
    public function index(Request $request): View
    {
        $sortColumn = $request->query('sort') ?? 'id';
        $sortDirection = $request->query('order')?? 'asc';
        $racersList = Racer::orderBy($sortColumn, $sortDirection)->get();

        $user = Auth::user();
        $balanceUSD = null;

        if ($user) {
            $balanceUSD = $user->getUserWalletBalance(CurrencyType::USD);
        }

        $allUsers = User::get();

        return view('market', compact('racersList', 'allUsers', 'balanceUSD'));
    }

    public function buy(Racer $racer, RacerBuyRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $walletUSD = $user->neededWallet(CurrencyType::USD);

        try {
            DB::beginTransaction();

                $walletUSD->transactions()->create([
                    'value' => -$racer->price
                ]);

                $racer->update([
                    'user_id' => $user->id
                ]);

            DB::commit();
        } catch (\Exception $exeption) {
            DB::rollback();
        }

        return redirect()->route('market.index')->with('status', 'successfully purchased');
    }

    public function sell(Racer $racer, Request $request): RedirectResponse
    {
        $user = Auth::user();
        $walletUSD = $user->neededWallet(CurrencyType::USD);

        if ($racer->user_id !== $user->id) {
            $statusMessage = 'unsuccessfully sold';
        } else {
            try {
                DB::beginTransaction();

                    $walletUSD->transactions()->create([
                        'value' => $racer->price
                    ]);

                    $racer->update([
                        'user_id' => null
                    ]);

                    DB::commit();
            } catch (\Exception $exeption) {
                DB::rollback();
            }
                $statusMessage = 'successfully sold';
        }

        return redirect()->route('market.index')->with('status', $statusMessage);
    }
}
