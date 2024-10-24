<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Enums\CurrencyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OwnRacersController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $racers = $user->racers()->get();

        return view('OwnRacers', compact('racers'));
    }


    public function sell(Racer $racer, Request $request): RedirectResponse
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
}
