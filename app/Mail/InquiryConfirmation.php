<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Copy of the inquiry sent back to the person who submitted it.
 */
class InquiryConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Inquiry $inquiry) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('contact.mail.confirmation_subject', ['ref' => $this->inquiry->reference]),
        );
    }

    public function content(): Content
    {
        return new Content(markdown: 'mail.inquiry-confirmation');
    }
}
