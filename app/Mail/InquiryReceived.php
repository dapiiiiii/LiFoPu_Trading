<?php

namespace App\Mail;

use App\Models\Inquiry;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Internal notification sent to the LiFoPu team.
 */
class InquiryReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Inquiry $inquiry) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address($this->inquiry->email, $this->inquiry->name)],
            subject: __('contact.mail.internal_subject', [
                'ref' => $this->inquiry->reference,
                'interest' => $this->inquiry->interestLabel(),
            ]),
        );
    }

    public function content(): Content
    {
        return new Content(markdown: 'mail.inquiry-received');
    }
}
