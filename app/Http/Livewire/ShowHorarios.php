<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Horario;
use DB;
use Carbon\Carbon;

class ShowHorarios extends Component
{
    public $open = false;
    public $openEditModal = false;
    public $openDelModal = false;

    public $events = '';

    public $horario_id, $fecha_inicio, $fecha_fin, $hora_inicio, $hora_fin, $fecha_hora_inicio, $fecha_hora_fin;

    public function render()
    {
        $events = DB::table('horarios')
                    ->select(DB::raw('CONCAT(DATE_FORMAT(horarios.fecha_hora_inicio, "%H:%i") , \' - \', DATE_FORMAT(horarios.fecha_hora_fin, "%H:%i")) as title'), 'horarios.fecha_hora_inicio as start', 'horarios.fecha_hora_fin as end')
                    ->get();

        //dd($events);
        $this->events = json_encode($events);

        return view('livewire.show-horarios');
    }

    public function storeHorario($date, $startTime, $endTime){
        $fecha_horario = Carbon::parse($date)->format('Y-m-d H:i:s');
        $fecha_only = Carbon::parse($date)->format('Y-m-d');
        //dd($fecha_horario);
        $fech_horario_res = Carbon::createFromFormat('Y-m-d H:i:s', $fecha_horario)->format('Y-m-d');

        $hora_ini = Carbon::parse($startTime)->addSeconds('00')->format('H:i:s');
        $hora_end = Carbon::parse($endTime)->addSeconds('00')->format('H:i:s');
        //dd($hora_ini, $hora_end);

        $fech_hor_ini = Carbon::createFromFormat('Y-m-d H:i:s',$fech_horario_res . ' ' . $hora_ini);
        $fech_hor_fin = Carbon::createFromFormat('Y-m-d H:i:s',$fech_horario_res . ' ' . $hora_end);
        //dd($fech_hor_ini, $fech_hor_fin);

        Horario::create([
            'fecha_inicio' => $fecha_only,
            'fecha_fin' => $fecha_only,
            'hora_inicio' => $fech_hor_ini,
            'hora_fin' => $fech_hor_fin,
            'fecha_hora_inicio' => $fech_hor_ini,
            'fecha_hora_fin' => $fech_hor_fin,
        ]);

        $this->reset([
            'fecha_inicio',
            'fecha_fin',
            'hora_inicio',
            'hora_fin',
            'fecha_hora_inicio',
            'fecha_hora_fin',
            'open'
        ]);

        return redirect()->to('/horarios');
    }

    public function editHorario($horario){
        $horario_find = Horario::where('fecha_hora_inicio', '=', $horario['start'])->first();
        //dd($horario_find);
        $this->horario_id = $horario_find->id;
        $this->hora_inicio = Carbon::parse($horario['start'])->format('H:i');
        $this->hora_fin = Carbon::parse($horario['end'])->format('H:i');
    }

    public function cancelarEdit(){
        $this->openEditModal = false;
        return redirect()->to('/horarios');
    }

    public function updateHorario($editHoraIni, $editHoraFin){
        //dd($editHoraIni, $editHoraFin);
        $horario_update = Horario::find($this->horario_id);

        $hora_ini = Carbon::parse($editHoraIni)->addSeconds('00')->format('H:i:s');
        $hora_end = Carbon::parse($editHoraFin)->addSeconds('00')->format('H:i:s');

        $fech_horario_res = Carbon::createFromFormat('Y-m-d H:i:s', $horario_update->fecha_hora_inicio)->format('Y-m-d');
        //dd($hora_ini, $hora_end, $fech_horario_res);

        $fech_hor_ini = Carbon::createFromFormat('Y-m-d H:i:s',$fech_horario_res . ' ' . $hora_ini);
        $fech_hor_fin = Carbon::createFromFormat('Y-m-d H:i:s',$fech_horario_res . ' ' . $hora_end);

        $horario_update->update([
            'hora_inicio' => $fech_hor_ini,
            'hora_fin' => $fech_hor_fin,
            'fecha_hora_inicio' => $fech_hor_ini,
            'fecha_hora_fin' => $fech_hor_fin,
        ]);

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

        return redirect()->to('/horarios');
    }

    public function destroyHorario(){
        $destroyHorario = Horario::find($this->horario_id);
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

        return redirect()->to('/horarios');
    }

    public function cancelarDel(){
        $this->openDelModal = false;
        return redirect()->to('/horarios');
    }
}
