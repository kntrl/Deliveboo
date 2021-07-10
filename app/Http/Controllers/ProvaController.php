<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Order;
class ProvaController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
            ->select('orders.id','foods.name','food_order.quantity')
            ->join('food_order', 'orders.id', '=', 'food_order.order_id')
            ->join('foods', 'foods.id', '=', 'food_order.food_id')
            ->where('foods.user_id', '=', '3')
            ->get();


        return view('viewProva', compact('orders'));
    }
}
