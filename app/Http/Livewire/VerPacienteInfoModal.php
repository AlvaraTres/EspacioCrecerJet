<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class VerPacienteInfoModal extends Component
{
    public $paciente;
    public $open = false;

    public function render()
    {
        $ver_paciente = Paciente::find($this->paciente->id);

        //calcular Edad
        $fecha_actual = Carbon::now('America/Santiago');
        $anio_actual = Carbon::parse($ver_paciente->fecha_nacimiento_paciente);
        $edad_calculada = $anio_actual->diffInYears($fecha_actual);
         
        return view('livewire.ver-paciente-info-modal', compact('ver_paciente', 'edad_calculada'));
    }

    public function downloadCertificado($paciente_id)
    {
        $paciente = Paciente::find($paciente_id);
        $nombre = $paciente->nombre_paciente .' '.$paciente->ap_pat_paciente;
        
        if(Storage::disk('local')->exists("certificado/$nombre/$paciente->certificado")){
            $path = Storage::disk('local')->path("certificado/$nombre/$paciente->certificado");
            return response()->download($path);
        }else{
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!', 
                'text' => 'Ha ocurrido un error!, El archivo solicitado no existe o está dañado.',
                'icon' => 'error'
            ]);
            return redirect('/404');
        }
    }
}
