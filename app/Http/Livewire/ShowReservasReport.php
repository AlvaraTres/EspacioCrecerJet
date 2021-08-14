<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;
use App\Models\User;
use DB;
use Carbon\Carbon;

class ShowReservasReport extends Component
{
    public $from;
    public $to;
    public $psicologo;
    public $data;
    public $searchPaciente;
    public $searchPsico;

    public function render()
    {
        $reservas = [];

        $filter_from = Carbon::parse('2015-01-01 00:00:00')->format('Y-m-d H:i:s');
        $filter_to = Carbon::parse('2050-01-01 23:59:00')->format('Y-m-d H:i:s');

        $filterPaciente = Paciente::select(DB::raw('CONCAT(pacientes.nombre_paciente, \' \', pacientes.ap_pat_paciente) AS paciente'), 'pacientes.id')->get();

        $filterPsico = User::select(DB::raw('CONCAT(users.nombre_usuario, \' \', users.apellido_pat_usuario) as psicologo'), 'users.id')->where('users.id_users_rol', '=', 2)->get();

        if($this->searchPaciente == 0){
            $this->reset(['searchPaciente']);
        }
        if($this->searchPsico == 0){
            $this->reset(['searchPsico']);
        }
        if(\Auth::user()->id_users_rol == 2){
            $this->searchPsico = \Auth::user()->id;
        }
        if($this->searchPsico != null){

            $filterPaciente = DB::table('reservas')
                                ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                                ->select(DB::raw('CONCAT(pacientes.nombre_paciente, \' \', pacientes.ap_pat_paciente) AS paciente'), 'pacientes.id')
                                ->where('reservas.id_usuario', '=', $this->searchPsico)
                                ->distinct()
                                ->get();

            $totalReservasAnio = DB::table('reservas')
                                    ->select(DB::raw('YEAR(reservas.fecha_hora_reserva) as anio'), DB::raw('COUNT(*) as cont'))
                                    ->where('reservas.id_usuario', '=', $this->searchPsico)
                                    ->groupBy(DB::raw('YEAR(reservas.fecha_hora_reserva)'))
                                    ->get();

            $totalReservasMes = DB::table('reservas')
                                    ->select(DB::raw("DATE_FORMAT(reservas.fecha_hora_reserva, '%M %Y %m') as meses"), DB::raw('COUNT(*) as cont'))
                                    ->where('reservas.id_usuario', '=', $this->searchPsico)
                                    ->groupBy('meses')
                                    ->get();
                
            $totalReservasDia = DB::table('reservas')
                                    ->select(DB::raw("DATE_FORMAT(reservas.fecha_hora_reserva, '%M %Y %d') as dias"), DB::raw('COUNT(*) as cont'))
                                    ->where('reservas.id_usuario', '=', $this->searchPsico)
                                    ->groupBy('dias')
                                    ->get();

            if($this->searchPaciente){
                $totalReservasAnio = DB::table('reservas')
                                    ->select(DB::raw('YEAR(reservas.fecha_hora_reserva) as anio'), DB::raw('COUNT(*) as cont'))
                                    ->where('reservas.id_paciente', '=', $this->searchPaciente)
                                    ->groupBy(DB::raw('YEAR(reservas.fecha_hora_reserva)'))
                                    ->get();

                $totalReservasMes = DB::table('reservas')
                                    ->select(DB::raw("DATE_FORMAT(reservas.fecha_hora_reserva, '%M %Y %m') as meses"), DB::raw('COUNT(*) as cont'))
                                    ->where('reservas.id_paciente', '=', $this->searchPaciente)
                                    ->groupBy('meses')
                                    ->get();
                
                $totalReservasDia = DB::table('reservas')
                                        ->select(DB::raw("DATE_FORMAT(reservas.fecha_hora_reserva, '%M %Y %d') as dias"), DB::raw('COUNT(*) as cont'))
                                        ->where('reservas.id_paciente', '=', $this->searchPaciente)
                                        ->groupBy('dias')
                                        ->get();
            }
            
        }

        if($this->searchPaciente == null && $this->searchPsico == null){
            $totalReservasAnio = DB::table('reservas')
                           ->select(DB::raw('YEAR(reservas.fecha_hora_reserva) as anio'), DB::raw('COUNT(*) as cont'))
                           ->groupBy(DB::raw('YEAR(reservas.fecha_hora_reserva)'))
                           ->get();

            $totalReservasMes = DB::table('reservas')
                                ->select(DB::raw("DATE_FORMAT(reservas.fecha_hora_reserva, '%M %Y %m') as meses"), DB::raw('COUNT(*) as cont'))
                                ->groupBy('meses')
                                ->get();
            
            $totalReservasDia = DB::table('reservas')
                                ->select(DB::raw("DATE_FORMAT(reservas.fecha_hora_reserva, '%M %Y %d') as dias"), DB::raw('COUNT(*) as cont'))
                                ->groupBy('dias')
                                ->get();
        }

        //dd($totalReservasMes);

        for($i=0;$i<count($totalReservasMes);$i++){
            $explo = (explode(' ' , $totalReservasMes[$i]->meses));
            if($explo[0] == 'January'){
                $explo[0] = 'Enero';
                $totalReservasMes[$i]->meses = implode(' ' , $explo);
            }
            if($explo[0] == 'February'){
                $explo[0] = 'Febrero';
                $totalReservasMes[$i]->meses = implode(' ' , $explo);
            }
            if($explo[0] == 'March'){
                $explo[0] = 'Marzo';
                $totalReservasMes[$i]->meses = implode(' ' , $explo);
            }
            if($explo[0] == 'April'){
                $explo[0] = 'Abril';
                $totalReservasMes[$i]->meses = implode(' ' , $explo);
            }
            if($explo[0] == 'May'){
                $explo[0] = 'Mayo';
                $totalReservasMes[$i]->meses = implode(' ' , $explo);
            }
            if($explo[0] == 'June'){
                $explo[0] = 'Junio';
                $totalReservasMes[$i]->meses = implode(' ' , $explo);
            }
            if($explo[0] == 'July'){
                $explo[0] = 'Julio';
                $totalReservasMes[$i]->meses = implode(' ' , $explo);
            }
            if($explo[0] == 'August'){
                $explo[0] = 'Agosto';
                $totalReservasMes[$i]->meses = implode(' ' , $explo);
            }
            if($explo[0] == 'September'){
                $explo[0] = 'Septiembre';
                $totalReservasMes[$i]->meses = implode(' ' , $explo);
            }
            if($explo[0] == 'October'){
                $explo[0] = 'Octubre';
                $totalReservasMes[$i]->meses = implode(' ' , $explo);
            }
            if($explo[0] == 'November'){
                $explo[0] = 'Noviembre';
                $totalReservasMes[$i]->meses = implode(' ' , $explo);
            }
            if($explo[0] == 'December'){
                $explo[0] = 'Diciembre';
                $totalReservasMes[$i]->meses = implode(' ' , $explo);
            }
        }

        for($i=0;$i<count($totalReservasDia); $i++){
            $explo = (explode(' ' , $totalReservasDia[$i]->dias));
            if($explo[0] == 'January'){
                $explo[0] = 'Enero';
                $totalReservasDia[$i]->dias = implode(' ' , $explo);
            }
            if($explo[0] == 'February'){
                $explo[0] = 'Febrero';
                $totalReservasDia[$i]->dias = implode(' ' , $explo);
            }
            if($explo[0] == 'March'){
                $explo[0] = 'Marzo';
                $totalReservasDia[$i]->dias = implode(' ' , $explo);
            }
            if($explo[0] == 'April'){
                $explo[0] = 'Abril';
                $totalReservasDia[$i]->dias = implode(' ' , $explo);
            }
            if($explo[0] == 'May'){
                $explo[0] = 'Mayo';
                $totalReservasDia[$i]->dias = implode(' ' , $explo);
            }
            if($explo[0] == 'June'){
                $explo[0] = 'Junio';
                $totalReservasDia[$i]->dias = implode(' ' , $explo);
            }
            if($explo[0] == 'July'){
                $explo[0] = 'Julio';
                $totalReservasDia[$i]->dias = implode(' ' , $explo);
            }
            if($explo[0] == 'August'){
                $explo[0] = 'Agosto';
                $totalReservasDia[$i]->dias = implode(' ' , $explo);
            }
            if($explo[0] == 'September'){
                $explo[0] = 'Septiembre';
                $totalReservasDia[$i]->dias = implode(' ' , $explo);
            }
            if($explo[0] == 'October'){
                $explo[0] = 'Octubre';
                $totalReservasDia[$i]->dias = implode(' ' , $explo);
            }
            if($explo[0] == 'November'){
                $explo[0] = 'Noviembre';
                $totalReservasDia[$i]->dias = implode(' ' , $explo);
            }
            if($explo[0] == 'December'){
                $explo[0] = 'Diciembre';
                $totalReservasDia[$i]->dias = implode(' ' , $explo);
            }
        }

        if(sizeof($totalReservasAnio) == 0){
            $reservasData[] = [];
            $reservasData[] = [];
            $reservasData[] = [];
        }else{
            $reservasData[] = $totalReservasAnio;
            $reservasData[] = $totalReservasMes;
            $reservasData[] = $totalReservasDia;
        }

        $this->data = array('reservasData' => $reservasData);
        $this->data = json_encode($this->data);

        return view('livewire.show-reservas-report', compact('filterPaciente', 'filterPsico'));
    }

    public function resetFilt(){
        $this->reset([
            'searchPaciente',
            'searchPsico'
        ]);
    }
}
