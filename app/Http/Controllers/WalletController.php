<?php

namespace App\Http\Controllers;

use App\Models\WalletDollar;
use App\Models\WalletEuro;
use App\Models\WalletRuble;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;

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
                                ->first();

        $walletDollar = WalletDollar::where('user_id', '=', $id)
                                ->orderBy('updated_at', 'DESC')
                                ->first();

        $walletEuro = WalletEuro::where('user_id', '=', $id)
                                ->orderBy('updated_at', 'DESC')
                                ->first();

        $rubleAmount = $walletRuble->value;
        $dollarAmount = $walletDollar->value;
        $euroAmount = $walletEuro ? $walletEuro->value : 0;

        return view('wallet', compact('isWalletEuroCreate', 'id', 'rubleAmount', 'dollarAmount', 'euroAmount'));
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

        if($currency === 'RUB') {
            $walletRuble = WalletRuble::where('user_id', '=', $id)
                                ->orderBy('updated_at', 'DESC')
                                ->first();

            $walletRuble->value += $value;
            $walletRuble->save();
        }

        if($currency === 'USD') {
            $walletDollar = WalletDollar::where('user_id', '=', $id)
                                ->orderBy('updated_at', 'DESC')
                                ->first();

            $walletDollar->value += $value;
            $walletDollar->save();
        }

        if($currency === 'EUR') {
            $walletEuro = WalletEuro::where('user_id', '=', $id)
                                ->orderBy('updated_at', 'DESC')
                                ->first();

            $walletEuro->value += $value;
            $walletEuro->save();
        }

        return redirect()
        ->route('wallet.index', ['id' => $id]);
    }
}
