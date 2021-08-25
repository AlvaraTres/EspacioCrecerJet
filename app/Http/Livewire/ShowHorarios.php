<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Horario;
use DB;
use App\Models\User;
use App\Models\Paciente;
use Carbon\Carbon;

class ShowHorarios extends Component
{
    public $open = false;
    public $openEditModal = false;
    public $openDelModal = false;
    public $psicoSelected;

    public $events = '';
    public $fechaClick, $horaInicio, $horaFin;

    public $cont = 0;

    public $id_user, $horario_id, $fecha_inicio, $fecha_fin, $hora_inicio, $hora_fin, $fecha_hora_inicio, $fecha_hora_fin;

    public function render()
    {
        if(\Auth::user()->id_users_rol == 1){
            if($this->psicoSelected != null){
                $events = DB::table('horarios')
                            ->select(DB::raw('CONCAT(DATE_FORMAT(horarios.fecha_hora_inicio, "%H:%i") , \' - \', DATE_FORMAT(horarios.fecha_hora_fin, "%H:%i")) as title'), 'horarios.fecha_hora_inicio as start', 'horarios.fecha_hora_fin as end','horarios.id as horariosID')
                            ->where('horarios.id_user', '=', $this->psicoSelected)
                            ->get();
                $psicologo = User::first();
                //dd($events);
            }else{
                $events = [];
                $psicologo = User::first();
            } 
        }else{
            if(\Auth::user()->id_users_rol == 2){
                $events = DB::table('horarios')
                            ->select(DB::raw('CONCAT(DATE_FORMAT(horarios.fecha_hora_inicio, "%H:%i") , \' - \', DATE_FORMAT(horarios.fecha_hora_fin, "%H:%i")) as title'), 'horarios.fecha_hora_inicio as start', 'horarios.fecha_hora_fin as end')
                            ->where('horarios.id_user', '=', \Auth::user()->id)
                            ->get(); 
                $psicologo = User::first();  
            }else{
                if(\Auth::user()->id_users_rol == 3){
                    $paciente = Paciente::where('rut_paciente', '=', \Auth::user()->rut_usuario)->first();
                    //dd($paciente);

                    $psicologo = DB::table('reservas')
                                ->join('users', 'users.id', '=', 'reservas.id_usuario')
                                ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                                ->select('users.id as id_user' ,'users.*', 'pacientes.*')
                                ->where('pacientes.id', '=', $paciente->id)
                                ->first();

                    if($paciente->id_psicologo != null){
                        $psicologo = User::find($paciente->id_psicologo);
                        //dd($psicologo);
                        $events = DB::table('horarios')
                                ->select(DB::raw('CONCAT(DATE_FORMAT(horarios.fecha_hora_inicio, "%H:%i") , \' - \', DATE_FORMAT(horarios.fecha_hora_fin, "%H:%i")) as title'), 'horarios.fecha_hora_inicio as start', 'horarios.fecha_hora_fin as end')
                                ->where('horarios.id_user', '=', $psicologo->id)
                                ->get();
                    }else{
                        $events = DB::table('horarios')
                                    ->select(DB::raw('CONCAT(DATE_FORMAT(horarios.fecha_hora_inicio, "%H:%i") , \' - \', DATE_FORMAT(horarios.fecha_hora_fin, "%H:%i")) as title'), 'horarios.fecha_hora_inicio as start', 'horarios.fecha_hora_fin as end')
                                    ->where('horarios.id_user', '=', $psicologo->id_user)
                                    ->get();
                        //dd($psicologo->id_user);
                    }
                }
            }
        }
        
        $filtPsico = User::select('id', 'nombre_usuario')->where('id_users_rol', '=', 2)->get();
        //dd($filtPsico);

        //dd($events);
        $this->events = json_encode($events);

        return view('livewire.show-horarios', compact('filtPsico', 'psicologo'));
    }

    public function updatedFechaClick($value){
        //dd($value);
    }

    public function updatedPsicoSelected($value){
        //
    }

    public function changeData(){
        $events = DB::table('horarios')
                            ->select(DB::raw('CONCAT(DATE_FORMAT(horarios.fecha_hora_inicio, "%H:%i") , \' - \', DATE_FORMAT(horarios.fecha_hora_fin, "%H:%i")) as title'), 'horarios.fecha_hora_inicio as start', 'horarios.fecha_hora_fin as end','horarios.id as horariosID')
                            ->where('horarios.id_user', '=', $this->psicoSelected)
                            ->get();

        $this->events = json_encode($events);
        return $this->events;
    }

