<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;
use DB;
use Carbon\Carbon;

class ShowPacientesReports extends Component
{
    public $datas = '';
    public $anioSearch;
    public function render()
    {
        $anioS = Carbon::now()->format('Y');
        if($this->anioSearch != null)
        {
            $anioS = Carbon::createFromFormat('Y', $this->anioSearch)->format('Y');
        }
            $pacientes = Paciente::select(DB::raw("COUNT(*) AS count"))
                              ->whereYear('created_at', date($anioS))
                              ->groupBy(DB::raw("Month(created_at)"))
                              ->pluck('count');

            $months = Paciente::select(DB::raw("Month(created_at) AS month"))
                            ->whereYear('created_at', date($anioS))
                            ->groupBy(DB::raw("Month(created_at)"))
                            ->pluck('month');
            
            $datas = array(0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
        
            foreach($months as $index => $month)
            {                    
                $datas[$month] = $pacientes[$index];
            }
            $this->datas = json_encode($datas);
        return view('livewire.show-pacientes-reports', compact('datas'));
    }
}
