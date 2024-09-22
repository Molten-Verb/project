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

        $userWallets = Wallet::where('user_id', '=', $id)->get();
        $isWalletEuroCreate = $userWallets->firstWhere('currency_type', 'euro');

        $idRubleWallet = $userWallets->firstWhere('currency_type', 'ruble')->id;
        $idDollarWallet = $userWallets->firstWhere('currency_type', 'dollar')->id;

        $rubleAmount = Transaction::where('wallet_id', '=', $idRubleWallet)->sum('value');
        $dollarAmount = Transaction::where('wallet_id', '=', $idDollarWallet)->sum('value');

        $euroAmount = 0;

        if (!empty($isWalletEuroCreate)) {
            $idEuroWallet = $userWallets->firstWhere('currency_type', 'euro')->id;
            $euroAmount = Transaction::where('wallet_id', '=', $idEuroWallet)->sum('value');
        }

        return view('wallet.index', compact('isWalletEuroCreate', 'id', 'rubleAmount', 'dollarAmount', 'euroAmount'));
    }

    public function show(): View
    {
        $id = Auth::user()->id;

        $userWallets = Wallet::where('user_id', '=', $id)->get();

        $idRubleWallet = $userWallets->firstWhere('currency_type', 'ruble')->id;
        $idDollarWallet = $userWallets->firstWhere('currency_type', 'dollar')->id;
        $idEuroWallet = $userWallets->firstWhere('currency_type', 'euro')->id;

        $rubleTransactions = Transaction::where('wallet_id', '=', $idRubleWallet)->get();
        $dollarTransactions = Transaction::where('wallet_id', '=', $idDollarWallet)->get();
        $euroTransactions = Transaction::where('wallet_id', '=', $idEuroWallet)->get();

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
        $user = Auth::user();
        $id = $user->id;

        $currency = $request->currency;
        $value = $request->value;

        $userWallets = Wallet::where('user_id', '=', $id)->get();

        $idRubleWallet = $userWallets->firstWhere('currency_type', 'ruble')->id;
        $idDollarWallet = $userWallets->firstWhere('currency_type', 'dollar')->id;

        if ($currency === 'RUB') {
            $idRubleWallet = $userWallets->firstWhere('currency_type', 'ruble')->id;

            Transaction::create([
                'wallet_id' => $idRubleWallet,
                'value' => $value,
            ]);
        }

        if($currency === 'USD') {
            $idDollarWallet = $userWallets->firstWhere('currency_type', 'dollar')->id;

            Transaction::create([
                'wallet_id' => $idDollarWallet,
                'value' => $value,
            ]);
        }

        if($currency === 'EUR') {
            $idEuroWallet = $userWallets->firstWhere('currency_type', 'euro')->id;

            Transaction::create([
                'wallet_id' => $idEuroWallet,
                'value' => $value,
            ]);
        }

        return redirect()->route('wallet.index', ['id' => $id]);
    }
}
