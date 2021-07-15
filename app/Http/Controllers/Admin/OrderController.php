<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use App\Order;



class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::join('food_order', 'orders.id', '=', 'food_order.order_id')
            ->join('foods', 'foods.id', '=', 'food_order.food_id')
            ->join('users', 'users.id', '=', 'foods.user_id')
            ->where('users.id','=',Auth::user()->id)
            ->select('orders.*')
            ->get();


        $orders = $orders->unique();
      
        $data = [
            'orders' => $orders
        ];
        
        return view('admin.orders.index', $data);

    }
}
