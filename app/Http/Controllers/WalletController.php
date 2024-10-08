<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\View\View;
use App\Enums\CurrencyType;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\TransactionRequest;
use App\Http\Requests\WalletCreateRequest;
use App\Http\Services\Wallet\WalletService;
use App\Http\Services\Wallet\WalletExistsChecker;

class WalletController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $id = $user->id;

        // Получаем кошельки пользователя
        $userWallets = $user->wallets;

        $walletExistsChecker = new WalletExistsChecker;
        $existsWallets = $walletExistsChecker->findMissingWallets($userWallets);

        $walletService = new WalletService;
        $balance = $walletService->getBalance($userWallets);

        return view('wallet.index', compact('existsWallets', 'id', 'balance'));
    }

    public function show(): View
    {
        $user = Auth::user();
        $userWallets = $user->wallets()->with('transactions')->get();

        return view('wallet.show', compact('userWallets'));
    }

    public function store(WalletCreateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $id = $user->id;

        $validated = $request->validated();

        $user->wallets()->create([
            'currency_type' => $validated['currency']
        ]);

        return redirect()->route('wallet.index', ['id' => $id]);
    }

    public function update(TransactionRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $id = $user->id;

        $validated = $request->validated();

        // Получаем кошелек по валюте
        $wallet = $user->wallets()->firstWhere('currency_type', $validated['currency']);

        $wallet->transactions()->create([
            'value' => $validated['value'],
        ]);

        return redirect()->route('wallet.index', ['id' => $id]);
    }
}
