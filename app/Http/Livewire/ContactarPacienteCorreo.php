<?php

namespace App\Http\Livewire;

use App\Models\Paciente;
use App\Models\User;
use Livewire\Component;
use App\Mail\ContactarPacienteMailable;
use Illuminate\Support\Facades\Mail;

class ContactarPacienteCorreo extends Component
{
    public $paciente;

    public $open = false;

    public $asunto;
    public $cuerpo;

    public function mount(Paciente $paciente){
        $this->paciente = $paciente;
    }

    public function render()
    {
        return view('livewire.contactar-paciente-correo');
    }

    public function updatedAsunto($value){
        //dd($value);
    }

    public function updatedCuerpo($value){
        //dd($value);
    }

    public function enviarMail()
    {
        $psicolog = User::find(\Auth::user()->id);

        //dd($psicologNombre, $this->asunto , $this->cuerpo);

        $correo = new ContactarPacienteMailable($psicolog, $this->paciente,$this->asunto, $this->cuerpo);
        Mail::to($this->paciente->email)->send($correo);
    
        $this->reset([
            'open',
            'asunto',
            'cuerpo'
        ]);

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Exito!',
            'text' => 'El correo se ha enviado correctamente',
            'icon' => 'success'
        ]);
    }
}
