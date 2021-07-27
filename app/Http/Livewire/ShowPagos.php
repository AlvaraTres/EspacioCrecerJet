<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pago;
use DB;
use Carbon\Carbon;

class ShowPagos extends Component
{

    public $from;
    public $to;

    public function render()
    {
        $filter_from = Carbon::parse('1900-01-01 00:00:00')->format('Y-m-d H:i:s');
        $filter_to = Carbon::parse('2050-01-01 23:59:00')->format('Y-m-d H:i:s');
        if($this->from != null){
            $filter_from = Carbon::parse($this->from)->format('Y-m-d H:i:s');
            //dd($filter_from);
        }

        if($this->to != null){
            $filter_to = Carbon::parse($this->to .'23:59:00')->format('Y-m-d H:i:s');
            //dd($filter_to);
        }

        //dd($filter_from);
        
        $pagos = DB::table('pagos')
                ->join('pacientes', 'pacientes.id', '=', 'pagos.id_paciente')
                ->join('reservas', 'reservas.id', '=' , 'pagos.id_reserva')
                ->join('users', 'users.id', '=', 'reservas.id_usuario')
                ->select(DB::raw('CONCAT(users.nombre_usuario, \' \', users.apellido_pat_usuario, \' \', users.apellido_mat_usuario) AS psicologo'), DB::raw('CONCAT(pacientes.nombre_paciente, \' \', pacientes.ap_pat_paciente, \' \', pacientes.ap_mat_paciente) AS paciente'), 'pagos.*')
                ->whereBetween('pagos.fecha_pago', [$filter_from, $filter_to])
                ->get();
                
        return view('livewire.show-pagos', compact('pagos'));
    }
}
