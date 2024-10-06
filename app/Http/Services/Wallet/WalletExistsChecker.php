<?php

namespace App\Http\Services\Wallet;

use App\Enums\CurrencyType;

class WalletExistsChecker
{
    protected array $currencises = [];

    public function findMissingWallets(object $wallets): array
    {
        $existsWallets = $wallets->pluck('currency_type')->toArray();

        $currencies = [];
        foreach (CurrencyType::cases() as $value)
        {
            if (!in_array($value->name, $existsWallets))
            {
                $currencies[$value->name] = $value->value;
            }
        }

        return $this->currencises = $currencies;
    }
}
