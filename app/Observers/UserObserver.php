<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Wallet;
use App\Enums\CurrencyType;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $user->wallets()->create([
            'currency_type' => CurrencyType::RUB->value
        ]);
    }
}
