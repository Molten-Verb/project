<?php

namespace App\Http\Services\Wallet;

use App\Enums\CurrencyType;
use App\Models\Transaction;

class WalletService
{
    protected array $balances;
    protected $walletBalance;

    public function getBalanceOfAllWallets(object $wallets): array
    {
        $amounts = collect(CurrencyType::cases())
            ->mapWithKeys(function (CurrencyType $currency) use ($wallets) {
            $walletId = $wallets->firstWhere('currency_type', $currency->value)->id ?? null; // $walletId: int|null
            $amount = $walletId ? Transaction::where('wallet_id', $walletId)->sum('value') : 0; // $amount: int

            return [$currency->value => $amount];
        });

        $balance = [];
        foreach (CurrencyType::cases() as $value)
        {
            $balances[$value->name] = $amounts[$value->value];
        }

        return $this->balances = $balances;
    }

    public function getWalletBalance(object $wallet): float
    {
        $walletId = $wallet->id ?? null;
        $amount = $walletId ? Transaction::where('wallet_id', $walletId)->sum('value') : 0;

        return $this->walletBalance = $amount;
    }
}
