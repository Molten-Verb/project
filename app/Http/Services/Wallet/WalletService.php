<?php

namespace App\Http\Services\Wallet;

use App\Enums\CurrencyType;
use App\Models\Transaction;

class WalletService
{
    protected array $balance;
    protected $transactions;

    public function getBalance(object $wallets): array
    {
        // Получаем суммы по валютам
        $amounts = collect(CurrencyType::cases())
            ->mapWithKeys(function (CurrencyType $currency) use ($wallets) {
            $walletId = $wallets->firstWhere('currency_type', $currency->value)->id ?? null; // $walletId: int|null
            $amount = $walletId ? Transaction::where('wallet_id', $walletId)->sum('value') : 0; // $amount: int

            return [$currency->value => $amount];
        });

        $balance = [];
        foreach (CurrencyType::cases() as $value)
        {
            $balance[$value->name] = $amounts[$value->value];
        }

        return $this->balance = $balance;
    }
}
