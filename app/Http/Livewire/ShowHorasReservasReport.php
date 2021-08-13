<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DB;
use Carbon\Carbon;

class ShowHorasReservasReport extends Component
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
        $horasReservasAnio;
        $horasReservasMes = [];
        $anio = Carbon::now()->format('Y');
        $mes = Carbon::now()->format('m');
        $from = Carbon::now()->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        if($this->from != null){
            $from = Carbon::parse($this->from)->format('Y-m-d H:i:s');
        }
        if($this->to != null){
            $from = Carbon::parse($this->to)->format('Y-m-d H:i:s');
        }

        if($this->tipoFiltro != null){
            if($this->anioSelect != null){
                $this->enabledSelect = 1;

                $horasReservasMes = DB::table('reservas')
                                    ->select(DB::raw('HOUR(reservas.hora_reserva) as hora'), DB::raw('COUNT(id) as cont'))
                                    ->whereYear('reservas.fecha_reserva', '=', $this->anioSelect)
                                    ->groupBy('hora')
                                    ->get();
                
                if($this->mesSelect != null){
                    $horasReservasMes = DB::table('reservas')
                                        ->select(DB::raw('HOUR(reservas.hora_reserva) as hora'), DB::raw('COUNT(id) as cont'))
                                        ->whereYear('reservas.fecha_reserva', '=', $this->anioSelect)
                                        ->whereMonth('reservas.fecha_reserva', '=', $this->mesSelect)
                                        ->groupBy('hora')
                                        ->get();
                }
            }else{
                if($this->from != null)
                {
                    $horasReservasMes = DB::table('reservas')
                                        ->select(DB::raw('HOUR(reservas.hora_reserva) as hora'), DB::raw('COUNT(id) as cont'))
                                        ->whereBetween('reservas.fecha_reserva', [$from, $to])
                                        ->groupBy('hora')
                                        ->get();
                }
            }
        }else{
            $horasReservasMes = DB::table('reservas')
                            ->select(DB::raw('HOUR(reservas.hora_reserva) as hora'), DB::raw('COUNT(id) as cont'))
                            ->whereMonth('reservas.fecha_reserva', '=', $mes)
                            ->groupBy('hora')
                            ->get();
        }

        

        $puntos = [];
        $posicion = 0;
        
        if(count($horasReservasMes)>0)
        {
            foreach($horasReservasMes as $hrm)
            {
                $puntos[] = [
                    'name' => $hrm->hora,
                    'y' => floatval($hrm->cont)
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

        //dd($horaReservasMes, $date2->format('H:i:s'));
        //->whereTime('reservas.hora_reserva' , '=', $date2)

        return view('livewire.show-horas-reservas-report');
    }
}
