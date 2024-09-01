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
        $userName = $request->user()->name;
        $isWalletEuroCreate = WalletEuro::firstWhere('user_name',$userName);

        return view('wallet', compact('isWalletCreate'));
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = ['user_name' => $request->user()->name];

        $wallet = new Wallet();
        $wallet->fill($data);
        $wallet->save($data);

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
