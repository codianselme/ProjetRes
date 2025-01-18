<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CommandMail extends Mailable
{
    use Queueable, SerializesModels;

    public $command;
    public $cart;
    public $type;

    public function __construct($command, $cart, $type = 'admin')
    {
        $this->command = $command;
        $this->cart = $cart;
        $this->type = $type;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = $this->type === 'admin' 
            ? 'Nouvelle commande - Les Saveurs du Corridor' 
            : 'Confirmation de votre commande - Les Saveurs du Corridor';

        return new Envelope(subject: $subject);
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $view = $this->type === 'admin' 
            ? 'emails.command-admin'
            : 'emails.command-client';

        return new Content(view: $view);
    }
}
