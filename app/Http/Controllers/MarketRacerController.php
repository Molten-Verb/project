<?php

namespace App\Http\Controllers;

use App\Enums\CurrencyType;
use App\Http\Requests\EnoughBalanceRequest;
use App\Mail\Racer\RacerPurchasedMail;
use App\Mail\Racer\RacerSelledFullPriceMail;
use App\Models\Racer;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Spatie\QueryBuilder\QueryBuilder;

class MarketRacerController extends Controller
{
    public function index(Request $request): View
    {
        $racers = QueryBuilder::for(Racer::class)
            ->where('on_market', true)
            ->defaultSort('id')
            ->allowedSorts('id', 'name', 'country', 'price')
            ->paginate(5);

        return view('market', compact('racers'));
    }

    public function buy(Racer $racer, EnoughBalanceRequest $request): RedirectResponse
    {
        $wallet = Auth::user()->neededWallet(CurrencyType::USD);

        DB::transaction(function () use ($wallet, $racer) {
            $wallet
                ->transactions()
                ->create(['value' => -$racer->price]);

            if (!empty($racer->user_id)) { // при покупке пилота принадлежащего пользователю
                Mail::to(User::firstwhere('id', $racer->user_id))
                    ->send(new RacerSelledFullPriceMail($racer));
            }

            $racer->update([
                'user_id' => Auth::user()->id,
                'on_market' => false,
            ]);
        });

        Mail::to(Auth::user())->send(new RacerPurchasedMail($racer));
        //Auth::user()->notify(new RacerPurchasedNotification($racer)); не сработало

        return redirect()->route('market.index')->with('message', 'Успешно');
    }
}
