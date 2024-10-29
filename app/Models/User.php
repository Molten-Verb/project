<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Racer;
use App\Enums\CurrencyType;
use App\Observers\UserObserver;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Foundation\Auth\User as Authenticatable;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'birthday',
        'email',
        'password',
        'google_id',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function wallets(): HasMany
    {
        return $this->hasMany(Wallet::class);
    }

        public function neededWallet(CurrencyType $currency): Wallet
        {
            $neededWallet = $this->wallets()->firstWhere('currency_type', $currency->value);

            return $neededWallet;
        }

        public function getUserWalletBalance(CurrencyType $currency): float
        {
            $neededWallet = $this->wallets()->firstWhere('currency_type', $currency->value);
            $walletId = $neededWallet->id ?? null;
            $amount = $walletId ? Transaction::where('wallet_id', $walletId)->sum('value') : 0;

            return $amount;
        }

        public function balanceUSD(): float
        {
            $neededWallet = $this->wallets()->firstWhere('currency_type', CurrencyType::USD->value);
            $walletId = $neededWallet->id ?? null;
            $amount = $walletId ? Transaction::where('wallet_id', $walletId)->sum('value') : 0;

            return $amount;
        }

    public function racers(): HasMany
    {
        return $this->hasMany(Racer::class);
    }
}
