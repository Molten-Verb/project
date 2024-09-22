<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Wallet;
use App\Enum\CurrencyType;

class WalletObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Wallet::create([
            'user_id' => $user->id,
            'currency_type' => CurrencyType::RUB
        ]);

        Wallet::create([
            'user_id' => $user->id,
            'currency_type' => CurrencyType::USD
        ]);
    }
}
