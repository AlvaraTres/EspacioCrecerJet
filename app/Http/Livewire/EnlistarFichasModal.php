<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;
use Carbon\Carbon;
use DB;
use PDF;

class EnlistarFichasModal extends Component
{
    public $openVerFichasModal = false;
    public $paciente;
    public $paciente_rut;
    public $count_fichas=1;

    public function mount(Paciente $paciente){
        $this->paciente = $paciente;
    }

    public function render()
    {
        $ficha_paciente = DB::table('fichas_pacientes')
                    ->join('users', 'users.id', '=', 'fichas_pacientes.id_usuario')
                    ->join('pacientes', 'pacientes.id', '=', 'fichas_pacientes.id_paciente')
                    ->where('users.id', '=', 1) //cambiar a psicologo que este en el sistema
                    ->where('pacientes.id', '=', $this->paciente->id)
                    ->select('fichas_pacientes.*')
                    ->get();
        $this->count_fichas = 2;

        return view('livewire.enlistar-fichas-modal', compact('ficha_paciente'));
    }

    public function fichaPacientePdf($ficha_id){
        //dd($ficha_id);
        $datos_ficha = DB::table('fichas_pacientes')
                        ->join('users', 'users.id', '=', 'fichas_pacientes.id_usuario')
                        ->join('pacientes', 'pacientes.id', '=', 'fichas_pacientes.id_paciente')
                        ->where('fichas_pacientes.id', '=', $ficha_id)
                        ->select('fichas_pacientes.*', 'users.*', 'pacientes.*')
                        ->get();
        
        //dd($datos_ficha);
        foreach($datos_ficha as $datos){
            $this->paciente_rut = $datos->rut_paciente; 
        }
        //dd($this->paciente_rut);

        $find_paciente = Paciente::where('rut_paciente', '=', $this->paciente_rut)->first();
        //dd($find_paciente);
        $fecha_actual = Carbon::now('America/Santiago');
        $anio_actual = Carbon::parse($find_paciente->fecha_nacimiento_paciente);
        $edad_calculada = $anio_actual->diffInYears($fecha_actual);
        //dd($edad_calculada);
        
        //pasar imagen de fondo a base64 para que se pueda ver PDF
        $path = base_path('public/images/logo_opacidad_40.png'); //rescatar imagen
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);


        $ficha_pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('livewire.fichaPdf', compact('datos_ficha', 'pic', 'edad_calculada'));
        return $ficha_pdf->stream('ficha.pdf');
    }
}
