<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reserva;
use App\Models\User;
use App\Models\Paciente;
use DB;
use Carbon\Carbon;


class ShowReservasReportPsicologos extends Component
{
    public $data;
    public $tipoFiltro;
    public $from;
    public $to;
    public $anioSelect;
    public $mesSelect;
    public $enabledSelect;

    public function render()
    {
        $psicoAnio;
        $psicoMes = [];
        $anio = Carbon::now()->format('Y');
        $mes = Carbon::now()->format('m');
        $from = Carbon::now()->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        if($this->from  != null){
            $from = Carbon::parse($this->from)->format('Y-m-d H:i:s');
        }

        if($this->to != null){
            $to = Carbon::parse($this->to)->format('Y-m-d H:i:s');
        }

        if($this->tipoFiltro != null)
        {
            if($this->anioSelect != null)
            {
                $this->enabledSelect = 1;

                $psicoMes = DB::table('reservas')
                            ->join('users', 'users.id', '=', 'reservas.id_usuario')
                            ->select(DB::raw("DATE_FORMAT(reservas.fecha_hora_reserva, '%M %Y %m') as meses"), DB::raw('CONCAT(users.nombre_usuario, \' \', users.apellido_pat_usuario) AS nombre'), DB::raw('COUNT(reservas.id_usuario) as cont'))
                            ->whereYear('reservas.fecha_hora_reserva', '=', $this->anioSelect)
                            ->groupBy('meses', 'nombre')
                            ->get();
                
                if($this->mesSelect != null){
                    $psicoMes = DB::table('reservas')
                            ->join('users', 'users.id', '=', 'reservas.id_usuario')
                            ->select(DB::raw("DATE_FORMAT(reservas.fecha_hora_reserva, '%M %Y %m') as meses"), DB::raw('CONCAT(users.nombre_usuario, \' \', users.apellido_pat_usuario) AS nombre'), DB::raw('COUNT(reservas.id_usuario) as cont'))
                            ->whereYear('reservas.fecha_hora_reserva', '=', $this->anioSelect)
                            ->whereMonth('reservas.fecha_hora_reserva', '=', $this->mesSelect)
                            ->groupBy('meses', 'nombre')
                            ->get();
                }
            }else{
                if($this->from != null){
                    $psicoMes = DB::table('reservas')
                            ->join('users', 'users.id', '=', 'reservas.id_usuario')
                            ->select(DB::raw("DATE_FORMAT(reservas.fecha_hora_reserva, '%M %Y %m') as meses"), DB::raw('CONCAT(users.nombre_usuario, \' \', users.apellido_pat_usuario) AS nombre'), DB::raw('COUNT(reservas.id_usuario) as cont'))
                            ->whereBetween('reservas.fecha_hora_reserva', [$from , $to])
                            ->groupBy('meses', 'nombre')
                            ->get();
                }
            }
        }else{
            $psicoAnio = DB::table('reservas')
            ->join('users', 'users.id', '=', 'reservas.id_usuario')
            ->select(DB::raw('YEAR(reservas.fecha_hora_reserva) as anio'), DB::raw('CONCAT(users.nombre_usuario, \' \', users.apellido_pat_usuario) AS nombre'), DB::raw('COUNT(reservas.id_usuario) as cont'))
            ->whereYear('reservas.fecha_hora_reserva', '=', $anio)
            ->groupBy('anio', 'nombre')
            ->get();

            $psicoMes = DB::table('reservas')
                        ->join('users', 'users.id', '=', 'reservas.id_usuario')
                        ->select(DB::raw("DATE_FORMAT(reservas.fecha_hora_reserva, '%M %Y %m') as meses"), DB::raw('CONCAT(users.nombre_usuario, \' \', users.apellido_pat_usuario) AS nombre'), DB::raw('COUNT(reservas.id_usuario) as cont'))
                        ->whereYear('reservas.fecha_hora_reserva', '=', $anio)
                        ->whereMonth('reservas.fecha_hora_reserva', '=', $mes)
                        ->groupBy('meses', 'nombre')
                        ->get();

            //dd($psicoMes);
                    }

        

        $suma = 0;

        for($i=0; $i<count($psicoMes); $i++){
            $suma = $suma + (int)$psicoMes[$i]->cont;
        }
        //dd($psicoMes, $suma, $anio, $mes);

        $porcentaje = [];
        for($i=0; $i<count($psicoMes); $i++){
            $porcentaje[$i] = number_format($psicoMes[$i]->cont/$suma, 2, '.', ',');
        }

        //dd($porcentaje);

        $puntos = [];
        $posicion = 0;
        if(count($psicoMes)>0){
            foreach($psicoMes as $pm){
                $puntos[] = [
                    'name' => $pm->nombre,
                    'y' => floatval($pm->cont)
                ];
                $posicion++;
            }
        }else{
            $puntos[] = [
                'name' => 'No hay registros para mostrar',
                'y' => floatval(1)
            ];
        }

        $this->data = json_encode($puntos);

        return view('livewire.show-reservas-report-psicologos');
    }

    public function resetFilt(){
        $this->reset([
            'tipoFiltro',
            'from',
            'to',
            'anioSelect',
            'mesSelect'
        ]);
    }
}
