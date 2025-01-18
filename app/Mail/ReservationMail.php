<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $type;

    public function __construct($reservation, $type = 'admin')
    {
        $this->reservation = $reservation;
        $this->type = $type;
    }

    public function envelope(): Envelope
    {
        $subject = $this->type === 'admin' 
            ? 'Nouvelle réservation' 
            : 'Confirmation de votre réservation - Les Saveurs du Corridor';

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {
        $view = $this->type === 'admin' 
            ? 'emails.reservation-admin'
            : 'emails.reservation-client';

        return new Content(
            view: $view,
        );
    }
}
