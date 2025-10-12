<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Proposal;
use App\Models\User;

class ProposalRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $proposal;
    public $mahasiswa;
    public $sponsor;

    /**
     * Create a new message instance.
     */
    public function __construct(Proposal $proposal, User $mahasiswa, User $sponsor)
    {
        $this->proposal = $proposal;
        $this->mahasiswa = $mahasiswa;
        $this->sponsor = $sponsor;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pemberitahuan Penolakan Proposal',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.proposal-rejected',
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
