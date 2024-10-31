<?php

namespace App\Mail\Racer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RacerSelledHalfPriceMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $name;
    public $price;
    /**
     * Create a new message instance.
     */
    public function __construct(object $racer, float $price)
    {
        $this->name = $racer->name;
        $this->price = $price;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Racer Selled Half Price Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.racer.selledHalfPrice',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
