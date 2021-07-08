<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;
use App\Models\User;

class DeletePaciente extends Component
{
    public $openDeleteModal = false;
    public $paciente; 
    public $user;

    public function mount(Paciente $paciente){
        $this->paciente = $paciente;
    }

    public function destroyPaciente(){
        $this->user = User::where('rut_usuario', '=', $this->paciente->rut_paciente)->first();
        $this->paciente->delete();
        $this->user->delete();

        $this->reset([
            'openDeleteModal',
        ]);
        $this->emitTo('show-pacientes', 'render');

        $this->emit('alert', 'El paciente ha sido eliminado exitosamente.');
    }

    public function render()
    {
        return view('livewire.delete-paciente');
    }
}
