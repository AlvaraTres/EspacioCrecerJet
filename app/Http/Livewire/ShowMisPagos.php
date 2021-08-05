<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pago;
use App\Models\Paciente;
use DB;

class ShowMisPagos extends Component
{
    public function render()
    {
        $paciente = Paciente::where('rut_paciente', \Auth::user()->rut_usuario)->first();

        $misPagos = DB::table('pagos')
                        ->join('reservas', 'reservas.id', '=', 'id_reserva')
                        ->join('users', 'users.id', '=', 'reservas.id_usuario')
                        ->select(DB::raw('CONCAT(users.nombre_usuario, \' \', users.apellido_pat_usuario, \' \', users.apellido_mat_usuario) AS psicologo'), 'reservas.fecha_reserva', 'pagos.*')
                        ->where('pagos.id_paciente', '=', $paciente->id)
                        ->get();

        return view('livewire.show-mis-pagos', compact('paciente', 'misPagos'));
    }
}
