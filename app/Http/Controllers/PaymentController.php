<?php

namespace App\Http\Controllers;

use Braintree\Gateway;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getClientToken(Gateway $gateway)
    {
        echo $gateway->clientToken()->generate();
    }
}
