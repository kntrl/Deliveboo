<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Order;
use App\Status;
use App\Services\Paginate;



class OrderController extends Controller
{
    public function index(Paginate $paginate,$page = 1)
    {
        $orders = new Order();

        $allOrders = $orders->getOrderByUser(Auth::user()->id);
        $orders = $paginate($allOrders,10);
        
        if (isset($_GET['filter']) && $orders->unique('status_id')->contains('status_id','=',$_GET['filter'])) {
            $orders = $orders->byStatus($_GET['filter']);
        }

        if ($orders->isEmpty()) {
            return view('admin.orders.index',["message"=>"Qui non c'è nessun ordine"]);
        }
        $statuses = Status::all();
        return view('admin.orders.index',compact('orders'),compact('statuses'));
    }

    public function stats(Order $userOrders)
    {

        $userOrders = new Order();

        $userOrders = $userOrders->getOrderByUser(Auth::user()->id);
        if ($userOrders->isEmpty()) {
            return view('admin.orders.stats',["message"=>"Non hai ancora ricevuto nessun ordine."]);
        }
        //retrieves (unique results) all years with at least 1 order for this user
        $yearsWithOrders = $userOrders->toQuery()->selectRaw('YEAR(orders.created_at) as year')->groupBy('year')
        ->get();

        //foreach year we retrieve number of order PER MONTH in that year
        foreach ($yearsWithOrders as $year) {
            $orderByMonth = $userOrders->toQuery()
                        ->selectRaw('count(orders.id) as order_count, DATE_FORMAT(created_at, \'%m) %M\') as month')->orderBy('month')->groupBy('month')
                        ->whereYear('created_at',date($year->year))->get();
            foreach ($orderByMonth as $month) {
                $monthlyStatsForYears[$year->year]["labels"][]= $month->month;
                $monthlyStatsForYears[$year->year]["data"][]= $month->order_count;
            }
        }

       return view('admin.orders.stats',compact('monthlyStatsForYears'));
    }
}