<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;

class Wallet extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'user_name',
        'AUD',
		'BGN',
		'BRL',
		'CAD',
		'CHF',
		'CNY',
		'CZK',
		'DKK',
		'EUR',
		'GBP',
		'HKD',
		'HRK',
		'HUF',
		'IDR',
		'ILS',
		'INR',
		'ISK',
		'JPY',
		'KRW',
		'MXN',
		'MYR',
		'NOK',
		'NZD',
		'PHP',
		'PLN',
		'RON',
		'RUB',
		'SEK',
		'SGD',
		'THB',
		'TRY',
		'USD',
		'ZAR',
    ];
}
