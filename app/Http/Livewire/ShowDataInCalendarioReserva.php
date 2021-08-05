<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;
use App\Models\User;

class ShowDataInCalendarioReserva extends Component
{
    public $selectedPsico;

    public function render()
    {
        if(\Auth::user()->id_users_rol == 3){
            $datos = DB::table('reservas')
                    ->join('users', 'users.id', '=', 'reservas.id_usuario')
                    ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                    ->select('users.*', 'pacientes.*')
                    ->where('users.id', '=', \Auth::user()->id)
                    ->first();

            $paciente = DB::table('pacientes')
                            ->join('users', 'users.rut_usuario', '=', 'pacientes.rut_paciente')
                            ->select('users.*', 'pacientes.*')
                            ->where('pacientes.rut_paciente', '=', \Auth::user()->rut_usuario)
                            ->first();  

            $filtPsico = User::select(DB::raw('CONCAT(users.nombre_usuario, \' \', users.apellido_pat_usuario) AS psicologo'), 'users.id')->orderBy('users.id', 'ASC')->get();
            
        }


        return view('livewire.show-data-in-calendario-reserva', compact('datos', 'paciente', 'filtPsico'));
    }

    
}
