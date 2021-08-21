<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Freshwork\ChileanBundle\Rut;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\Roleuser;
use App\Models\User;
use DB;

class ShowPsicologos extends Component
{
    use WithPagination;
    
    public $search;
    public $sort = 'id';
    public $direction = 'asc';

    public $psicologo;
    public $psicologo_id;
    public $rut_usuario, $nombre_usuario, $apellido_pat_usuario, $apellido_mat_usuario, $fecha_nacimiento, $telefono, $email, $formacion;

    public $openEditPsicologoModal = false;
    public $openDeletePsicologoModal = false;
    public $openVerPsicologoModal = false;

    protected $rules = [
        'rut_usuario' => 'required',
        'nombre_usuario' => 'required',
        'apellido_pat_usuario' => 'required',
        'apellido_mat_usuario' => 'required',
        'telefono' => 'required',
        'email' => 'required|email',
        'formacion' => 'required',
        'fecha_nacimiento' => 'required',
    ];

    protected $listeners = ['render_add_psicologo' => 'render'];

    public function render()
    {
        $psicologos = DB::table('users')
                    ->join('roles_users', 'users.id_users_rol', '=', 'roles_users.id')
                    ->where('roles_users.id', '=', 2)
                    ->where('nombre_usuario', 'like', '%' . $this->search . '%')
                    ->select('users.*')
                    ->orderBy($this->sort, $this->direction)
                    ->paginate(10);

        return view('livewire.show-psicologos', compact('psicologos'));
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

    public function editPsicologo($id){
        $psicologo = User::find($id);
        $this->psicologo_id = $psicologo->id;
        $this->rut_usuario = $psicologo->rut_usuario; 
        $this->nombre_usuario = $psicologo->nombre_usuario; 
        $this->apellido_pat_usuario = $psicologo->apellido_pat_usuario; 
        $this->apellido_mat_usuario = $psicologo->apellido_mat_usuario; 
        $this->telefono = $psicologo->telefono; 
        $this->email = $psicologo->email; 
        $this->formacion = $psicologo->formacion;
        $this->fecha_nacimiento = $psicologo->fecha_nacimiento;
        
        $this->openEditPsicologoModal = true;
    }

    public function updatePsicologo(){
        $this->validate();

        $psicologo = User::find($this->psicologo_id);

        $psicologo->update([
            'rut_usuario' => $this->rut_usuario,
            'nombre_usuario' => $this->nombre_usuario,
            'apellido_pat_usuario' => $this->apellido_pat_usuario,
            'apellido_mat_usuario' => $this->apellido_mat_usuario,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'formacion' => $this->formacion,
            'fecha_nacimiento' => Carbon::parse($this->fecha_nacimiento),
        ]);

        $this->reset([
            'rut_usuario',
            'nombre_usuario',
            'apellido_pat_usuario',
            'apellido_mat_usuario',
            'telefono',
            'email',
            'formacion',
            'fecha_nacimiento',
            'psicologo',
            'openEditPsicologoModal'
        ]);

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Exito!', 
            'text' => 'El perfil de psicológo fue registrado con éxito!',
            'icon' => 'success'
        ]);
    }

    public function deletePsicologo($id){
        $psicologo = User::find($id);
        $this->psicologo_id = $psicologo->id;
        $this->openDeletePsicologoModal = true;
    }

    public function destroyPsicologo(){
        $psicologo = User::find($this->psicologo_id);
        $psicologo->delete();

        $this->reset([
            'openDeletePsicologoModal',
            'psicologo_id',
            'psicologo',
        ]);

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Exito!', 
            'text' => 'El perfil de psicológo fue eliminado con éxito!',
            'icon' => 'success'
        ]);
    }

    public function verPsicologo($id){
        $psicologo = User::find($id);
        $this->rut_usuario = $psicologo->rut_usuario; 
        $this->nombre_usuario = $psicologo->nombre_usuario; 
        $this->apellido_pat_usuario = $psicologo->apellido_pat_usuario; 
        $this->apellido_mat_usuario = $psicologo->apellido_mat_usuario; 
        $this->telefono = $psicologo->telefono; 
        $this->email = $psicologo->email; 
        $this->formacion = $psicologo->formacion;
        $this->fecha_nacimiento = $psicologo->fecha_nacimiento;

        $this->openVerPsicologoModal = true;
    }
}
