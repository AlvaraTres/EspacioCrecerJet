<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoPsicologoPacienteMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = " ";
    public $psicologo;
    public $cuerpo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($psicologo, $subject, $cuerpo)
    {
        $this->subject = $subject;
        $this->psicologo = $psicologo;
        $this->cuerpo = $cuerpo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contactarPsicologo');
    }
}
