<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;
use PDF;

class EnlistarFichasModal extends Component
{
    public $openVerFichasModal = false;
    public $paciente;

    public function render()
    {
        $ficha_paciente = DB::table('fichas_pacientes')
                    ->join('users', 'users.id', '=', 'fichas_pacientes.id_usuario')
                    ->join('pacientes', 'pacientes.id', '=', 'fichas_pacientes.id_paciente')
                    ->where('users.id', '=', 2)
                    ->where('pacientes.id', '=', $this->paciente->id)
                    ->select('fichas_pacientes.*')
                    ->get();

        return view('livewire.enlistar-fichas-modal', compact('ficha_paciente'));
    }

    public function verFichasPaciente(){
        $this->ficha_paciente = DB::table('fichas_pacientes')
                    ->join('users', 'users.id', '=', 'fichas_pacientes.id_usuario')
                    ->join('pacientes', 'pacientes.id', '=', 'fichas_pacientes.id_paciente')
                    ->where('users.id', '=', 2)
                    ->where('pacientes.id', '=', 1)
                    ->select('fichas_pacientes.*')
                    ->get();
        
        //dd($fichas);
        $this->cuenta_fichas = $this->ficha_paciente->count();
        
        
        $this->openVerPacienteModal = false;
        $this->openVerFichasModal = true;
    }

    public function fichaPacientePdf(){
        $ficha_pdf = PDF::loadView('livewire.fichaPdf');
        return $ficha_pdf->download('ficha.pdf');
    }
}
