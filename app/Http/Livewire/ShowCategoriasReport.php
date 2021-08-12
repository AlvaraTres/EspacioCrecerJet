<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tagtrastornomental;
use DB;
use Carbon\Carbon;

class ShowCategoriasReport extends Component
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
        $categoriasAnio;
        $categoriasMes = [];
        $anio = Carbon::now()->format('Y');
        $mes = Carbon::now()->format('m');
        $from = Carbon::now()->format('Y-m-d');
        $to = Carbon::now()->format('Y-m-d');

        if($this->from != null){
            $from = Carbon::parse($this->from)->format('Y-m-d H:i:s');
        }
        if($this->to != null){
            $to = Carbon::parse($this->to . '23:59:00')->format('Y-m-d H:i:s');
        }

        if($this->tipoFiltro != null)
        {
            if($this->anioSelect != null){
                $this->enabledSelect = 1;

                $categoriasMes = DB::table('incluyen')
                                ->join('tag_trastorno_mental as tag', 'tag.id', '=', 'incluyen.id_tag_trastorno')
                                ->select(DB::raw("DATE_FORMAT(incluyen.created_at, '%M %Y %m') as meses"), 'tag.nombre_tag as nombre', DB::raw('COUNT(incluyen.id_tag_trastorno) as cont'))
                                ->whereYear('incluyen.created_at', '=', $this->anioSelect)
                                ->groupBy('meses', 'tag.nombre_tag')
                                ->get();
                if($this->mesSelect != null){
                    $categoriasMes = DB::table('incluyen')
                                ->join('tag_trastorno_mental as tag', 'tag.id', '=', 'incluyen.id_tag_trastorno')
                                ->select(DB::raw("DATE_FORMAT(incluyen.created_at, '%M %Y %m') as meses"), 'tag.nombre_tag as nombre', DB::raw('COUNT(incluyen.id_tag_trastorno) as cont'))
                                ->whereYear('incluyen.created_at', '=', $this->anioSelect)
                                ->whereMonth('incluyen.created_at', '=', $this->mesSelect)
                                ->groupBy('meses', 'tag.nombre_tag')
                                ->get();
                } 
            }else{
                if($this->from != null){

                    $categoriasMes = DB::table('incluyen')
                                ->join('tag_trastorno_mental as tag', 'tag.id', '=', 'incluyen.id_tag_trastorno')
                                ->select(DB::raw("DATE_FORMAT(incluyen.created_at, '%M %Y %m') as meses"), 'tag.nombre_tag as nombre', DB::raw('COUNT(incluyen.id_tag_trastorno) as cont'))
                                ->whereBetween('incluyen.created_at', [$from, $to])
                                ->groupBy('meses', 'tag.nombre_tag')
                                ->get();
                }
                
            }

            
        }else{
            $categoriasAnio = DB::table('incluyen')
                                ->join('tag_trastorno_mental as tag', 'tag.id', '=', 'incluyen.id_tag_trastorno')
                                ->select(DB::raw('YEAR(incluyen.created_at) as anio'), 'tag.nombre_tag', DB::raw('COUNT(incluyen.id_tag_trastorno) as cont'))
                                ->whereYear('incluyen.created_at', '=', $anio)
                                ->groupBy('anio', 'tag.nombre_tag')
                                ->get();                

            $categoriasMes = DB::table('incluyen')
                            ->join('tag_trastorno_mental as tag', 'tag.id', '=', 'incluyen.id_tag_trastorno')
                            ->select(DB::raw("DATE_FORMAT(incluyen.created_at, '%M %Y %m') as meses"), 'tag.nombre_tag as nombre', DB::raw('COUNT(incluyen.id_tag_trastorno) as cont'))
                            ->whereMonth('incluyen.created_at', '=', $mes)
                            ->groupBy('meses', 'tag.nombre_tag')
                            ->get();
        }

        
        
        $suma = 0;

        for($i=0;$i<count($categoriasMes);$i++){
            $suma = $suma + (int)$categoriasMes[$i]->cont;
        }
        //dd($categoriasMes, $suma);

        $porcentaje = [];
        for($i=0;$i<count($categoriasMes); $i++){
            $porcentaje[$i] = number_format($categoriasMes[$i]->cont/$suma, 2, '.', ',');
        }
        //dd($suma);
        
        for($i=0;$i<count($categoriasMes);$i++){
            $explo = (explode(' ' , $categoriasMes[$i]->meses));
            if($explo[0] == 'January'){
                $explo[0] = 'Enero';
                $categoriasMes[$i]->meses = implode(' ' , $explo);
            }
            if($explo[0] == 'February'){
                $explo[0] = 'Febrero';
                $categoriasMes[$i]->meses = implode(' ' , $explo); 
            }
            if($explo[0] == 'March'){
                $explo[0] = 'Marzo';
                $categoriasMes[$i]->meses = implode(' ' , $explo); 
            }
            if($explo[0] == 'April'){
                $explo[0] = 'Abril';
                $categoriasMes[$i]->meses = implode(' ' , $explo); 
            }
            if($explo[0] == 'May'){
                $explo[0] = 'Mayo';
                $categoriasMes[$i]->meses = implode(' ' , $explo); 
            }
            if($explo[0] == 'June'){
                $explo[0] = 'Junio';
                $categoriasMes[$i]->meses = implode(' ' , $explo); 
            }
            if($explo[0] == 'July'){
                $explo[0] = 'Julio';
                $categoriasMes[$i]->meses = implode(' ' , $explo);
            }
            if($explo[0] == 'August'){
                $explo[0] = 'Agosto';
                $categoriasMes[$i]->meses = implode(' ' , $explo);

            }
            if($explo[0] == 'September'){
                $explo[0] = 'Septiembre';
                $categoriasMes[$i]->meses = implode(' ' , $explo); 
            }
            if($explo[0] == 'October'){
                $explo[0] = 'Octubre';
                $categoriasMes[$i]->meses = implode(' ' , $explo); 
            }
            if($explo[0] == 'November'){
                $explo[0] = 'Noviembre';
                $categoriasMes[$i]->meses = implode(' ' , $explo);
            }
            if($explo[0] == 'December'){
                $explo[0] = 'Diciembre';
                $categoriasMes[$i]->meses = implode(' ' , $explo); 
            }
        }
        //dd($categoriasMes, $sum);

        $puntos = [];
        $posicion = 0;
        if(count($categoriasMes)>0){
            foreach($categoriasMes as $cm){
                $puntos[] = [
                    'name' => $cm->nombre,
                    'y' => floatval($porcentaje[$posicion])
                ];
                $posicion++;
            }
        }else{
            $puntos[] = [
                'name' => 'No Hay Registros Para Mostrar',
                'y' => floatval(1)
            ];
        }
        
        //dd($puntos);
        $this->data = json_encode($puntos);

        return view('livewire.show-categorias-report');
    }

    public function resetFilt()
    {
        $this->reset([
            'tipoFiltro',
            'from',
            'to',
            'anioSelect',
            'mesSelect'
        ]);
    }
}
