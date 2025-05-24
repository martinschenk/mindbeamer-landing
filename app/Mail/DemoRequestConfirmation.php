<?php

declare(strict_types=1);

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Class DemoRequestConfirmation
 *
 * @package App\Mail
 */
class DemoRequestConfirmation extends Mailable
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
     * Create a new message instance.
     *
     * @param  array  $data
     * @param  string  $locale
     */
    public function __construct(array $data, string $locale = 'en')
    {
        $this->data = $data;
        $this->userLocale = $locale;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('emails.demo_confirmation_subject', [], $this->userLocale),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.demo-request-confirmation',
            with: [
                'email' => $this->data['email'],
                'locale' => $this->userLocale,
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
