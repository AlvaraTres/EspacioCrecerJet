<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;

class EditPaciente extends Component
{
    public $openEditPacienteModal = false;
    public $paciente;

    protected $rules = [
        'paciente.rut_paciente' => 'required',
        'paciente.nombre_paciente' => 'required',
        'paciente.ap_pat_paciente' => 'required',
        'paciente.ap_mat_paciente' => 'required',
        'paciente.profesion' => 'required',
        'paciente.telefono_paciente' => 'required',
        'paciente.email' => 'required',
        'paciente.fecha_nacimiento_paciente' => 'required',
        'paciente.alergia' => 'required',
    ];

    public function mount(Paciente $paciente){
        $this->paciente = $paciente;
    }

    public function render()
    {
        return view('livewire.edit-paciente');
    }

    public function updatePaciente(){
        $this->validate();
        $this->paciente->save();

        $this->reset(['openEditPacienteModal']);

        $this->emitTo('show-pacientes', 'render');

        $this->emit('alert', 'El paciente ha sido actualizado exitosamente.');
    }
}
