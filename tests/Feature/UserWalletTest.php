<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Wallet;

use App\Enums\CurrencyType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UserWalletTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @return void
     */
    public function test_wallet_is_create()
    {
        $user = User::factory()->create();
        $this->actingAs($user); // авторизация юзера

        $this->assertDatabaseHas('wallets', [
            'wallet_id' => $user->id,
            'currency_type' => CurrencyType::RUB->value,
        ]);
    }
}
