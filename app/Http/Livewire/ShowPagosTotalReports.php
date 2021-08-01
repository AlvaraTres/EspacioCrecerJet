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

    public function render()
    {
        $filtPsicologo = User::select(DB::raw('CONCAT(users.nombre_usuario, \' \', users.apellido_pat_usuario) AS psicologo'), 'users.id')->orderBy('users.id', 'ASC')->get();

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
        
        $this->totalPagosArray = json_encode($totalPagosArray);
        
        return view('livewire.show-pagos-total-reports', compact('filtPsicologo'));
    }

    public function updatedSelectedPsicologo($pisocologo_id)
    {
        dd($pisocologo_id);
    }
}
