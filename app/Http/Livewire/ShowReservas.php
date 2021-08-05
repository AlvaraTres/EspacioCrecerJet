<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Reserva;
use App\Models\User;
use DB;
use Carbon\Carbon;

class ShowReservas extends Component
{
    public $open = false;
    public $openEditModal = false;
    public $openDelModal = false;

    public $events = '';
    public $psicologos = [];

    public $fecha_res;
    public $reserva_id;
    //datos reserva
    public $id_usuario, $id_paciente, $fecha_reserva, $hora_reserva, $fecha_hora_reserva, $motivo_reserva, $cert_alumno_regular, $fecha_hora_reserva_fin;

    public $selectedPsico;
    public $comparador = false;

    protected $rules = [
        'id_usuario' => 'required',
        'id_paciente' => 'required',
        'fecha_reserva' => 'required',
        'hora_reserva' => 'required',
        'fecha_hora_reserva' => 'required',
        'motivo_reserva' => 'required'
    ];

    public function render()
    {   $filtPsico;

        if(\Auth::user()->id_users_rol == 3)
        {
            $paciente = DB::table('pacientes')
                          ->join('users', 'users.rut_usuario', '=' , 'pacientes.rut_paciente')
                          ->select('pacientes.*')
                          ->where('pacientes.rut_paciente', '=', \Auth::user()->rut_usuario)
                          ->first();

            $events = DB::table('reservas')
                        ->join('users', 'users.id', '=', 'reservas.id_usuario')
                        ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                        ->where('reservas.id_paciente', '=', $paciente->id)
                        ->select(DB::raw('CONCAT(pacientes.nombre_paciente, \' \', pacientes.ap_pat_paciente) AS title'), 'reservas.fecha_hora_reserva as start','reservas.motivo_reserva as description', 'reservas.fecha_hora_reserva_fin as end')
                        ->get();

            $filtPsico = User::select(DB::raw('CONCAT(users.nombre_usuario, \' \', users.apellido_pat_usuario) AS psicologo'), 'users.*')->where('users.id_users_rol', '=', 2)->orderBy('users.id', 'ASC')->get();
            
            $datos = DB::table('reservas')
                    ->join('users', 'users.id', '=', 'reservas.id_usuario')
                    ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                    ->select('users.id as id_user' ,'users.*', 'pacientes.*')
                    ->where('pacientes.id', '=', $paciente->id)
                    ->first();
            if($datos){
                $events = DB::table('reservas')
                            ->join('users', 'users.id', '=', 'reservas.id_usuario')
                            ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                            ->where('reservas.id_paciente', '=', $paciente->id)
                            ->where('reservas.id_usuario', '=', $datos->id_user)
                            ->select(DB::raw('CONCAT(pacientes.nombre_paciente, \' \', pacientes.ap_pat_paciente) AS title'), 'reservas.fecha_hora_reserva as start','reservas.motivo_reserva as description', 'reservas.fecha_hora_reserva_fin as end')
                            ->get();
                $this->selectedPsico = $datos->id_user;
            }else{
                if($this->selectedPsico != null){
                    $events = DB::table('reservas')
                            ->join('users', 'users.id', '=', 'reservas.id_usuario')
                            ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                            ->where('reservas.id_usuario', '=', $this->selectedPsico)
                            ->select(DB::raw("'Hora Reservada' as title"), 'reservas.fecha_hora_reserva as start','reservas.motivo_reserva as description', 'reservas.fecha_hora_reserva_fin as end')
                            ->get();
                }
            }
        }else{
            $events = DB::table('reservas')
                        ->join('users', 'users.id', '=', 'reservas.id_usuario')
                        ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                        ->where('reservas.id_paciente', '=', Auth::user()->id)
                        ->select(DB::raw('CONCAT(pacientes.nombre_paciente, \' \', pacientes.ap_pat_paciente) AS title'), 'reservas.fecha_hora_reserva as start','reservas.motivo_reserva as description', 'reservas.fecha_hora_reserva_fin as end')
                        ->get();
            //dd($reservas);
        }
        

        $this->psicologos = DB::table('users')
                            ->where('id_users_rol', '=', 2)
                            ->select(DB::raw('CONCAT(users.nombre_usuario, \' \', users.apellido_pat_usuario, \' \', users.apellido_mat_usuario) AS fullNombre'), 'users.id')
                            ->get();
        //dd($this->psicologos);

        $this->events = json_encode($events);

        return view('livewire.show-reservas', compact('datos', 'filtPsico', 'paciente'));
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
            'id_usuario' => $this->selectedPsico,
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
        return redirect()->to('/reservas');
    }

