<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Roleuser;

class CreateRol extends Component
{
    public $open = false;

    public $tipo_usuario;

    protected $rules = [
        'tipo_usuario' => 'required|max:50',
    ];

    public function save(){
        $this->validate();

        Roleuser::create([
            'tipo_usuario' => $this->tipo_usuario,
        ]);

        $this->reset([
            'open',
            'tipo_usuario',
        ]);
        
        $this->emit('render_add_rol');
        $this->emit('alert', 'El post se ha creado correctamente.');
    }

    public function render()
    {
        return view('livewire.create-rol');
    }
}
