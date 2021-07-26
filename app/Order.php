<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Order extends Model
{
    
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'delivery_address',
        'phone',
        'status'
    ];
    
    public $colors =[
        'rgba(255, 99, 132, 0.7)',
        'rgba(54, 162, 235, 0.7)',
        'rgba(255, 206, 86, 0.7)',
        'rgba(75, 192, 192, 0.7)',
        'rgba(153, 102, 255, 0.7)',
        'rgba(255, 159, 64, 0.7)'
    ];

    
    public $monthsList =[
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];

    public function foods()
    {
        return $this->belongsToMany(Food::class)->withPivot('quantity','note');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * retrives all Orders for a given user Id
     * @param int users.id
     * 
     * @return Order eloquent collection
     */
    public function getOrderByUser($userID)
    {
        $orders = Order::join('food_order', 'orders.id', '=', 'food_order.order_id')
        ->join('foods', 'foods.id', '=', 'food_order.food_id')
        ->join('users', 'users.id', '=', 'foods.user_id')
        ->where('users.id','=',$userID)
        ->where('orders.status_id','>','2')
        ->select('orders.*')
        ->orderBy('id','desc')
        ->get()->unique();

        return $orders;
    }


    /**
     * 
     * 
     * 
     */
    public function getYearlyChart($orders)
    {

        $yearsWithOrders = $orders->toQuery()->selectRaw('YEAR(orders.created_at) as year')->groupBy('year')
        ->get();

        
        //foreach year we retrieve number of order PER MONTH in that year
        foreach ($yearsWithOrders as $key=>$year) {
            $orderByMonth = $orders->toQuery()
                        ->selectRaw('sum(orders.price) as order_count, DATE_FORMAT(created_at, \'%M\') as month')->orderBy('month')->groupBy('month')
                        ->whereYear('created_at',date($year->year))->get();

            //creating template for ChartJS dataset
            $monthlyStatsForYears[$year->year] =[
                'label'=> $year->year,
                'data' => [],
                'backgroundColor'=>$this->colors[$key],

            ];

            //for each month we get order count. If there's no record for that month we assign 0
            foreach($this->monthsList as $key=>$monthName){
                $monthlyStatsForYears[$year->year]['data'][$key] = $orderByMonth->firstWhere('month','=',$monthName) ? $orderByMonth->firstWhere('month','=',$monthName)->order_count : 0;
            }
            
        }

        $chartSales = app()->chartjs
                            ->name('yearlyOrder')
                            ->type('bar')
                            ->size(['width'=>300,'height'=>300])
                            ->labels($this->monthsList)
                            ->datasets(array_values($monthlyStatsForYears))
                            ->optionsRaw('
                            {
                                responsive : true,
                                plugins: {
                                    title: {
                                        display:true,
                                    },
                                    tooltip: {
                                            callbacks: {
                                                label: function(tooltipItems) {
                                                    console.log(tooltipItems);
                                                    return tooltipItems.dataset.label+\':\'+ tooltipItems.dataset.data[tooltipItems.dataIndex].toFixed(2) + \'€ \'  ;
                                                }
                                        }
                                    }
                              }
                            }');
                            
        
        return $chartSales;
    }
    
    /**
     * 
     * 
     * 
     */
    public function getCoursePieChart($orders)
    {
        $courseOrdered = $orders->load('foods');
        $courseOrdered = $courseOrdered->toQuery()
                        ->join('food_order','orders.id','=','food_order.order_id')
                        ->join('foods','foods.id','=','food_order.food_id')
                        ->selectRaw('foods.course,sum(food_order.quantity) as course_count')->groupBy('foods.course')->orderByDesc('course_count')->get();       

        //creating template for ChartJS dataset
        foreach ($courseOrdered as $key=>$course) {

            $courseDataset['labels'][]=$course->course;
            $courseDataset['dataset']['data'][]= number_format($course->course_count / $courseOrdered->sum('course_count') *100,0);
            $courseDataset['dataset']['backgroundColor'][]=$this->colors[$key];

        }

        $chartCourse = app()->chartjs
            ->name('coursePopularity')
            ->type('doughnut')
            ->size(['width'=>200,'height'=>100])
            ->labels($courseDataset['labels'])
            ->datasets([$courseDataset['dataset']])
            ->optionsRaw('
            {
                legend: {
                    labels: {
                      fontSize: 10,
                      usePointStyle: true,
                      padding: 20
                    }
                },
                responsive : true,
                plugins: {
                    title: {
                        display:true,
                    },
                    tooltip: {
                            callbacks: {
                                label: function(tooltipItems) {
                                    return coursePopularity.data.labels[tooltipItems.dataIndex] +\': \' + coursePopularity.data.datasets[tooltipItems.datasetIndex].data[tooltipItems.dataIndex] + \' %\';
                            }
                        }
                    }
                },
            }');
                            
        return $chartCourse;
    }

    public function getTrendChart($orders)
    {
        
        
        $orderTrend = $orders->toQuery()->selectRaw('count(id) as order_count,DATE_FORMAT(created_at, \'%m/%d\') as day')->where('created_at','>=',Carbon::now()->subDays(30))->groupBy('day')->orderBy('day')->get();       
        // dd($orderTrend);
        //creating template for ChartJS dataset
        foreach ($orderTrend as $key=>$order) {

            $courseDataset['labels'][]=substr($order->day,3,2).'/'.substr($order->day,0,2);
            $courseDataset['dataset']['data'][]= $order->order_count;
            

        }
        $courseDataset['dataset']['borderColor'][]='rgb(75, 192, 192)';
        $courseDataset['dataset']['backgroundColor'][]='rgb(75, 192, 192)';
        $courseDataset['dataset']['label']='Numero ordini';
        $courseDataset['dataset']['tension']=0.1;
        $maxTick =  max($courseDataset['dataset']['data']) + 1 ;
        $chartTrend = app()->chartjs
            ->name('orderTrend')
            ->type('line')
            ->size(['width'=>200,'height'=>100])
            ->labels($courseDataset['labels'])
            ->datasets([$courseDataset['dataset']])
             ->optionsRaw('
            {
                scales: {
                    yAxes: {
                        beginAtZero:true,
                        ticks: {
                            stepSize: 1
                            
                        },
                        max:'.$maxTick.'
                    }
                },
                responsive : true,
            }');
                            
        return $chartTrend;
    }
}
