<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Notifications\SendVerifyWithQueueNotification;

class EmailTest extends TestCase
{
    /**
     * @test
     */
    public function email_verification_notification_is_queued(): void
    {
        Notification::fake();
        Queue::fake();

        $user = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $response = $this->actingAs($user)->post('/email/verification-notification');

        Notification::assertSentTo([$user], SendVerifyWithQueueNotification::class);
        Queue::assertPushed(SendVerifyWithQueueNotification::class, 1); // тест не видит в очереди
    }
}
