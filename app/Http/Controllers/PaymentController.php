<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaymentController extends Controller
{
    public function payWithPayPal()
    {
        $data = [];
        $data['items'] = [
            [
                'name' => 'Reserva de Hora',
                'price' => 20000,
                'desc' => 'Pago de reserva para atención con psicólogo de Espacio Crecer',
                'qty' => 1
            ]
        ];

        $data['invoice_id'] = 1;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['return_url'] = route('payment.success');
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

    public function paymentSuccess(Request $request)
    {
        $provider = new ExpressCheckout;
        $response = $provider->getExpressCheckoutDetails($request->token);

        if(in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            dd('El pago funcionó');
        }

        dd('Algo salió mal');
    }
}
