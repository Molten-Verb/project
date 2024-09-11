<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\WalletEuro;


class CreateEuroWalletTest extends TestCase
{
    use RefreshDatabase;
    /**
     *
     * @return void
     */
    public function test_euro_wallet_is_create()
    {
        $user = User::factory()->create();

        $wallet = WalletEuro::create([
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('wallet_euros', [
            'user_id' => $user->id,
        ]);
    }
}
