<?php

namespace App\Mail\Racer;

use App\Models\Racer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class RacerSelledHalfPriceMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public Racer $racer;
    public $price;
    /**
     * Create a new message instance.
     */
    public function __construct(object $racer, float $price)
    {
        $this->racer = $racer;
        $this->price = $price;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Гонщик продан',
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
