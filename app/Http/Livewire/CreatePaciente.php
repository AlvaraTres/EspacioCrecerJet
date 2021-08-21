<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Freshwork\ChileanBundle\Rut;
use App\Models\User;
use App\Models\Paciente;
use Carbon\Carbon;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CreatePaciente extends Component
{
    use WithFileUploads;

    public $open = false;

    //variables de paciente
    public $rut_paciente, $nombre_paciente, $ap_pat_paciente, $ap_mat_paciente,  $telefono_paciente, $email, $fecha_nacimiento_paciente, $patologias_previas;
    public $profesion;
    public $certificado;
    public $inputCert = 0;

    protected $rules = [
        'rut_paciente' => 'required',
        'nombre_paciente' => 'required',
        'ap_pat_paciente' => 'required',
        'ap_mat_paciente' => 'required',
        'profesion' => 'required',
        'telefono_paciente' => 'required',
        'email' => 'required',
        'fecha_nacimiento_paciente' => 'required',
        'patologias_previas' => 'required',
    ];

    public function save(){
        //dd($this);
        $this->validate();

        $paci = Paciente::create([
            'rut_paciente' => $this->rut_paciente,
            'nombre_paciente' => $this->nombre_paciente,
            'ap_pat_paciente' => $this->ap_pat_paciente,
            'ap_mat_paciente' => $this->ap_mat_paciente,
            'profesion' => $this->profesion,
            'telefono_paciente' => $this->telefono_paciente,
            'email' => $this->email,
            'fecha_nacimiento_paciente' => $this->fecha_nacimiento_paciente,
            'patologias_previas' => $this->patologias_previas,
            'password' => bcrypt('123456'),
        ]);

        $nombre = $paci->nombre_paciente .' '.$paci->ap_pat_paciente;


        if($this->certificado != null){
            $file = $this->certificado->getClientOriginalName();
            //dd($file);
            $this->certificado->storeAs('certificado/' . $nombre, $file);
            $paci->update(['certificado' => $file]);
        }

        User::create([
            'id_users_rol' => 3,
            'rut_usuario' => $this->rut_paciente,
            'nombre_usuario' => $this->nombre_paciente,
            'apellido_pat_usuario' => $this->ap_pat_paciente,
            'apellido_mat_usuario' => $this->ap_mat_paciente,
            'telefono' => $this->telefono_paciente,
            'email' => $this->email,
            'formacion' => 'sin especificar',
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
            'patologias_previas',
        ]);

        $this->emit('render');
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Exito!', 
            'text' => 'El paciente fue registrado con éxito!',
            'icon' => 'success'
        ]);
    }

    public function updatedProfesion($value){
        if($value == 'estudiante'){
            $this->inputCert = 1;
        }else{
            $this->inputCert = 0;
        }
    }

    public function render()
    {
        return view('livewire.create-paciente');
    }
}
