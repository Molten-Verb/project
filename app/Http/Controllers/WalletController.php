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
        $isWalletEuroCreate = WalletEuro::firstWhere('user_name', $user->name);
        $walletRuble = WalletRuble::where('user_name', '=', $user->name)
                                ->orderBy('updated_at', 'DESC')
                                ->first()
                                ->get('count');
        $walletDollar = WalletDollar::where('user_name', '=', $user->name)
                                ->orderBy('updated_at', 'DESC')
                                ->first()
                                ->get('count');
        $walletEuro = WalletDollar::where('user_name', '=', $user->name)
                                ->orderBy('updated_at', 'DESC')
                                ->first()
                                ->get('count');

        $rubleCount = $walletRuble[0]['count'];
        $dollarCount = $walletRuble[0]['count'];
        $euroCount = $walletRuble[0]['count'];

        return view('wallet', compact('isWalletEuroCreate', 'rubleCount', 'dollarCount', 'euroCount'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $walletEuro = WalletEuro::create([
            'user_name' => $user->name
        ]);

        return redirect()
            ->route('wallet.home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
