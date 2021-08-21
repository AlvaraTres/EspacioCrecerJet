<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;
use App\Models\User;

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
        'paciente.patologias_previas' => 'required',
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

        $user = User::where('rut_usuario', '=', $this->paciente->rut_paciente)->first();
        $user_id = $user->id;
        $user = User::find($user_id);


        $user->update([
            'rut_usuario' => $this->paciente->rut_paciente,
            'nombre_usuario' => $this->paciente->nombre_paciente,
            'apellido_pat_usuario' => $this->paciente->ap_pat_paciente,
            'apellido_mat_usuario' => $this->paciente->ap_mat_paciente,
            'telefono' => $this->paciente->telefono_paciente,
            'email' => $this->paciente->email,
            'fecha_nacimiento' => $this->paciente->fecha_nacimiento_paciente,
        ]);

        $this->reset(['openEditPacienteModal']);

        $this->emitTo('show-pacientes','render');

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Exito!', 
            'text' => 'El perfil de paciente se ha modificado correctamente.',
            'icon' => 'success'
        ]);
    }
}
