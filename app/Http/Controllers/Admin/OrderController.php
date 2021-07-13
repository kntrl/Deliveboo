<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Order;



class OrderController extends Controller
{
    public function index()
    {

        //getting all Orders with Foods (where foods belongs to auth user)
        $orders = Order::with(['foods' => function($query) {
            $query->where('user_id','=',Auth::user()->id);
        }])->get();


        //removings orders with no foods
        $currentUserOrder = $orders->filter(function($order){
            return $order->foods->count() > 0;
        });

        //test output
        foreach ($currentUserOrder as $order) {
            echo '<h1> ordine n°'.$order->id.' da '.$order->name. ' '. $order->last_name.'</h1>';
            foreach ($order->foods as $food) {
                echo $food->name.'<br>';
            }
        }

    }
}
