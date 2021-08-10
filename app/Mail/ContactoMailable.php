<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Registro de atención";
    public $paciente;
    public $reserva;
    public $psicologo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pacienteData, $reservaData, $psicologoData)
    {
        $this->paciente = $pacienteData;
        $this->reserva = $reservaData;
        $this->psicologo = $psicologoData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.confirmacion_reserva');
    }
}