    public function editReserva($reserva){
        $reserva_find = Reserva::where('fecha_hora_reserva', '=', $reserva['start'])->first();
        if(\Auth::user()->id_users_rol == 3){
            $paciente = DB::table('pacientes')
                           ->join('users', 'users.rut_usuario', '=' , 'pacientes.rut_paciente')
                           ->select('pacientes.*')
                           ->where('pacientes.rut_paciente', '=', \Auth::user()->rut_usuario)
                           ->first();
            if($reserva_find->id_paciente == $paciente->id){
                $this->openEditModal = true;
                //dd($reserva_find);
                $this->reserva_id = $reserva_find->id;
                $this->motivo_reserva = $reserva_find->motivo_reserva;
                $this->fecha_reserva = Carbon::parse($reserva['start'])->format('d-m-Y');
                $this->hora_reserva = Carbon::parse($reserva['start'])->format('H:i');
                //dd($format_time);
            }else{
                $this->dispatchBrowserEvent('swal', [
                    'title' => 'Error!', 
                    'text' => 'No puedes modificar horas que no hayas reservado tú.',
                    'icon' => 'error'
                ]);
            }
        }else{
            //dd($reserva_find);
            $this->openEditModal = true;
            $this->reserva_id = $reserva_find->id;
            $this->motivo_reserva = $reserva_find->motivo_reserva;
            $this->fecha_reserva = Carbon::parse($reserva['start'])->format('d-m-Y');
            $this->hora_reserva = Carbon::parse($reserva['start'])->format('H:i');
            //dd($format_time);
        }
    }

    public function updateReserva($editFecha, $editHora){
        //dd($editFecha, $editHora);
        $up_fecha = Carbon::parse($editFecha)->format('Y-m-d');
        //$up_fecha_res_form = Carbon::createFromFormat('Y-m-d H:i:s', $up_fecha)->format('Y-m-d');
        $up_time = Carbon::parse($editHora)->addSeconds('00')->format('H:i:s');
        
        $up_fecha_final = Carbon::createFromFormat('Y-m-d H:i:s',$up_fecha . ' ' . $up_time);
        //dd($up_fecha_final);

        $up_hora_termino = Carbon::parse($up_fecha_final)->addHour();

        $reserva_up = Reserva::find($this->reserva_id);
        //dd($reserva_up);
        $reserva_up->update([
            'fecha_reserva' => $up_fecha,
            'hora_reserva' => $up_fecha_final,
            'fecha_hora_reserva' => $up_fecha_final,
            'fecha_hora_reserva_fin' => $up_hora_termino,
        ]);

        $this->reset([
            'reserva_id',
            'motivo_reserva',
            'fecha_reserva',
            'hora_reserva',
            'openEditModal'
        ]);

        return redirect()->to('/reservas');
    }

    public function deleteReserva(){
        $res_del = Reserva::find($this->reserva_id);
        $this->openEditModal = false;
        $this->openDelModal = true;
    }

    public function cancelarDel(){
        $this->openDelModal = true;
        return redirect()->to('/reservas');
    }

    public function destroyReserva(){
        $res_dest = Reserva::find($this->reserva_id);
        $res_dest->delete();

        $this->reset([
            'reserva_id',
            'motivo_reserva',
            'fecha_reserva',
            'hora_reserva',
            'openEditModal',
            'openDelModal'
        ]);

        return redirect()->to('/reservas');
    }

    public function getReservas(){
        $reservas = DB::table('reservas')
                    ->join('users', 'users.id', '=', 'reservas.id_usuario')
                    ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                    ->where('reservas.id_paciente', '=', Auth::user()->id)
                    ->select(DB::raw('CONCAT(pacientes.nombre_paciente, \' \', pacientes.ap_pat_paciente) AS title'), 'reservas.fecha_hora_reserva as start','reservas.motivo_reserva as description', 'reservas.fecha_hora_reserva_fin as end')
                    ->get();

        return json_encode($reservas);
    }

    public function checkDate($fecha, $startTime, $pid, $date1, $date2, $date3, $description)
    {
        $fecha = Carbon::createFromFormat('Y-m-d',$date1 . '-' . $date2 . '-' . $date3)->format('Y-m-d');
        //dd($fecha);
        $hora = Carbon::parse($startTime)->addSeconds('00')->format('H:i:s');
        //dd($hora);
        $fecha_hora = Carbon::createFromFormat('Y-m-d H:i:s',$fecha . ' ' . $hora);
        
        
        $comparador = DB::table('reservas')->select('reservas.*')->where('reservas.fecha_hora_reserva', '=', $fecha_hora->format('Y-m-d H:i:s'))->first();
        if(empty($comparador)){
            return redirect()->route('payment', ['date1' => $date1, 'date2' => $date2, 'date3' => $date3, 'startTime' => $startTime, 'description' => $description, 'pid' => $pid]);
        }else{
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!', 
                'text' => 'La hora seleccionada ya se encuentra reservada, por favor selecciona otra que este disponible.',
                'icon' => 'error'
            ]);
        }

        
    }
}
