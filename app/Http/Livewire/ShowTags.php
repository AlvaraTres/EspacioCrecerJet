<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Livewire\WithPagination;
use App\Models\Tagtrastornomental;

class ShowTags extends Component
{
    use WithPagination;

    public $search;
    public $sort = 'id';
    public $direction = 'asc';

    public $tag;
    public $tag_id;
    public $nombre_tag, $descripcion;

    public $openEditTagModal = false;
    public $openDeleteTagModal = false;

    protected $rules = [
        'nombre_tag' => 'required',
        'descripcion' => 'required',
    ];

    protected $listeners = ['render_add_tag' => 'render'];

    public function render()
    {
        $tags = Tagtrastornomental::where('nombre_tag', 'like', '%'. $this->search .'%')->orderBy($this->sort, $this->direction)->paginate(10);

        return view('livewire.show-tags', compact('tags'));
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

    public function editTag($id){
        $tag = Tagtrastornomental::find($id);
        $this->tag_id = $tag->id;
        $this->nombre_tag = $tag->nombre_tag;
        $this->descripcion = $tag->descripcion;

        $this->openEditTagModal = true;
    }

    public function updateTag(){
        $this->validate();
        $tag = Tagtrastornomental::find($this->tag_id);

        $tag->update([
            'nombre_tag' => $this->nombre_tag,
            'descripcion' => $this->descripcion,
        ]);

        $this->reset([
            'tag',
            'tag_id',
            'nombre_tag',
            'descripcion',
            'openEditTagModal',
        ]);
    }

    public function deleteTag($id){
        $tag = Tagtrastornomental::find($id);
        $this->tag_id = $tag->id;
        $this->nombre_tag = $tag->nombre_tag;
        $this->descripcion = $tag->descripcion;
        $this->openDeleteTagModal = true;
    }

    public function destroyTag(){
        $tag = Tagtrastornomental::find($this->tag_id);
        $tag->delete();

        $this->reset([
            'tag',
            'tag_id',
            'nombre_tag',
            'descripcion',
            'openDeleteTagModal',
        ]);
    }
}
