<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\WalletEuro;
use App\Models\WalletRuble;
use App\Models\WalletDollar;
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
    public function index(Request $request): View
    {
        $user = Auth::user();
        $id = $user->id;

        $isWalletEuroCreate = WalletEuro::firstWhere('user_id', $id);

        $walletRuble = WalletRuble::where('user_id', '=', $id)
                                ->orderBy('updated_at', 'DESC')
                                ->get();

        $walletDollar = WalletDollar::where('user_id', '=', $id)
                                ->orderBy('updated_at', 'DESC')
                                ->get();

        $walletEuro = WalletEuro::where('user_id', '=', $id)
                                ->orderBy('updated_at', 'DESC')
                                ->get();

        $rubleAmount = $walletRuble->sum('value');
        $dollarAmount = $walletDollar->sum('value');
        $euroAmount = $walletEuro ? $walletEuro->sum('value') : 0;

        return view('wallet.index', compact('isWalletEuroCreate', 'id', 'rubleAmount', 'dollarAmount', 'euroAmount'));
    }

    public function show(): View
    {
        $user = Auth::user();
        $id = $user->id;

        $rubleTransactions = DB::table('wallet_rubles')
                        ->where('user_id', '=', $id)
                        ->orderBy('updated_at', 'DESC')
                        ->get();

        $dollarTransactions = DB::table('wallet_dollars')
                        ->where('user_id', '=', $id)
                        ->orderBy('updated_at', 'DESC')
                        ->get();

        $euroTransactions = DB::table('wallet_euros')
                        ->where('user_id', '=', $id)
                        ->orderBy('updated_at', 'DESC')
                        ->get();

        return view('wallet.show', compact('rubleTransactions', 'dollarTransactions', 'euroTransactions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;

        $walletEuro = WalletEuro::create([
            'user_id' => $user->id
        ]);

        return redirect()
        ->route('wallet.index', ['id' => $id]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;

        $currency = $request->currency;
        $value = $request->value;

        if ($currency === 'RUB') {
            WalletRuble::create([
                'user_id' => $id,
                'value' => $value,
            ]);
        }

        if($currency === 'USD') {
            WalletDollar::create([
                'user_id' => $id,
                'value' => $value,
            ]);
        }

        if($currency === 'EUR') {
            WalletEuro::create([
                'user_id' => $id,
                'value' => $value,
            ]);
        }

        return redirect()
        ->route('wallet.index', ['id' => $id]);
    }
}
