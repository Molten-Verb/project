<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendVerifyWithQueueNotification;

class EmailTest extends TestCase
{
    /**
     * @test
     */
    public function email_verification_notification_is_send(): void
    {
        Notification::fake();

        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->post(route('verification.send'));

        Notification::assertSentTo([$user], SendVerifyWithQueueNotification::class);
    }
}
