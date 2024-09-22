<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\View\View;
use App\Enum\CurrencyType;

use App\Models\Transaction;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($request): View
    {
        $id = Auth::user()->id;

        // Получаем кошельки пользователя
        $userWallets = Wallet::where('user_id', '=', $id)->get();

        $isWalletEuroCreate = $userWallets->firstWhere('currency_type', 'EUR');

        // Получаем суммы по валютам
        $amounts = collect(['RUB', 'USD', 'EUR'])
            ->mapWithKeys(function ($currency) use ($userWallets) {
                $walletId = $userWallets->firstWhere('currency_type', $currency)->id ?? null;
                $amount = $walletId ? Transaction::where('wallet_id', $walletId)->sum('value') : 0;
                return [$currency => $amount];
            });

        $rubleAmount = $amounts['RUB'];
        $dollarAmount = $amounts['USD'];
        $euroAmount = $amounts['EUR'];

        return view('wallet.index', compact('isWalletEuroCreate', 'id', 'rubleAmount', 'dollarAmount', 'euroAmount'));
    }

    public function show(): View
    {
        $id = Auth::user()->id;

        // Получаем кошельки пользователя
        $userWallets = Wallet::where('user_id', '=', $id)->get();

         // Получаем транзакции для каждого кошелька
        $transactions = collect(['RUB', 'USD', 'EUR'])
            ->mapWithKeys(function ($currency) use ($userWallets) {
                $walletId = $userWallets->firstWhere('currency_type', $currency)->id ?? null;
                $transactions = $walletId ? Transaction::where('wallet_id', $walletId)->get() : collect([]);

                return [$currency => $transactions];
            });

        $rubleTransactions = $transactions['RUB'];
        $dollarTransactions = $transactions['USD'];
        $euroTransactions = $transactions['EUR'];

        return view('wallet.show', compact('rubleTransactions', 'dollarTransactions', 'euroTransactions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id = Auth::user()->id;

        Wallet::create([
            'user_id' => $id,
            'currency_type' => CurrencyType::EUR
        ]);

        return redirect()->route('wallet.index', ['id' => $id]);
    }

    public function update(Request $request)
    {
        $id = Auth::user()->id;

        $currency = $request->currency;
        $value = $request->value;

        // Получаем кошелек по валюте
        $wallet = Wallet::where('user_id', $id)->firstWhere('currency_type', $currency);

        Transaction::create([
            'wallet_id' => $wallet->id,
            'value' => $value,
        ]);

        return redirect()->route('wallet.index', ['id' => $id]);
    }
}
