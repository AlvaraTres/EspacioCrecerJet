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
    public $direccionURL;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pacienteData, $reservaData, $psicologoData, $direccionURL)
    {
        $this->paciente = $pacienteData;
        $this->reserva = $reservaData;
        $this->psicologo = $psicologoData;
        $this->direccionURL = $direccionURL;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if(\Auth::user()->id_users_rol == 2){
            return $this->view('emails.confirmacion_reserva');
        }else{
            return $this->view('emails.maillink_reserva');
        }
    }
}
