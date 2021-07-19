@extends('layouts.app')

@section('content')

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
                <div class="user"></div>
                <h1>{{ Auth::user()->name }}</h1>
            </div>
            {{-- {{ __('You are logged in!') }} --}}
        </div>    
    </div>   
    {{-- end Auth default  tag --}}




    {{-- My dashboard --}}        

    <div class="dashboard-content">

        <div class="dish-and-order">

            <div class="dashboard-dish">
                <h2>Il Tuo Menù</h2>

                <ul class="menu">
                    <li>
                        <h5>Zuppa di miso</h5>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                        <div>€ <span>6.30</span></div>
                    </li>

                    <li>
                        <h5>Zuppa di miso</h5>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                        <div>€ <span>6.30</span></div>
                    </li>

                    <li>
                        <h5>Zuppa di miso</h5>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                        <div>€ <span>6.30</span></div>
                    </li>
                                     
                </ul>
                <div class="manage-btn">
                    <a href="{{ route('admin.foods.index') }}">Gestisci il tuo menù</a>
                </div>

            </div>

            <div class="dashboard-order">
                <h2>I Tuoi Ordini</h2>

                <ul class="menu">
                    <li>
                        <h5>Zuppa di miso</h5>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                        <div>€ <span>6.30</span></div>
                    </li>

                    <li><h5>Zuppa di miso</h5>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                        <div>€ <span>6.30</span></div>
                    </li>

                    <li>
                        <h5>Zuppa di miso</h5>
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                        <div>€ <span>6.30</span></div>
                    </li>              
                                   

                </ul>

                <div class="manage-btn">
                    <a href="{{ route('admin.orders.index') }}">Gestisci i tuoi ordini</a>
                </div>

            </div>

        </div>

        <div class="dashboard-order-trend">
            <div>
                <h2>Order Trend</h2>
                <a href="">Mostra grafico</a>
            </div>
            

            <div class="order-trend">
                <div class="order per-month">
                    per month <span>69%</span>
                </div>
    
                <div class="order per-year">
                    per year <span>87%</span>
                </div>
            </div>           
            
        </div>

    </div>        
    {{-- end My dashboard --}}

    
</div>

@endsection