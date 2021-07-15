<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway as Gateway;
use App\Order;

class PaymentController extends Controller
{
    public function setupPayment(Order $order,Gateway $gateway)
    {
        // if payment is already paid we return home view
        if ($order->status != "pending" && $order->status != "rejected" ){
        
            // WE MAY RETURN THE PAYMENT RECEIPT.

            return view('welcome');

        }

        $clientToken = $gateway->clientToken()->generate();

        return view('payments.form', compact('clientToken'),compact('order'));
    }


    public function checkout(Order $order,Request $request, Gateway $gateway)
    {
        $form_data = $request->all();
        
        $nonceFromTheClient = $form_data['payment_method_nonce'];

        //creating transaction
        $result = $gateway->transaction()->sale([
            'amount' => $order->price,
            'paymentMethodNonce' => $nonceFromTheClient,
            'orderId'=> $order->id,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        //updating order status according to sale result.
        if ($result->success) {
            $order->status = "accepted";
        } else {
            $order->status ="rejected";
        }
        $order->update();

        return view('payments.receipt',compact('result'));
    }
}
