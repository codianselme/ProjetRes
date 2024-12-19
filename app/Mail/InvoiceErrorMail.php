<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceErrorMail extends Mailable
{
    use Queueable, SerializesModels;

    public $errorDetails;

    /**
     * Create a new message instance.
     */
    public function __construct(array $errorDetails)
    {
        $this->errorDetails = $errorDetails;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return (new Envelope)
            ->subject('Erreur critique lors du traitement de la facture')
            ->from('noreply@example.com', 'Système de gestion de restaurant' );
    }


    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->view('emails.invoice_error')
                    ->with('errorDetails', $this->errorDetails);
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

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
