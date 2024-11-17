<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Auth\Notifications\VerifyEmail;
use App\Notifications\SendVerifyWithQueueNotification;

class EmailTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_email_verification_notification_is_queued(): void
    {
        Notification::fake();

        $this->seedRoles();

        $name = fake()->name();
        $email = fake()->unique()->safeEmail();

        $data = [
            'name' => $name,
            'email' => $email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/register', $data);

        $user = User::where('email', $email)->first();

        Notification::assertSentToQueue($user, SendVerifyWithQueueNotification::class);
    }
}
