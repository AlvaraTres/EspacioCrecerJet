<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Pago;
use DB;
use Carbon\Carbon;

class ShowPagosReports extends Component
{
    public $pagosXMes;

    public function render()
    {
        $pagos = Pago::select(DB::raw("COUNT(*) as count"))
                     ->whereYear('fecha_pago', date('Y'))
                     ->groupBy(DB::raw("Month(fecha_pago)"))
                     ->pluck('count');
        
        $months = Pago::select(DB::raw("Month(fecha_pago) as month"))
                      ->whereYear('fecha_pago', date('Y'))
                      ->groupBy(DB::raw("Month(fecha_pago)"))
                      ->pluck('month');
        
        $datas = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

        foreach($months as $index => $month)
        {                    
            $datas[$month] = $pagos[$index];
        }
        $this->pagosXMes = json_encode($datas);
        
        return view('livewire.show-pagos-reports');
    }
}
