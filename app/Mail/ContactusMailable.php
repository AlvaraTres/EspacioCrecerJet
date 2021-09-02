<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactusMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $person;
    public $phone;
    public $mail;
    public $mensaje;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($formulario)
    {
        $this->person = $formulario->nombre ." ".$formulario->apellidos;
        $this->phone = $formulario->telefono;
        $this->mail = $formulario->correo;
        $this->mensaje = $formulario->comentario;

        $this->mensaje = str_replace("\n", "<br/>" , $this->mensaje);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contactanos');
    }
}
