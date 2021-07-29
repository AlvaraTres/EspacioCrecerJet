<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Freshwork\ChileanBundle\Rut;
use App\Models\User;
use Carbon\Carbon;

class CreatePsicologo extends Component
{
    public $open = false;

    public $rut_usuario, $nombre_usuario, $apellido_pat_usuario, $apellido_mat_usuario, $fecha_nacimiento, $telefono, $email, $especialidad, $password;

    public $fecha;
    protected $rules = [
        'rut_usuario' => 'required',
        'nombre_usuario' => 'required',
        'apellido_pat_usuario' => 'required',
        'apellido_mat_usuario' => 'required',
        'telefono' => 'required',
        'email' => 'required|email',
        'especialidad' => 'required',
        'fecha_nacimiento' => 'required',
        'password' => 'required'
    ];

    public function save(){
        //$this->fecha = Carbon::parse($this->fecha_nacimiento);
        //dd($this->fecha);
        //if(Rut::parse($this->rut_usuario)->quiet()->validate() == false){
        //    dd("rut falso");
        //}else{
        //    dd("rut true");
        //}
        
        $this->validate();

        User::create([
            'id_users_rol' => 2,
            'rut_usuario' => $this->rut_usuario,
            'nombre_usuario' => $this->nombre_usuario,
            'apellido_pat_usuario' => $this->apellido_pat_usuario,
            'apellido_mat_usuario' => $this->apellido_mat_usuario,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'especialidad' => $this->especialidad,
            'fecha_nacimiento' => Carbon::parse($this->fecha_nacimiento),
            'password' => bcrypt($this->password),
        ]);

        $this->reset([
            'open',
            'rut_usuario',
            'nombre_usuario',
            'apellido_pat_usuario',
            'apellido_mat_usuario',
            'telefono',
            'email',
            'especialidad',
            'fecha_nacimiento',
            'password',
        ]);
        
        $this->emit('render_add_psicologo');
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Exito!', 
            'text' => 'El perfil de psicólogo se ha creado correctamente.',
            'icon' => 'success'
        ]);
    }

    public function render()
    {
        return view('livewire.create-psicologo');
    }
}
