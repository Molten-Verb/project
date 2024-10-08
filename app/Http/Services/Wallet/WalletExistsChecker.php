<?php

namespace App\Http\Services\Wallet;

use App\Enums\CurrencyType;
use Illuminate\Support\Collection;

class WalletExistsChecker
{
    protected array $currencises = [];

    public function findMissingWallets(Collection $wallets): array
    {
        $existsWallets = $wallets->pluck('currency_type')->toArray();

        $currencies = [];
        foreach (CurrencyType::cases() as $case)
        {
            if (!in_array($case->name, $existsWallets))
            {
                $currencies[$case->name] = $case->value;
            }
        }

        return $this->currencises = $currencies;
    }
}
