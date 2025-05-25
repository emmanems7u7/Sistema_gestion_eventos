<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Solicitud;

class NotificarSolicitudNoAprobada extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitud;

    public function __construct(Solicitud $solicitud)
    {
        $this->solicitud = $solicitud;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Notificación de solicitud no aprobada',
        );
    }

    public function content(): Content
    {

        return new Content(
            view: 'emails.notificar_solicitud',
            with: [
                'solicitud' => $this->solicitud,
            ],
        );
    }
}
