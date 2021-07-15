<?php

namespace App\Http\Controllers;

use Braintree\Gateway as Gateway;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function make(Gateway $gateway)
    {
        $clientToken = $gateway->clientToken()->generate();

        return view('payments.payment', compact('clientToken'));
    }


    public function pay(Request $request, Gateway $gateway)
    {
        $form_data = $request->all();


        $nonceFromTheClient = $form_data['payment_method_nonce'];

        $result = $gateway->transaction()->sale([
            'amount' => $form_data['amount'],
            'paymentMethodNonce' => $nonceFromTheClient,
            'options' => [
                'submitForSettlement' => true
            ]

        ]);

        return view('home');
    }
}
