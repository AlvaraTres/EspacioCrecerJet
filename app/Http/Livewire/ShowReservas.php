<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserva;
use DB;
use Carbon\Carbon;

class ShowReservas extends Component
{
    public $open = false;

    public $events = '';

    public $fecha_res;
    //datos reserva
    public $id_usuario, $id_paciente, $fecha_reserva, $hora_reserva, $fecha_hora_reserva, $motivo_reserva, $cert_alumno_regular, $fecha_hora_reserva_fin;

    protected $rules = [
        'id_usuario' => 'required',
        'id_paciente' => 'required',
        'fecha_reserva' => 'required',
        'hora_reserva' => 'required',
        'fecha_hora_reserva' => 'required',
        'motivo_reserva' => 'required'
    ];

    public function render()
    {
        $events = DB::table('reservas')
                        ->join('users', 'users.id', '=', 'reservas.id_usuario')
                        ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                        ->where('reservas.id_paciente', '=', Auth::user()->id)
                        ->select(DB::raw('CONCAT(pacientes.nombre_paciente, \' \', pacientes.ap_pat_paciente) AS title'), 'reservas.fecha_hora_reserva as start','reservas.motivo_reserva as description', 'reservas.fecha_hora_reserva_fin as end')
                        ->get();
        //dd($reservas);

        $this->events = json_encode($events);

        return view('livewire.show-reservas');
    }

    public function storeReserva($eventAdd, $startTime){
        //$this->validate();
        //dd($eventAdd, $startTime);

        //dd($eventAdd['start']);
        $fecha_res = Carbon::parse($eventAdd['start'])->format('Y-m-d H:i:s');
        $fecha_res_form = Carbon::createFromFormat('Y-m-d H:i:s', $fecha_res)->format('Y-m-d');
        //dd($fecha_res_form);

        //convertir hora de reserva a objeto de carbón
        $time = Carbon::parse($startTime)->addSeconds('00')->format('H:i:s');
        //dd($time);

        //concatenar fecha seleccionada mas hora seleccionada desde el calendario
        $fecha_final = Carbon::createFromFormat('Y-m-d H:i:s',$fecha_res_form . ' ' . $time);
        //dd($fecha_final);

        //sumar hora para hora fin
        $hora_termino = Carbon::parse($fecha_final)->addHour();
        //dd($hora_termino);

        Reserva::create([
            'id_usuario' => 1,
            'id_paciente' => Auth::user()->id,
            'fecha_reserva' => $fecha_res_form,
            'hora_reserva' => $fecha_final,
            'fecha_hora_reserva' => $fecha_final,
            'motivo_reserva' => $eventAdd['description'],
            'fecha_hora_reserva_fin' => $hora_termino,
        ]);

        $this->reset([
            'id_usuario',
            'id_paciente',
            'fecha_reserva',
            'hora_reserva',
            'fecha_hora_reserva',
            'open'
        ]);
    }
}
