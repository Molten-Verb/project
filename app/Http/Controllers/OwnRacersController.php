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
        $racers = Auth::user()->racers()->paginate(6);

        return view('ownRacers', compact('racers'));
    }

    public function sellHalfPrice(Racer $racer, Request $request): RedirectResponse
    {
        $wallet = Auth::user()->neededWallet(CurrencyType::USD);
        $discount = config('racers.discount') / 100;

        DB::transaction(function () use ($wallet, $racer, $discount) {
            $wallet
                ->transactions()
                ->create(['value' => ($racer->price * $discount)]);

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
