<?php

namespace App\Mail;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailConfirationEmail extends Mailable
{
    use Queueable, SerializesModels;

    

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Client $client,
        public string $hash
    )
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verification Email - ' . $this->client->firstname,
        );
    }

    /**
     * Get the message content definition.
     */


    

    public function content(): Content
    {
        return new Content(
            view: 'mail.mail-template',
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
