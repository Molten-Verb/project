<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RacerPurchasedNotification extends Notification implements ShouldQueue
{
    use Queueable;


    public $name;
    /**
     * Create a new notification instance.
     */
    public function __construct(object $racer)
    {
        $this->name = $racer->name;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }
    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)->view('mail.racer.bought', ['racer' => $this->name]);
    }
}
