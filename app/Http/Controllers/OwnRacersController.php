<?php

namespace App\Http\Controllers;

use App\Enums\CurrencyType;
use App\Models\Racer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OwnRacersController extends Controller
{
    public function index(): View
    {
        $racers = Auth::user()->racers()->get();

        return view('ownRacers', compact('racers'));
    }

    public function sellHalfPrice(Racer $racer, Request $request): RedirectResponse
    {
        $wallet = Auth::user()->neededWallet(CurrencyType::USD);

        DB::transaction(function () use ($wallet, $racer) {
            $wallet
                ->transactions()
                ->create(['value' => ($racer->price / 2)]); // скидка будет меняться, будет брать из config

            $racer->update([
                'user_id' => null,
                'on_market' => true,
            ]);
        });

        return redirect()
            ->route('ownRacers.index')
            ->with('status', 'Successfully sold');
    }

    public function update(Racer $racer, Request $request): RedirectResponse // В реквесте валидируем цену
    {
        $onMarket = false;
        $statusMessage = 'racer not sale';

        if (!$racer->on_market) {
            $onMarket = true;
            $statusMessage = 'racer sale';
        }

        $racer->update(['on_market' => $onMarket]); // ПОЗЖЕ добавить возможность задать цену

        return redirect()->route('ownRacers.index')->with('status', 'ok');
    }
}
