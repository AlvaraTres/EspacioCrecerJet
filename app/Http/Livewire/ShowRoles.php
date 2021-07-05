<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Roleuser;

class ShowRoles extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'id';
    public $direction = 'asc';

    public $rol;
    public $rol_id;
    public $tipo_usuario;

    public $openEditModal = false;
    public $openDeleteModal = false;

    protected $rules = [
        'tipo_usuario' => 'required|max:50',
    ];

    protected $listeners = ['render_add_rol' => 'render'];

    public function render()
    {
        $rols = Roleuser::where('tipo_usuario', 'like', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)                        
                                ->paginate(5);

        return view('livewire.show-roles', compact('rols'));
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

    public function edit($id){
        $rol = Roleuser::find($id);
        $this->rol_id = $rol->id;
        $this->tipo_usuario = $rol->tipo_usuario;
        //$this->rol = $rol;
        $this->openEditModal = true;
        //dd($this->rol_id);
    }

    public function updateRol(){
        $this->validate();

        $rol = Roleuser::find($this->rol_id);

        $rol->update([
            'tipo_usuario' => $this->tipo_usuario,
        ]);

        $this->reset([
            'openEditModal',
            'rol_id',
            'rol',
            'tipo_usuario',
        ]);
    }

    public function delete($id){
        $rol = Roleuser::find($id);
        $this->rol_id = $rol->id;
        $this->tipo_usuario = $rol->tipo_usuario;
        $this->openDeleteModal = true;
    }

    public function destroyRol(){
        $rol = Roleuser::find($this->rol_id);
        $rol->delete();

        $this->reset([
            'openDeleteModal',
            'rol_id',
            'rol',
            'tipo_usuario',
        ]);
    }
}
