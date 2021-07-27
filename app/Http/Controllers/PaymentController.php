<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\ExpressCheckout;
use Carbon\Carbon;
use App\Models\Reserva;
use App\Models\Pago;
use DB;

class PaymentController extends Controller
{

    public $full_date, $anio_reserva, $mes_reserva, $dia_reserva, $startTime_reserva, $description_reserva;

    public function payWithPayPal($date1,$date2, $date3, $startTime, $description, $pid)
    {
        //dd($date1, $date2, $date3, $startTime, $description);
        $this->anio_reserva = $date1;
        $this->mes_reserva = $date2;
        $this->dia_reserva = $date3;
        $this->startTime_reserva = $startTime;
        $this->description_reserva = $description;

        $fecha = Carbon::createFromFormat('Y-m-d',$date1 . '-' . $date2 . '-' . $date3)->format('Y-m-d');
        //dd($fecha);
        $hora = Carbon::parse($startTime)->addSeconds('00')->format('H:i:s');
        //dd($hora);
        $this->full_date = Carbon::createFromFormat('Y-m-d H:i:s',$fecha . ' ' . $hora);
        //dd($this->full_date);

        $show_fecha = $this->full_date->format('d-m-Y');
        $show_hora = $this->full_date->format('H:i');
        $data = [];
        $data['items'] = [
            [
                'name' => 'Reserva de Hora Espacio Crecer',
                'price' => 20000,
                'desc' => 'Fecha de atencion '. $show_fecha ." a las " . $show_hora . " horas.",
                'qty' => 1
            ]
        ];

        $reserva_paypal = (object) array(
            'motivo' => $this->description_reserva, 
            'fecha' => $this->full_date,
        );

        $reserva_paypal = json_decode(json_encode($reserva_paypal), true);


        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success', ['fecha' => $this->full_date ,'description' => $this->description_reserva, 'pid' => $pid]);
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = 20000;

        

        $provider = new ExpressCheckout;

        $response = $provider->setExpressCheckout($data);

        $response = $provider->setExpressCheckout($data, true);

        return redirect($response['paypal_link']);
    }

    public function paymentCancel(){
        dd('Aqui se cancela la operación');
    }

    public function paymentSuccess(Request $request, $fecha, $motivo, $pid)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if(in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            $solo_fecha = Carbon::parse($fecha)->format('Y-m-d');
            $fecha = Carbon::parse($fecha)->format('Y-m-d H:i:s');
            $hora_termino = Carbon::parse($fecha)->addHour();
            Reserva::create([
                'id_usuario' => $pid,
                'id_paciente' => Auth::user()->id,
                'fecha_reserva' => $solo_fecha,
                'hora_reserva' => $fecha,
                'fecha_hora_reserva' => $fecha,
                'motivo_reserva' => $motivo,
                'fecha_hora_reserva_fin' => $hora_termino,
            ]);
            $reserva = Reserva::latest()->first();

            Pago::create([
                'id_reserva' => $reserva->id,
                'id_paciente' => Auth::user()->id,
                'fecha_pago' => Carbon::now('America/Santiago'),
                'monto_pago' => 20000,
            ]);

            return redirect()->route('reservas.success', ['reserva' => $reserva]);
        }

        return redirect()->route('reservas.error');
    }

    public function successReserva(Request $request, $reserva)
    {
        $datos = DB::table('reservas')
                    ->join('pacientes', 'pacientes.id', '=', 'reservas.id_paciente')
                    ->join('users', 'users.id', '=', 'reservas.id_usuario')
                    ->select('reservas.*', 'pacientes.email as correo','pacientes.*', 'users.*')
                    ->where('reservas.id', '=', $reserva)
                    ->get();
        
        return view('reservas.reserva_success', compact('datos'));
    }

    public function errorReserva()
    {
        return view('reservas.reserva_error');
    }
}
