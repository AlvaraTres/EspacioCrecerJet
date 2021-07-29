<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tagtrastornomental;

class CreateTag extends Component
{
    public $open = false;

    public $nombre_tag, $descripcion;

    protected $rules = [
        'nombre_tag' => 'required',
        'descripcion' => 'required',
    ];

    public function save(){
        $this->validate();

        Tagtrastornomental::create([
            'nombre_tag' => $this->nombre_tag,
            'descripcion' => $this->descripcion,
        ]);

        $this->reset([
            'open',
            'nombre_tag',
            'descripcion',
        ]);

        $this->emit('render_add_tag');
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Exito!', 
            'text' => 'El tag se ha creado con éxito!.',
            'icon' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.create-tag');
    }
}
