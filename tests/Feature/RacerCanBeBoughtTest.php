<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Racer;
use App\Models\Wallet;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RacerCanBeBoughtTest extends TestCase
{
    /**
     *
     */
    public function test_racer_see_on_market(): void
    {
        $racer = Racer::factory()->create();

        $response = $this->get(route('market.index'));
        $response->assertSee($racer->name);
    }

    public function test_user_can_buy_racer(): void
    {
        $user = User::factory()
            ->has((Wallet::factory())->has(Transaction::factory()))

            ->create();

        $racer = Racer::factory()->create();

        $response = $this->post(route('market.buy', $racer));
        $this->assertDatabaseHas('racers', [
            'id' => $racer->id,
            'user_id' => $user->id,
        ]);
    }
}
