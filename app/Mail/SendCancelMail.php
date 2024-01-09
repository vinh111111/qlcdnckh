<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCancelMail extends Mailable
{
    use Queueable, SerializesModels;
    public $sendCancelData;

    /**
     * Create a new message instance.
     */
    public function __construct($sendCancelData)
    {
        $this->sendCancelData = $sendCancelData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('haphuocsang.dn2003@gmail.com', 'QLCTNCKH'),
            subject: 'Xét duyệt yêu cầu',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'sendMail.SendCancelMail',
            with: [
                'sendCancelData' => $this->sendCancelData
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
