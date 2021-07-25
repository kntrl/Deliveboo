@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.4.1/chart.min.js" integrity="sha512-5vwN8yor2fFT9pgPS9p9R7AszYaNn0LkQElTXIsZFCL7ucT8zDCAqlQXDdaqgA1mZP47hdvztBMsIoFxq/FyyQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="dashboard-wrapper">
    {{-- Auth default  tag --}}
    <div class="auth-default-tag">


        {{-- <div class="">{{ __('Dashboard') }}</div> --}}

        <div class="">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif


            {{-- DASHBOARD --}}
            <div class="welcome">
                
                <div class="user-info">
                    <div class="user"></div>
                    <h1>{{ Auth::user()->name }}</h1>    
                </div>     
                <img src="{{ asset('/img/board..img.svg') }}" alt="">                                 
                
            </div>
            
            {{-- {{ __('You are logged in!') }} --}}
        </div>    
    </div>   
    {{-- end Auth default  tag --}}




    {{-- My dashboard --}}        

    <div class="dashboard-content">

        {{-- Dish and trend  --}}
        <div class="dish-and-trend">

            {{-- Dish --}}
            <div class="dashboard-dish">
                <h2>My Foods</h2>

                <div class="dish-details">

                    <div>Numero totale piatti</div>
                    <span>{{Auth::user()->foods->count()}}</span>                   

                </div>

                <div class="dish-details">

                    <div>Numero piatti non disponibili</div>
                    <span>{{Auth::user()->foods->where('available','=',0)->count()}}</span>                   

                </div>

                <div class="dish-details">

                    <div>Best seller</div>
                    <span><a href="{{route('admin.foods.edit',['food'=>$bestSellerFood])}}">{{$bestSellerFood->name}} ({{$bestSellerFood->orderedTimes}} pz.)</a></span>                   

                </div>
                
                <div class="manage-btn">
                    <a href="{{ route('admin.foods.index') }}">Gestisci i tuoi piatti</a>
                    <a href="{{ route('admin.foods.create') }}">Aggiungi un piatto</a>
                </div>          

            </div>
            {{-- end dish --}}


            {{-- Trend --}}
            <div class="dashboard-order-trend">
                
                <h2>Order Trend</h2>  
                  
                <div class="dish-details">

                    <div>Ordini da preparare</div>
                    <span>{{$userOrders->where('status_id','=','3')->count()}}</span>                   

                </div>   

                <div class="dish-details">

                    <div>Totale ordini ricevuti</div>
                    <span>{{$userOrders->count()}}</span>                   

                </div> 

                <div class="dish-details">

                    <div>Totale incassato</div>
                    <span>€ {{$userOrders->sum('price')}}</span>                   

                </div>   
                
                <div class="dish-details">

                    <div>Media € / ordine</div>
                    <span>€ {{round($userOrders->avg('price'),2)}}</span>                   

                </div>   
                 

                <div class="manage-btn">
                    <a href="">Mostra grafico</a>     
                    <a href="{{ route('admin.orders.index') }}">Vai ai tuoi ordini</a>
                   
                </div>           
                
            </div>
            {{-- end Trend --}}
            

        </div>
        {{-- end Dish and trend --}}

        {{-- STATS --}}
        <div class="dashboard-order">
            <h2>Statistiche</h2>
            <div class="charts-container d-flex flex-wrap justify-content-around">
                    {{-- Monthly order Graph --}}
                    <div class="chart-yearly col-12 col-md-7">
                        <h3>Incasso per mese</h3>
                        <div class="chart-wrapper">
                            {!! $yearlyOrderChart->render() !!}
                        </div>
                    </div>

                    {{-- Course pie charth --}}
                    <div class="chart-course-pie col-12 col-md-5">
                        <h3>Distrubuzione portate</h3>
                        <div class="chart-wrapper">
                            {!! $coursePieChart->render() !!}
                        </div>
                    </div>
                    
                    {{-- Monthly order Graph --}}
                    <div class="chart-yearly col-12">
                        <h3>Andamento degli ultimi 30 giorni</h3>
                        <div class="chart-wrapper ">
                            {!! $orderTrendChart->render() !!}
                        </div>
                    </div>
    
            </div>
        </div>
        {{-- STATS ENDS --}}

    </div>   
    
    
    {{-- end My dashboard --}}

    
</div>

@endsection