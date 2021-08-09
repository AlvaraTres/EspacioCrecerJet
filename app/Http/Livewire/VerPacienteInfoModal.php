<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;
use Carbon\Carbon;

class VerPacienteInfoModal extends Component
{
    public $paciente;
    public $open = false;

    public function mount($paciente){
        $this->paciente = $paciente;
    }

    public function render()
    {
        
        $ver_paciente = Paciente::find($this->paciente->id);

        //calcular Edad
        $fecha_actual = Carbon::now('America/Santiago');
        $anio_actual = Carbon::parse($ver_paciente->fecha_nacimiento_paciente);
        $edad_calculada = $anio_actual->diffInYears($fecha_actual);
         
        return view('livewire.ver-paciente-info-modal', compact('ver_paciente', 'edad_calculada'));
    }

    
}
