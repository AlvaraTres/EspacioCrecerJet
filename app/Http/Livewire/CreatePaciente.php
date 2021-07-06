<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Freshwork\ChileanBundle\Rut;
use App\Models\User;
use App\Models\Paciente;
use Carbon\Carbon;

class CreatePaciente extends Component
{
    public $open = false;

    //variables de paciente
    public $rut_paciente, $nombre_paciente, $ap_pat_paciente, $ap_mat_paciente, $profesion, $telefono_paciente, $email, $fecha_nacimiento_paciente, $alergia;

    protected $rules = [
        'rut_paciente' => 'required',
        'nombre_paciente' => 'required',
        'ap_pat_paciente' => 'required',
        'ap_mat_paciente' => 'required',
        'profesion' => 'required',
        'telefono_paciente' => 'required',
        'email' => 'required',
        'fecha_nacimiento_paciente' => 'required',
        'alergia' => 'required',
    ];

    public function save(){
        //dd($this);
        $this->validate();

        Paciente::create([
            'rut_paciente' => $this->rut_paciente,
            'nombre_paciente' => $this->nombre_paciente,
            'ap_pat_paciente' => $this->ap_pat_paciente,
            'ap_mat_paciente' => $this->ap_mat_paciente,
            'profesion' => $this->profesion,
            'telefono_paciente' => $this->telefono_paciente,
            'email' => $this->email,
            'fecha_nacimiento_paciente' => $this->fecha_nacimiento_paciente,
            'alergia' => $this->alergia,
            'password' => bcrypt('123456'),
        ]);

        User::create([
            'id_users_rol' => 3,
            'rut_usuario' => $this->rut_paciente,
            'nombre_usuario' => $this->nombre_paciente,
            'apellido_pat_usuario' => $this->ap_pat_paciente,
            'apellido_mat_usuario' => $this->ap_mat_paciente,
            'telefono' => $this->telefono_paciente,
            'email' => $this->email,
            'especialidad' => 'Sin especialidad',
            'fecha_nacimiento' => $this->fecha_nacimiento_paciente,
            'password' => bcrypt('123456'),
        ]);

        $this->reset([
            'open',
            'rut_paciente', 
            'nombre_paciente', 
            'ap_pat_paciente', 
            'ap_mat_paciente',
            'profesion', 
            'telefono_paciente', 
            'email', 
            'fecha_nacimiento_paciente', 
            'alergia',
        ]);

        $this->emit('render_add_paciente');
        $this->emit('alert', 'El perfil de paciente se ha creado correctamente.');
    }

    public function render()
    {
        return view('livewire.create-paciente');
    }
}
