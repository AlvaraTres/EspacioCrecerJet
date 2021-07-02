<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Roleuser;


class EditRol extends Component
{
    public $open = false;

    public $tipo_usuario;

    public function save(){
        $this->reset([
            'open',
            'tipo_usuario',
        ]);
    }

    public function render()
    {
        return view('livewire.edit-rol');
    }
}
