<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Solicitud;

class NotificarAprobacionAutomaticaUsuarios extends Mailable
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
            subject: 'Notificación de Aprobación Automática',
        );
    }

    public function content(): Content
    {
        // Aquí usas la vista blade con datos
        return new Content(
            view: 'emails.aprobacion_automatica', // nombre del archivo blade sin extensión
            with: [
                'solicitud' => $this->solicitud,
            ],
        );
    }
}
