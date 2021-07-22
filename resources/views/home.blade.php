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
                    <span>20</span>                   

                </div>

                <div class="dish-details">

                    <div>Numero piatti non disponibili</div>
                    <span>20</span>                   

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

                    <div>Numero di ordini per mesi</div>
                    <span>20</span>                   

                </div>   

                <div class="dish-details">

                    <div>Numero di ordini per anni</div>
                    <span>20</span>                   

                </div> 

                <div class="dish-details">

                    <div>totale vendite</div>
                    <span>20</span>                   

                </div>   
                 

                <div class="manage-btn">
                    <a href="">Mostra grafico</a>     
                    <a href="{{ route('admin.orders.index') }}">Vai ai tuoi ordini</a>
                   
                </div>           
                
            </div>
            {{-- end Trend --}}
            

        </div>
        {{-- end Dish and trend --}}

        {{-- Order --}}
        <div class="dashboard-order">
            <h2>Ultimi ordini ricevuti</h2>

            {{-- single order --}}
            
            <div class="single-order">
                
                {{-- order title --}}
                <div class="order-title">

                    <div>Numero ordine: 12</div>

                    <div class="order-date">19/07/2021 <div>17.28</div></div>

                    <div>Totale: € 11,90</div>            

                </div>
                {{-- end order title --}}

                {{-- order details --}}
                <div class="order-details">

                    <ul class="dish-name">
                        <li>
                            <h5>Nome piatto</h5>
                        </li>

                        <li>Miso soup</li>

                        <li>Miso soup</li>

                        <li>Miso soup</li>
                    </ul>

                    <ul class="dish-quantity">
                        <li>
                            <h5>Quantità</h5>
                        </li>

                        <li>1</li>

                        <li>1</li>

                        <li>1</li>
                    </ul>

                    

                    <ul class="dish-price">
                        <li>
                            <h5>prezzo</h5>
                        </li>

                        <li>€ 3.90</li>

                        <li>€ 3.90</li>

                        <li>€ 3.90</li>

                    </ul>

                </div>
                {{-- end order details --}}

                <div class="note">
                    Note: 
                </div>
                                           
                            

            </div>  
            {{-- end single order --}}

        </div>
            

    </div>   
    
    
    {{-- end My dashboard --}}

    
</div>

@endsection