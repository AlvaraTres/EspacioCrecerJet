<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;
use Carbon\Carbon;
use App\Models\Reserva;
use App\Models\Pago;
use App\Models\Paciente;
use App\Models\User;
use DB;

use App\Mail\ContactoMailable;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{

    public $full_date, $paci,$anio_reserva, $mes_reserva, $dia_reserva, $startTime_reserva, $description_reserva;
    public $valor = 0;

    public function payWithPayPal($date1,$date2, $date3, $startTime, $description, $pid, $paci)
    {
        //dd($date1, $date2, $date3, $startTime, $description);
        //dd($pid, $paci);
        $this->anio_reserva = $date1;
        $this->mes_reserva = $date2;
        $this->dia_reserva = $date3;
        $this->startTime_reserva = $startTime;
        $this->description_reserva = $description;
        $this->paci = $paci;

        $contadorReservas = DB::table('reservas')
                              ->select('reservas.*')
                              ->where('id_paciente', '=', $this->paci)
                              ->get();
        //dd(count($contadorReservas));

        $fecha = Carbon::createFromFormat('Y-m-d',$date1 . '-' . $date2 . '-' . $date3)->format('Y-m-d');
        //dd($fecha);
        $hora = Carbon::parse($startTime)->addSeconds('00')->format('H:i:s');
        //dd($hora);
        $this->full_date = Carbon::createFromFormat('Y-m-d H:i:s',$fecha . ' ' . $hora);
        //dd($this->full_date);

        $pac_sea = Paciente::where('id', '=', $paci)->first();
        //dd($pac_sea->certificado);
        if($pac_sea->certificado == null){
            $this->valor = 20000;
        }else{
            $this->valor = 15000;
        }

        if(count($contadorReservas) == 0){
            $this->valor = 0;
        }

        //dd($this->valor);
        $precio = $this->valor;
        //dd($precio);

        $show_fecha = $this->full_date->format('d-m-Y');
        $show_hora = $this->full_date->format('H:i');
        $data = [];
        $data['items'] = [
            [
                'name' => 'Reserva de Hora Espacio Crecer',
                'price' => $precio,
                'desc' => 'Fecha de atencion '. $show_fecha ." a las " . $show_hora . " horas.",
                'qty' => 1
            ]
        ];
        //dd($data);

        $reserva_paypal = (object) array(
            'motivo' => $this->description_reserva, 
            'fecha' => $this->full_date,
        );

        $reserva_paypal = json_decode(json_encode($reserva_paypal), true);
        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success', ['fecha' => $this->full_date ,'description' => $this->description_reserva, 'pid' => $pid, 'paci' => $this->paci, 'precio' => $precio]);
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = $precio;

        //dd($data['total']);
        $provider = new ExpressCheckout;

        $response = $provider->setExpressCheckout($data);

        $response = $provider->setExpressCheckout($data, true);

        //dd($response);

        if(\Auth::user()->id_users_rol == 1 || \Auth::user()->id_users_rol == 2){
            $pacienteData = Paciente::where('id', '=' , $paci)->first();
            $reservaData = Reserva::latest()->first();
            $psicologoData = User::where('id', '=', $reservaData->id_usuario)->latest()->first();
            $direccionURL = $response['paypal_link'];
            $correo = new ContactoMailable($pacienteData, $reservaData, $psicologoData, $direccionURL);

            Mail::to($pacienteData->email)->send($correo);
            
            return "correo enviado";
        } 

        return redirect($response['paypal_link']);
    }

    public function paymentCancel(){
        dd('Aqui se cancela la operación');
    }

    public function paymentSuccess(Request $request, $fecha, $motivo, $pid, $paci, $precio)
    {
        //dd($fecha, $motivo, $pid, $paci);
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if(in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $solo_fecha = Carbon::parse($fecha)->format('Y-m-d');
            $fecha = Carbon::parse($fecha)->format('Y-m-d H:i:s');
            $hora_termino = Carbon::parse($fecha)->addHour();

            if(\Auth::user()->id_users_rol == 3){
                $paciente = DB::table('pacientes')
                          ->join('users', 'users.rut_usuario', '=' , 'pacientes.rut_paciente')
                          ->select('pacientes.*')
                          ->where('pacientes.rut_paciente', '=', \Auth::user()->rut_usuario)
                          ->first();

                Reserva::create([
                    'id_usuario' => $pid,
                    'id_paciente' => $paciente->id,
                    'fecha_reserva' => $solo_fecha,
                    'hora_reserva' => $fecha,
                    'fecha_hora_reserva' => $fecha,
                    'motivo_reserva' => $motivo,
                    'fecha_hora_reserva_fin' => $hora_termino,
                ]);
                
                $reserva = Reserva::latest()->first();

                Pago::create([
                    'id_reserva' => $reserva->id,
                    'id_paciente' => $paciente->id,
                    'fecha_pago' => Carbon::now('America/Santiago'),
                    'monto_pago' => $precio,
                ]);
            }else{
                Reserva::create([
                    'id_usuario' => $pid,
                    'id_paciente' => $paci,
                    'fecha_reserva' => $solo_fecha,
                    'hora_reserva' => $fecha,
                    'fecha_hora_reserva' => $fecha,
                    'motivo_reserva' => $motivo,
                    'fecha_hora_reserva_fin' => $hora_termino,
                ]);
                $reserva = Reserva::latest()->first();

                Pago::create([
                    'id_reserva' => $reserva->id,
                    'id_paciente' => $paci,
                    'fecha_pago' => Carbon::now('America/Santiago'),
                    'monto_pago' => $precio,
                ]);
            }

            $pacienteData = Paciente::where('id', '=' , $paci)->first();
            $reservaData = Reserva::latest()->first();
            $psicologoData = User::where('id', '=', $reservaData->id_usuario)->latest()->first();
            $direccionURL = 'sinMensaje';
            $correo = new ContactoMailable($pacienteData, $reservaData, $psicologoData, $direccionURL);

            Mail::to($pacienteData->email)->send($correo);

            return redirect()->route('reservas.success', ['reserva' => $reserva, 'paci' => $paci]);
        }

        return redirect()->route('reservas.error');
    }

    public function successReserva(Request $request, $reserva, $paci)
    {
        if(\Auth::user()->id_users_rol == 3){
            $paciente = DB::table('pacientes')
                          ->join('users', 'users.rut_usuario', '=' , 'pacientes.rut_paciente')
                          ->select('pacientes.*')
                          ->where('pacientes.rut_paciente', '=', \Auth::user()->rut_usuario)
                          ->first();

            $datos = DB::table('reservas')
                ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                ->join('users', 'users.id', '=', 'reservas.id_usuario')
                ->select('reservas.*', 'pacientes.email as correo','pacientes.*', 'users.*')
                ->where('reservas.id', '=', $reserva)
                ->get();
        }else{
            $paciente = DB::table('pacientes')
                          ->join('users', 'users.rut_usuario', '=' , 'pacientes.rut_paciente')
                          ->select('pacientes.*')
                          ->where('pacientes.id', '=', $paci)
                          ->first();
            $datos = DB::table('reservas')
                          ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                          ->join('users', 'users.id', '=', 'reservas.id_usuario')
                          ->select('reservas.*', 'pacientes.email as correo','pacientes.*', 'users.*')
                          ->where('reservas.id', '=', $reserva)
                          ->get();
        }
        
        
        return view('reservas.reserva_success', compact('datos'));
    }

    public function errorReserva()
    {
        return view('reservas.reserva_error');
    }
}
