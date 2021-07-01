<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Roleuser;

class ShowRoles extends Component
{
    public $search;
    public $sort = 'id';
    public $direction = 'asc';

    protected $listeners = ['render_add_rol' => 'render'];

    public function render()
    {
        $roles_users = Roleuser::where('tipo_usuario', 'like', '%' . $this->search . '%')
                                ->orderBy($this->sort, $this->direction)                        
                                ->get();

        return view('livewire.show-roles', compact('roles_users'));
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
