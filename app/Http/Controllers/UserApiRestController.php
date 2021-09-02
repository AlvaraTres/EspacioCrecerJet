<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Pago;
use Carbon\Carbon;

class UserApiRestController extends Controller
{
    public function getLogedUser($id)
    {
        return response()->json(User::find($id));
    }

    public function getPsicologo($id){
        $user = User::find($id);
        $paciente = Paciente::where('rut_paciente', '=', $user->rut_usuario)->first();
        $psicologo = User::find($paciente->id_psicologo);
        return response()->json($psicologo);
    }

    public function getPagos($id){
        $user = User::find($id);
        $paciente = Paciente::where('rut_paciente', '=', $user->rut_usuario)->first();
        $pagos = Pago::where('id_paciente', '=', $paciente->id)->orderBy('id', 'DESC')->get();

        foreach($pagos as $pago){
            $pago->fecha_pago = Carbon::parse($pago->fecha_pago)->format('d-m-Y');
            $pago->monto_pago = number_format($pago->monto_pago, 0, ',', '.');
        }

        return response()->json($pagos);
    }
}
