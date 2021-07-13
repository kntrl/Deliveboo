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
        $orderIds = DB::table('orders')
            ->select('orders.id')
            ->join('food_order', 'orders.id', '=', 'food_order.order_id')
            ->join('foods', 'foods.id', '=', 'food_order.food_id')
            ->where('foods.user_id', '=', Auth::user()->id)
            ->groupBy('orders.id')
            ->get();
            
        
        foreach ($orderIds as $singleOrder) {
            $order = Order::findOrFail($singleOrder->id);
            $orders[] = $order;
        }


        dd($orders);

    }
}
