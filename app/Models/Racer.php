<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Racer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'country',
        'price',
        'user_id',
        'on_market',
        'avatar',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
