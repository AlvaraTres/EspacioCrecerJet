<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\User;
use App\Models\Paciente;
use DB;
use Carbon\Carbon;

class ReservasApiRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paciente = Paciente::where('rut_paciente', '=', \Auth::user()->rut_usuario)->first();
        //dd($paciente->id_psicologo);
        return view('reservaApiRest.index', compact('paciente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $paci = Paciente::where('rut_paciente', '=', \Auth::user()->rut_usuario)->first();
        $pid = $request->data['pid'];
        $startTime = $request->data['startTime'];
        $description = $request->data['description'];
        $anio = $request->data['anio'];
        $mes = $request->data['mes'];
        $dia = $request->data['dia'];

        $fecha = Carbon::createFromFormat('Y-m-d',$anio. '-' . $mes . '-' . $dia)->format('Y-m-d');
        //dd($fecha);
        $hora = Carbon::parse($startTime)->addSeconds('00')->format('H:i:s');
        //dd($hora);
        $fecha_hora = Carbon::createFromFormat('Y-m-d H:i:s',$fecha . ' ' . $hora);

        $comparador = DB::table('reservas')
                        ->select('reservas.*')
                        ->where('reservas.fecha_hora_reserva', '=', $fecha_hora->format('Y-m-d H:i:s'))
                        ->where('reservas.id_usuario', '=', $paci->id)
                        ->first();

        if(empty($comparador))
        {
            return response()->json(['anio' => $anio , 'mes' => $mes , 'dia' => $dia, 'startTime' => $startTime, 'description' => $description, 'pid' => $pid, 'paci' => $paci->id]);
        }else{
            return response()->json(['error' => 'error en la reserva']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data;
        if(\Auth::user()->id_users_rol == 2){
            $data = DB::table('reservas')
                    ->join('users', 'users.id', '=', 'reservas.id_usuario')
                    ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                    ->where('reservas.id_usuario', '=', \Auth::user()->id)
                    ->select(DB::raw('CONCAT(pacientes.nombre_paciente, \' \', pacientes.ap_pat_paciente) AS title'), 'reservas.fecha_hora_reserva as start','reservas.motivo_reserva as description', 'reservas.fecha_hora_reserva_fin as end')
                    ->get();
        }else{
            if(\Auth::user()->id_users_rol == 3){
                $paciente = DB::table('pacientes')
                          ->join('users', 'users.rut_usuario', '=' , 'pacientes.rut_paciente')
                          ->select('pacientes.*')
                          ->where('pacientes.rut_paciente', '=', \Auth::user()->rut_usuario)
                          ->first();
                // dd($paciente);
                $psicologoDesignado = User::find($paciente->id_psicologo);

                $data = DB::table('reservas')
                            ->join('users', 'users.id', '=', 'reservas.id_usuario')
                            ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                            ->where('reservas.id_paciente', '=', $paciente->id)
                            ->select(DB::raw('CONCAT(pacientes.nombre_paciente, \' \', pacientes.ap_pat_paciente) AS title'), 'reservas.fecha_hora_reserva as start','reservas.motivo_reserva as description', 'reservas.fecha_hora_reserva_fin as end')
                            ->get();
            }
        }
        
        return response()->json($data);
    }

    public function getUserReservas($id)
    {
        $user = User::find($id);
        $paciente = Paciente::where('rut_paciente', '=', $user->rut_usuario)->first();
        $reservas = Reserva::where('id_paciente', '=', $paciente->id)->orderBy('fecha_reserva', 'DESC')->get();

        foreach($reservas as $reserva){
            $reserva->fecha_reserva = Carbon::parse($reserva->fecha_reserva)->format('d-m-Y');
            $reserva->hora_reserva = Carbon::parse($reserva->hora_reserva)->format('H:i');
        }

        return response()->json($reservas);
    }

    public function editReserva($id)
    {
        $reserva = Reserva::find($id);
        $reserva->fecha_reserva = Carbon::parse($reserva->fecha_reserva)->format('d-m-Y');
            $reserva->hora_reserva = Carbon::parse($reserva->hora_reserva)->format('H:i');
        return response()->json($reserva);
    }

    public function updateReserva(Request $request, $id)
    {
        $reserva = Reserva::find($id);

        $fecha = Carbon::createFromFormat('Y-m-d',$request['anio'] . '-' . $request['mes'] . '-' . $request['dia'])->format('Y-m-d');
        $hora = Carbon::createFromFormat('H:i:s', $request['hora'] . ':00:00')->format('H:i:s');

        $fecha_hora = Carbon::createFromFormat('Y-m-d H:i:s',$fecha . ' ' . $hora)->format('Y-m-d H:i:s');
        $fecha_hora_termino = Carbon::parse($fecha_hora)->addHour();

        $reserva->update([
            'fecha_reserva' => $fecha,
            'hora_reserva' => $fecha_hora,
            'fecha_hora_reserva' => $fecha_hora,
            'fecha_hora_reserva_fin' => $fecha_hora_termino->format('Y-m-d H:i:s'),
        ]);
        
        return response()->json("Reserva actualizada exitosamente!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ultimaReserva()
    {
        $reserva = Reserva::latest()->first();

        return response()->json($reserva);
    }
}
