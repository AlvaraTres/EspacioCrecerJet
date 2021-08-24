<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactarPacienteMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Contacto desde Espacio Crecer";
    public $cuerpo;
    public $psicologo;
    public $paciente;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($psicologo, $paciente, $subject, $cuerpo)
    {
        $this->psicologo = $psicologo;
        $this->subject = $subject;
        $this->cuerpo = $cuerpo;
        $this->paciente = $paciente;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contactarPaciente');
    }
}
