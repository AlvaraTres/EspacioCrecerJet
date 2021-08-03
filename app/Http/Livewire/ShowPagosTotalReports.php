<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pago;
use App\Models\User;
use DB;
use Carbon\Carbon;

class ShowPagosTotalReports extends Component
{
    public $totalPagosArray = '';
    public $psicologo = null;
    public $selectedPsicologo = null;
    public $anioSearchTotalPagos;

    public $data;

    public function render()
    {
        $ingresosData = [];

        if($this->selectedPsicologo != null){
            //dd($this->selectedPsicologo);
            $totalIngresosAnio = DB::table('pagos')
                                ->join('reservas', 'reservas.id', '=', 'pagos.id_reserva')
                                ->join('users', 'users.id', '=', 'reservas.id_usuario')
                                ->select(DB::raw('YEAR(pagos.fecha_pago) as anio'), DB::raw('SUM(pagos.monto_pago) as total'))
                                ->where('users.id', '=', $this->selectedPsicologo)
                                ->groupBy(DB::raw('YEAR(pagos.fecha_pago)'))
                                ->get();

            $totalIngresosMes = DB::table('pagos')
                                ->join('reservas', 'reservas.id', '=', 'pagos.id_reserva')
                                ->join('users', 'users.id', '=', 'reservas.id_usuario')
                                ->select(DB::raw("DATE_FORMAT(fecha_pago, '%M %Y %m') as meses"), DB::raw('SUM(monto_pago) as total'))
                                ->where('users.id', '=', $this->selectedPsicologo)
                                ->groupBy('meses')
                                ->get();
            
            $totalIngresosDia = DB::table('pagos')
                                ->join('reservas', 'reservas.id', '=', 'pagos.id_reserva')
                                ->join('users', 'users.id', '=', 'reservas.id_usuario')
                                ->select(DB::raw("DATE_FORMAT(fecha_pago, '%M %Y %d') as dias"), DB::raw('SUM(monto_pago) as total'))
                                ->where('users.id', '=', $this->selectedPsicologo)
                                ->groupBy('dias')
                                ->get();

            if(sizeof($totalIngresosAnio) == 0){
                $ingresosData[] = [];
                $ingresosData[] = [];
                $ingresosData[] = [];
            }else{
                $ingresosData[] = $totalIngresosAnio;
                $ingresosData[] = $totalIngresosMes;
                $ingresosData[] = $totalIngresosDia;
            }
            
            

            $this->data = array('ingresosData' => $ingresosData);
            $this->data = json_encode($this->data);
            
        }else{
            $totalIngresosAnio = DB::table('pagos')
                                ->select(DB::raw('YEAR(pagos.fecha_pago) as anio'), DB::raw('SUM(pagos.monto_pago) as total'))
                                ->groupBy(DB::raw('YEAR(pagos.fecha_pago)'))
                                ->get();

            $totalIngresosMes = Pago::select(DB::raw("DATE_FORMAT(fecha_pago, '%M %Y %m') as meses"), DB::raw('SUM(monto_pago) as total'))
                                ->groupBy('meses')
                                ->get();

            $totalIngresosDia = Pago::select(DB::raw("DATE_FORMAT(fecha_pago, '%M %Y %d') as dias"), DB::raw('SUM(monto_pago) as total'))
                                ->groupBy('dias')
                                ->get();

            $ingresosData[] = $totalIngresosAnio;
            $ingresosData[] = $totalIngresosMes;
            $ingresosData[] = $totalIngresosDia;

            $this->data = array('ingresosData' => $ingresosData);
            $this->data = json_encode($this->data);
        }

        $filtPsicologo = User::select(DB::raw('CONCAT(users.nombre_usuario, \' \', users.apellido_pat_usuario) AS psicologo'), 'users.id')->orderBy('users.id', 'ASC')->get();

        /*
        //dd($this->filtPsicologo);
        $anioBusq = Carbon::now()->format('Y');
        if($this->anioSearchTotalPagos != null){
            $anioBusq = Carbon::createFromFormat('Y', $this->anioSearchTotalPagos);
        }

        $pagos = Pago::select(DB::raw("COUNT(*) as count"))
                     ->whereYear('fecha_pago', date($anioBusq))
                     ->groupBy(DB::raw("Month(fecha_pago)"))
                     ->pluck('count');
        
        $months = Pago::select(DB::raw("Month(fecha_pago) as month"))
                      ->whereYear('fecha_pago', date($anioBusq))
                      ->groupBy(DB::raw("Month(fecha_pago)"))
                      ->pluck('month');

        $totalPagos = Pago::select(DB::raw("YEAR(fecha_pago) as year"),
                                  DB::raw("Month(fecha_pago) as month"),
                                  DB::raw("SUM(monto_pago) as total"))
                     ->whereYear('fecha_pago', date($anioBusq))
                     ->groupBy('year', 'month')
                     ->pluck('total');
        
        $totalPagosArray = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        foreach($months as $index => $month)
        {                    
            $totalPagosArray[$month] = (int)$totalPagos[$index];
        }
        
        $this->totalPagosArray = json_encode($totalPagosArray);*/

        
        return view('livewire.show-pagos-total-reports', compact('filtPsicologo'));
    }

    public function updatedSelectedPsicologo($pisocologo_id)
    {
        //query mostrar todos los pagos relacionados al psicologo seleccionado
    }
}
