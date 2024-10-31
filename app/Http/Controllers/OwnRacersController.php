<?php

namespace App\Http\Controllers;

use App\Models\Racer;
use Illuminate\View\View;
use App\Enums\CurrencyType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Mail\Racer\RacerSelledHalfPriceMail;

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
        $price = $racer->price * (config('racers.discount') / 100);

        DB::transaction(function () use ($wallet, $racer, $price) {
            $wallet
                ->transactions()
                ->create(['value' => $price]);

            $racer->update([
                'user_id' => null,
                'on_market' => true,
            ]);

            Mail::to(Auth::user())->send(new RacerSelledHalfPriceMail($racer, $price));
        });

        return redirect()
            ->route('ownRacers.index')
            ->with('message', 'Успешно');
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
