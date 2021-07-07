<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Freshwork\ChileanBundle\Rut;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Roleuser;
use DB;

class ShowPacientes extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'id';
    public $direction = 'asc';

    public $paciente;
    public $paciente_id;
    public $user;
    public $user_id;
    public $edad_calculada;
    public $fecha_actual;
    public $anio_actual;

    //variables de paciente
    public $rut_paciente, $nombre_paciente, $ap_pat_paciente, $ap_mat_paciente, $profesion, $telefono_paciente, $email, $fecha_nacimiento_paciente, $alergia;

    //variables de usuario
    //public $rut_usuario, $nombre_usuario, $apellido_pat_usuario, $apellido_mat_usuario, $fecha_nacimiento, $telefono, $especialidad;

    public $openEditPacienteModal = false;
    public $openDeletePacienteModal = false;
    public $openVerPacienteModal = false;

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

    protected $listeners = ['render_add_paciente' => 'render'];

    public function render()
    {
        $pacientes = Paciente::where('nombre_paciente', 'like', '%'. $this->search .'%')->orderBy($this->sort, $this->direction)->paginate(10);
        
        return view('livewire.show-pacientes', compact('pacientes'));
    }

    public function order($sort){
        if ($this->sort == $sort) {
            if($this->direction == 'desc'){
                $this->direction = 'asc';
            }else{
                $this->direction = 'desc';
            }
        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function editPaciente($id){
        $paciente = Paciente::find($id);
        $this->paciente_id = $paciente->id;
        $this->rut_paciente = $paciente->rut_paciente; 
        $this->nombre_paciente = $paciente->nombre_paciente; 
        $this->ap_pat_paciente = $paciente->ap_pat_paciente; 
        $this->ap_mat_paciente = $paciente->ap_mat_paciente; 
        $this->profesion = $paciente->profesion; 
        $this->telefono_paciente = $paciente->telefono_paciente; 
        $this->email = $paciente->email; 
        $this->fecha_nacimiento_paciente = $paciente->fecha_nacimiento_paciente; 
        $this->alergia = $paciente->alergia;

        $this->openEditPacienteModal = true;

    }

    public function updatePaciente(){
        $this->validate();

        $paciente = Paciente::find($this->paciente_id);

        $user = User::where('rut_usuario', '=', $paciente->rut_paciente)->first();
        $this->user_id = $user->id;
        $user = User::find($this->user_id);

        $paciente->update([
            'rut_paciente' => $this->rut_paciente,
            'nombre_paciente' => $this->nombre_paciente,
            'ap_pat_paciente' => $this->ap_pat_paciente,
            'ap_mat_paciente' => $this->ap_mat_paciente,
            'profesion' => $this->profesion,
            'telefono_paciente' => $this->telefono_paciente,
            'email' => $this->email,
            'fecha_nacimiento_paciente' => $this->fecha_nacimiento_paciente,
            'alergia' => $this->alergia,
        ]);
        
        $user->update([
            'rut_usuario' => $this->rut_paciente,
            'nombre_usuario' => $this->nombre_paciente,
            'apellido_pat_usuario' => $this->ap_pat_paciente,
            'apellido_mat_usuario' => $this->ap_mat_paciente,
            'telefono' => $this->telefono_paciente,
            'email' => $this->email,
            'fecha_nacimiento' => $this->fecha_nacimiento_paciente,
        ]);

        $this->reset([
            'rut_paciente',
            'nombre_paciente',
            'ap_pat_paciente',
            'ap_mat_paciente',
            'profesion',
            'telefono_paciente',
            'email',
            'fecha_nacimiento_paciente',
            'alergia',
            'paciente',
            'paciente_id',
            'user',
            'user_id',
            'openEditPacienteModal',
        ]);
    }

    public function deletePaciente($id){
        $paciente = Paciente::find($id);
        $this->paciente_id = $paciente->id;

        $user = User::where('rut_usuario', '=', $paciente->rut_paciente)->first();
        $this->user_id = $user->id;

        $this->openDeletePacienteModal = true;
    }

    public function destroyPaciente(){
        $paciente = Paciente::find($this->paciente_id);
        $user = User::find($this->user_id);

        $paciente->delete();
        $user->delete();

        $this->reset([
            'openDeletePacienteModal',
            'paciente',
            'paciente_id',
            'user',
            'user_id',
        ]);
    }

    public function verPaciente($id){
        $paciente = Paciente::find($id);
        $this->paciente_id = $paciente->id;
        $this->rut_paciente = $paciente->rut_paciente; 
        $this->nombre_paciente = $paciente->nombre_paciente; 
        $this->ap_pat_paciente = $paciente->ap_pat_paciente; 
        $this->ap_mat_paciente = $paciente->ap_mat_paciente; 
        $this->profesion = $paciente->profesion; 
        $this->telefono_paciente = $paciente->telefono_paciente; 
        $this->email = $paciente->email; 
        $this->fecha_nacimiento_paciente = $paciente->fecha_nacimiento_paciente; 
        $this->alergia = $paciente->alergia;

        //calcular Edad
        $this->fecha_actual = Carbon::now('America/Santiago');
        $this->anio_actual = Carbon::parse($this->fecha_nacimiento_paciente);
        $this->edad_calculada = $this->anio_actual->diffInYears($this->fecha_actual);
        //dd($this->edad_calculada); 

        $this->openVerPacienteModal = true;
    }
}
