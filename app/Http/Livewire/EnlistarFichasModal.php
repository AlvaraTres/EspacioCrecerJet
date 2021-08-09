<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;
use App\Models\Fichapaciente;
use App\Models\Tagtrastornomental;
use App\Models\Incluye;
use Carbon\Carbon;
use DB;
use PDF;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class EnlistarFichasModal extends Component
{
    use WithFileUploads;

    public $openVerFichasModal = false;
    public $openUploadFileModal = false;
    public $openCreateFichaModal = false;
    public $showInfoFichasModal = true;

    public $tags_select;
    public $selectedTags = [];
    public $fecha_atencion_create;

    public $paciente;
    public $paciente_rut;
    public $count_fichas=1;

    public $id_usuario, $id_paciente, $resumen_atencion, $archivo, $fecha_atencion_ficha;

    public function mount(Paciente $paciente){
        $this->paciente = $paciente;
    }

    public function render()
    {
        $ficha_paciente = DB::table('fichas_pacientes')
                    ->join('users', 'users.id', '=', 'fichas_pacientes.id_usuario')
                    ->join('pacientes', 'pacientes.id', '=', 'fichas_pacientes.id_paciente')
                    ->where('users.id', '=', 1) //cambiar a psicologo que este en el sistema
                    ->where('pacientes.id', '=', $this->paciente->id)
                    ->select('fichas_pacientes.*')
                    ->get();
        $this->count_fichas = 2;

        return view('livewire.enlistar-fichas-modal', compact('ficha_paciente'));
    }

    public function fichaPacientePdf($ficha_id){
        //dd($ficha_id);
        $datos_ficha = DB::table('fichas_pacientes')
                        ->join('users', 'users.id', '=', 'fichas_pacientes.id_usuario')
                        ->join('pacientes', 'pacientes.id', '=', 'fichas_pacientes.id_paciente')
                        ->where('fichas_pacientes.id', '=', $ficha_id)
                        ->select('fichas_pacientes.*', 'users.*', 'pacientes.*')
                        ->get();
        
        //dd($datos_ficha);
        foreach($datos_ficha as $datos){
            $this->paciente_rut = $datos->rut_paciente; 
        }
        //dd($this->paciente_rut);

        $find_paciente = Paciente::where('rut_paciente', '=', $this->paciente_rut)->first();
        //dd($find_paciente);
        $fecha_actual = Carbon::now('America/Santiago');
        $anio_actual = Carbon::parse($find_paciente->fecha_nacimiento_paciente);
        $edad_calculada = $anio_actual->diffInYears($fecha_actual);
        //dd($edad_calculada);
        
        //pasar imagen de fondo a base64 para que se pueda ver PDF
        $path = base_path('public/images/logo_opacidad_40.png'); //rescatar imagen
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $pic = 'data:image/' . $type . ';base64,' . base64_encode($data);


        $ficha_pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('livewire.fichaPdf', compact('datos_ficha', 'pic', 'edad_calculada'));
        return $ficha_pdf->stream('ficha.pdf');
    }

    public function showUploadFileModal()
    {
        $this->showInfoFichasModal = false;
        $this->openUploadFileModal = true;
    }

    public function closeUploadModal()
    {
        $this->openVerFichasModal = true;
        $this->openUploadFileModal = false;
    }

    public function saveFileFichaPaciente()
    {
        $this->validate([
            'archivo' => 'max:1024',
            'fecha_atencion_ficha' => 'required'
        ]);

        $fecha = Carbon::parse($this->fecha_atencion_ficha)->format('Y-m-d');

        //dd($this->archivo);

        $ficha = Fichapaciente::create([
                    'id_usuario' => \Auth::user()->id,
                    'id_paciente' => $this->paciente->id,
                    'fecha_atencion_ficha' => $fecha,
                    'resumen_atencion' => 'sin especificar'
                ]);
        
        if($this->archivo != null){
            $file = $this->archivo->getClientOriginalName();
            $this->archivo->storeAs('subfolder/' . $this->paciente->nombre_paciente, $file);
            $ficha->update(['archivo' => $file]);
        }

        $this->reset([
            'archivo',
            'fecha_atencion_ficha',
            'openVerFichasModal',
            'openUploadFileModal'
        ]);
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Exito!', 
            'text' => 'El archivo se ha cargado satisfactoriamente!',
            'icon' => 'success'
        ]);
    }

    public function downloadFileFichaPaciente($ficha_id)
    {
        $ficha = Fichapaciente::where('id', '=', $ficha_id)->first();
        $paciente = DB::table('fichas_pacientes')
                    ->join('pacientes', 'pacientes.id', '=', 'fichas_pacientes.id_paciente')
                    ->select('pacientes.*')
                    ->where('fichas_pacientes.id_paciente', '=', $ficha->id_paciente)
                    ->first();

        if(Storage::disk('local')->exists("subfolder/$paciente->nombre_paciente/$ficha->archivo")){
            $path = Storage::disk('local')->path("subfolder/$paciente->nombre_paciente/$ficha->archivo");
            return response()->download($path);
        }else{
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!', 
                'text' => 'Ha ocurrido un error!, El archivo solicitado no existe o está dañado.',
                'icon' => 'error'
            ]);
            return redirect('/404');
        }
    }

    public function showCreateFichaModal()
    {
        $this->showInfoFichasModal = false;
        $this->openCreateFichaModal = true;

        $this->tags_select = Tagtrastornomental::select('id', 'nombre_tag')->get();

        
    }

    public function saveFichaModal($sel, $paciente, $texto, $dataFecha)
    {
        $fecha = Carbon::parse($dataFecha)->format('Y-m-d');

        Fichapaciente::create([
            'id_usuario' => \Auth::user()->id,
            'id_paciente' => $paciente,
            'fecha_atencion_ficha' => $fecha,
            'resumen_atencion' => $texto,
            'archivo' => null
        ]);

        $ficha = Fichapaciente::latest()->first();

        for($i=0; $i<count($sel); $i++){
            Incluye::create([
                'id_tag_trastorno' => $sel[$i]+1,
                'id_ficha_paciente' => $ficha->id
            ]);
        }

        $this->reset([
            'openVerFichasModal',
            'showInfoFichasModal',
            'openCreateFichaModal',
            'tags_select'
        ]);

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Exito!', 
            'text' => 'La ficha del paciente se ha creado con éxito!.',
            'icon' => 'success'
        ]);
    }
}
