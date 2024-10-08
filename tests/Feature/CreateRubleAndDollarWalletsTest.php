<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\WalletRuble;
use App\Models\WalletDollar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CreateRubleAndDollarWalletsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if user_id is correctly assigned to wallet after user registration.
     *
     * @return void
     */
    public function test_user_id_is_assigned_to_wallet_on_registration()
    {
        // Создаем пользователя
        $user = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);

        $dollarsWallet = WalletDollar::create([
            'user_id' => $user->id
        ]);

        $RubleWallet = WalletRuble::create([
            'user_id' => $user->id
        ]);

        $this->assertDatabaseHas('wallet_dollars', [
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseHas('wallet_rubles', [
            'user_id' => $user->id,
        ]);
    }
}
