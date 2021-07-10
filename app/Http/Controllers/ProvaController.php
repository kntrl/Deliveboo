<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProvaController extends Controller
{
    public function index()
    {
        $orders = DB::table('orders')
            ->join('food_order', 'orders.id', '=', 'food_order.order_id')
            ->join('foods', 'foods.id', '=', 'food_order.food_id')
            /* ->join('users', 'foods.user_id', '=', 'users.id') */

            ->where('user_id', '=', '1')

            ->get();

        return view('viewProva', compact('orders'));
    }
}
