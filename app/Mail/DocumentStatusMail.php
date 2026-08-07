<?php

namespace App\Mail;

use App\Models\CompanyDocument;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DocumentStatusMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public CompanyDocument $document)
    {
    }

    public function envelope(): Envelope
    {
        $label = $this->document->status === 'approved' ? 'approved' : 'rejected';

        return new Envelope(
            subject: 'Your ' . CompanyDocument::TYPES[$this->document->type] . " was {$label}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.document-status',
            with: ['document' => $this->document],
        );
    }
}
