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
        $userId = Auth::user()->id;

        Wallet::create([
            'wallet_id' => $userId,
            'currency_type' => CurrencyType::RUB
        ]);
    }
}
