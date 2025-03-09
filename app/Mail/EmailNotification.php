<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * @property array $attributes
 */
class EmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;

    }

    public function envelope(): Envelope
    {
        return new Envelope(
            to: $this->attributes['email'],
            subject: 'OTP',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'pages.emails.otp_email_notification',
            with: ['attributes' => $this->attributes],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
