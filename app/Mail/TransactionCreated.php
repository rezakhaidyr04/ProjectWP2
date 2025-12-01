<?php

namespace App\Mail;

use App\Models\GameTransaction;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TransactionCreated extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public GameTransaction $transaction)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pesanan Top Up Game Anda - ' . $this->transaction->transaction_code,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.transaction-created',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
