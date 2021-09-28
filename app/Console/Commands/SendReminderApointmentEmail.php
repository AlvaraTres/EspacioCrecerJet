<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reserva;
use App\Models\Paciente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMailAppointmentPaciente;

class SendReminderApointmentEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envío de correo para recordar cita con psicólogo.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //get all de appointments
        $reservas = Reserva::where('fecha_reserva', Carbon::now()->addDay()->format('Y-m-d'))->orderByDesc('id_usuario')->get();
        //dd($reservas);

        //group by pacientes
        $data = [];
        foreach($reservas as $reserva)
        {
            $data[$reserva->id_paciente][] = $reserva->toArray();
        }

        //dd($data);

        //send email
        foreach($data as $pacienteID => $reservas){
            $this->sendEmailToPaciente($pacienteID, $reservas);
        }
    }

    private function sendEmailToPaciente($pacienteID, $reservas)
    {
        $paciente = Paciente::find($pacienteID);
        
        $correo = new ReminderMailAppointmentPaciente($reservas);

        Mail::to($paciente->email)->send($correo);
    }
}
