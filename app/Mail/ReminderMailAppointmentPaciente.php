<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderMailAppointmentPaciente extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject = 'Recordatorio de cita Espacio Crecer';

    private $reservas;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservas)
    {
        $this->reservas = $reservas;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reminder_mail_appointment_paciente')->with('reserva', $this->reservas);
    }
}
