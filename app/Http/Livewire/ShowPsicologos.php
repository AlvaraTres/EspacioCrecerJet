<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
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
    public $rut_usuario, $nombre_usuario, $apellido_pat_usuario, $apellido_mat_usuario, $telefono, $email, $especialidad;

    public $openEditModal = false;
    public $openDeleteModal = false;

    protected $rules = [
        'rut_usuario' => 'required',
        'nombre_usuario' => 'required',
        'apellido_pat_usuario' => 'required',
        'apellido_mat_usuario' => 'required',
        'telefono' => 'required',
        'email' => 'required|email',
        'especialidad' => 'required',
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

}
