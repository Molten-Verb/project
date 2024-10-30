<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Transaction;
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
        $missingWallets = $walletExistsChecker->findMissingWallets($userWallets);
        $existsWallets = $walletExistsChecker->getExistsCurrencises($userWallets);

        $walletService = new WalletService;
        $balance = $walletService->getBalanceOfAllWallets($userWallets);

        return view('wallet.index', compact('id', 'balance', 'missingWallets', 'existsWallets'));
    }

    public function show(): View
    {
        $user = Auth::user();

        $transactions = Transaction::whereIn('wallet_id', $user->wallets->pluck('id'))
                        ->paginate(15);

        return view('wallet.show', compact('transactions'));
    }

    public function store(WalletCreateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $id = $user->id;

        $validated = $request->validated();

        $user->wallets()->create([
            'currency_type' => $validated['currency'],
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
