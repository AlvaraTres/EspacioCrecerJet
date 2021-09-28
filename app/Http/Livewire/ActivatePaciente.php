<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;

class ActivatePaciente extends Component
{
    public $openActivateModal = false;
    public $paciente; 
    public $user;

    public function mount(Paciente $paciente){
        $this->paciente = $paciente;
    }

    public function activatePaciente(){
        $this->user = User::where('rut_usuario', '=', $this->paciente->rut_paciente)->first();
        
        $this->user->suspended_account = 0;
        $this->user->save();

        $this->paciente->suspended_account = 0;
        $this->paciente->save();

        $this->reset([
            'openActivateModal',
        ]);
        $this->emitTo('show-pacientes','render');

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Exito!', 
            'text' => 'La cuenta del paciente seleccionado ha sido activada correctamente.',
            'icon' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.activate-paciente');
    }
}
