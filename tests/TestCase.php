<?php

namespace Tests;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use LazilyRefreshDatabase;

    protected $seed = true;
    protected User $currentUser;

    protected function signIn(User $user = null)
    {
        if (!$user) {
            $user = User::factory()
            ->has((Wallet::factory())->has(Transaction::factory()))
            ->create();
        }

        $this->currentUser = $user;

        return $this->actingAs($user);
    }

    public function seedRoles()
    {
        $this->seed(PermissionsSeeder::class);
    }

    public function getUser(): User
    {
        return $this->currentUser;
    }

}
