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
        
        $this->user->suspended_account = 1;
        $this->user->save();

        $this->paciente->suspended_account = 1;
        $this->paciente->save();

        $this->reset([
            'openDeleteModal',
        ]);
        $this->emitTo('show-pacientes','render');

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Exito!', 
            'text' => 'La cuenta del paciente seleccionado ha sido desactivada correctamente.',
            'icon' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.delete-paciente');
    }
}
