<?php

namespace App\Http\Services\Wallet;

use App\Enums\CurrencyType;
use Illuminate\Support\Collection;

class WalletExistsChecker
{
    protected array $missingCurrencises = [];
    protected array $existsCurrencises = [];

    public function findMissingWallets(Collection $wallets): array
    {
        $existsWallets = $wallets->pluck('currency_type')->toArray();
        $this->existsWallets = $existsWallets;

        $missingCurrencises = [];
        foreach (CurrencyType::cases() as $case)
        {
            if (!in_array($case->name, $existsWallets))
            {
                $missingCurrencises[$case->name] = $case->value;
            }
        }

        return $this->missingCurrencises = $missingCurrencises;
    }

    public function getExistsCurrencises(Collection $wallets): array
    {
        $existsWallets = $wallets->pluck('currency_type')->toArray();

        $existsCurrencises = [];
        foreach (CurrencyType::cases() as $case)
        {
            if (in_array($case->name, $existsWallets))
            {
                $existsCurrencises[$case->name] = $case->value;
            }
        }

        return $this->existsCurrencises = $existsCurrencises;
    }
}