    public function storeHorario(){
        
            
            //dd($this->fechaClick, $this->horaInicio, $this->horaFin);
            //dd($this->psicoSelected);
            $fecha_horario = Carbon::parse($this->fechaClick)->format('Y-m-d H:i:s');
            $fecha_only = Carbon::parse($this->fechaClick)->format('Y-m-d');
            //dd($fecha_horario);
            $fech_horario_res = Carbon::createFromFormat('Y-m-d H:i:s', $fecha_horario)->format('Y-m-d');
    
            $hora_ini = Carbon::parse($this->horaInicio)->addSeconds('00')->format('H:i:s');
            $hora_end = Carbon::parse($this->horaFin)->addSeconds('00')->format('H:i:s');
            //dd($hora_ini, $hora_end);
    
            $fech_hor_ini = Carbon::createFromFormat('Y-m-d H:i:s',$fech_horario_res . ' ' . $hora_ini);
            $fech_hor_fin = Carbon::createFromFormat('Y-m-d H:i:s',$fech_horario_res . ' ' . $hora_end);
            //dd($fech_hor_ini, $fech_hor_fin);
    
            if(\Auth::user()->id_users_rol == 2){
                Horario::create([
                    'id_user' => \Auth::user()->id,
                    'fecha_inicio' => $fecha_only,
                    'fecha_fin' => $fecha_only,
                    'hora_inicio' => $fech_hor_ini,
                    'hora_fin' => $fech_hor_fin,
                    'fecha_hora_inicio' => $fech_hor_ini,
                    'fecha_hora_fin' => $fech_hor_fin,
                ]);
                
                $this->dispatchBrowserEvent('swal', [
                    'title' => 'Exito!', 
                    'text' => 'Se ha registrado tu horario de atención con éxito!',
                    'icon' => 'success'
                ]);

                $this->reset([
                    'fechaClick',
                    'id_user',
                    'fecha_inicio',
                    'fecha_fin',
                    'hora_inicio',
                    'hora_fin',
                    'fecha_hora_inicio',
                    'fecha_hora_fin',
                    'open'
                ]);
            }else{
                if(\Auth::user()->id_users_rol == 1){
                   $horario = Horario::create([
                        'id_user' => $this->psicoSelected,
                        'fecha_inicio' => $fecha_only,
                        'fecha_fin' => $fecha_only,
                        'hora_inicio' => $fech_hor_ini,
                        'hora_fin' => $fech_hor_fin,
                        'fecha_hora_inicio' => $fech_hor_ini,
                        'fecha_hora_fin' => $fech_hor_fin,
                    ]);
                    
                        
                    
                    $this->dispatchBrowserEvent('swal', [
                        'title' => 'Exito!', 
                        'text' => 'Se ha registrado tu horario de atención con éxito!',
                        'icon' => 'success'
                    ]);
    
                    $this->reset([
                        'fechaClick',
                        'id_user',
                        'fecha_inicio',
                        'fecha_fin',
                        'hora_inicio',
                        'hora_fin',
                        'fecha_hora_inicio',
                        'fecha_hora_fin',
                        'open'
                    ]);
                }
            }
            
    }

    public function editHorario($horario, $id){
        //dd($horario, $id);
        $horario_find = Horario::find($id);
        //dd($horario_find);
        $this->horario_id = $horario_find->id;
        $this->hora_inicio = Carbon::parse($horario['start'])->format('H:i');
        $this->hora_fin = Carbon::parse($horario['end'])->format('H:i');
    }

    public function cancelarEdit(){
        $this->openEditModal = false;
    }

    public function updateHorario($editHoraIni, $editHoraFin){
        //dd($editHoraIni, $editHoraFin);
        $horario_update = Horario::find($this->horario_id);
        //dd($this->horario_id , $horario_update);

        $hora_ini = Carbon::parse($editHoraIni)->addSeconds('00')->format('H:i:s');
        $hora_end = Carbon::parse($editHoraFin)->addSeconds('00')->format('H:i:s');

        $fech_horario_res = Carbon::createFromFormat('Y-m-d H:i:s', $horario_update->fecha_hora_inicio)->format('Y-m-d');
        //dd($hora_ini, $hora_end, $fech_horario_res);

        $fech_hor_ini = Carbon::createFromFormat('Y-m-d H:i:s',$fech_horario_res . ' ' . $hora_ini);
        $fech_hor_fin = Carbon::createFromFormat('Y-m-d H:i:s',$fech_horario_res . ' ' . $hora_end);

        //dd($fech_hor_ini , $fech_hor_fin);

        $horario_update->update([
            'hora_inicio' => $fech_hor_ini,
            'hora_fin' => $fech_hor_fin,
            'fecha_hora_inicio' => $fech_hor_ini,
            'fecha_hora_fin' => $fech_hor_fin,
        ]);

        //dd($horario_update);

        $this->reset([
            'fecha_inicio',
            'fecha_fin',
            'hora_inicio',
            'hora_fin',
            'fecha_hora_inicio',
            'fecha_hora_fin',
            'horario_id',
            'openEditModal'
        ]);

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Exito!', 
            'text' => 'Los datos de la reserva han sido actualizados exitosamente!',
            'icon' => 'success'
        ]);

    }

    public function destroyHorario(){
        $destroyHorario = Horario::find($this->horario_id);
        //dd($destroyHorario);
        $destroyHorario->delete();

        $this->reset([
            'fecha_inicio',
            'fecha_fin',
            'hora_inicio',
            'hora_fin',
            'fecha_hora_inicio',
            'fecha_hora_fin',
            'horario_id',
            'openDelModal'
        ]);

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Exito!', 
            'text' => 'Los datos de la reserva han sido eliminados exitosamente!',
            'icon' => 'success'
        ]);

    }

    public function cancelarDel(){
        $this->openDelModal = false;
    }
}
