<?php

namespace App\Models;

use App\Enum\CurrencyType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
		'currency_type',
    ];
}
