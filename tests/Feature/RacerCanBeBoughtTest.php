<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Racer;
use Illuminate\Support\Facades\Mail;
use App\Mail\Racer\RacerPurchasedMail;
use Illuminate\Foundation\Testing\WithFaker;

class RacerCanBeBoughtTest extends TestCase
{
    public function test_racer_see_on_market(): void
    {
        $racer = Racer::factory()->create();

        $response = $this->get(route('market.index'));
        $response->assertSee($racer->name);
    }

    public function test_user_can_buy_racer(): void
    {
        $user = $this->signIn()->getUser();
        $racer = Racer::factory()->create();

        $response = $this->post(route('market.buy', $racer));

        $this->assertDatabaseHas('racers', [
            'id' => $racer->id,
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('transactions', [
            'value' => -$racer->price,
        ]);
    }

    public function test_after_purchased_mail_send_to_queue(): void
    {
        Mail::fake();

        $user = $this->signIn()->getUser();
        $racer = Racer::factory()->create();

        $response = $this->post(route('market.buy', $racer));
        Mail::assertQueued(RacerPurchasedMail::class);
    }
}
