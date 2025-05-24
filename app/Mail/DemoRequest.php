<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DemoRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var array
     */
    protected array $data;

    /**
     * @var string
     */
    protected string $userLocale;

    /**
     * @var string
     */
    protected string $adminLocale;

    /**
     * Create a new message instance.
     *
     * @param  array  $data
     * @param  string  $adminLocale  Locale for admin email content (always 'de')
     * @param  string  $userLocale   Locale of the user who submitted the form
     */
    public function __construct(array $data, string $adminLocale = 'de', string $userLocale = 'en')
    {
        $this->data = $data;
        $this->adminLocale = $adminLocale;
        $this->userLocale = $userLocale;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'MindBeamer.io Demo Request',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.demo-request',
            with: [
                'email' => $this->data['email'],
                'userLocale' => $this->userLocale,  // User's actual locale for display
                'adminLocale' => $this->adminLocale, // Admin locale for email text
            ],
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
