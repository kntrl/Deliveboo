<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $order = new \App\Order;
        
        $userOrders = $order->getOrderByUser(Auth::user()->id);
        if (!($userOrders->count() > 0)) {
            return view ('home',compact('userOrders'));
        }
        $orderTrendChart =  $order->getTrendChart($userOrders);
        $coursePieChart = $order->getCoursePieChart($userOrders);
        $yearlyOrderChart = $order->getYearlyChart($userOrders);
        $data =[
            'coursePieChart'=>$coursePieChart,
            'yearlyOrderChart'=>$yearlyOrderChart,
            'orderTrendChart'=>$orderTrendChart,
            'bestSellerFood'=> Auth::user()->bestSellers(1)->first()
        ];


        return view('home',$data);
    }
}
