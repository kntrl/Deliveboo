@extends('layouts.app')

@section('content')
{{-- {{dd($orders)}}
{{dd($orders->where('status_id','=',1))}} --}}
<div class="orders container">
  <div class="dashboard-wrapper">
        {{-- DASHBOARD --}}
        <div class="welcome">     
        <div class="user-info">
            <div class="user"></div>
            <h1>I tuoi ordini</h1>    
        </div>     
        <img src="{{ asset('/img/board..img.svg') }}" alt="">                                 
        
      </div>
    <div class="dashboard-content justify-content-center">
      <div class="order-list-container w-100">
        @if (!isset($orders))
          <div class="message">
              <h2 class="mb-0">Ops..</h2>
              {{$message}}
          </div>
        @else
        <div class="paginated-list pt-20">
          <div class="paginate-nav"></div>
          <div class="filters text-center ">
            <h3>Filtra per stato</h3>
            <div class="filters-label">
              @isset($_GET['filter'])
                <a href="{{route('admin.orders.index')}}"><span class="badge badge-no-filter">MOSTRA TUTTI <i class="fas fa-stream"></i></span></a>
              @endif
              @foreach ($statuses as $status)
                <a href="{{route('admin.orders.index')}}?filter={{$status->id}}"><span class="badge" style="background-color: {{$status->color}}">{{strtoupper($status->name)}} <i class="{{$status->icon}}"></i></span></a>
              @endforeach
            </div>  
          </div>

            @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator )
            @if ($orders->lastPage() != 1)
              <ul class="pagination my_paginate justify-content-end">
                <li class="page-item">
                  <a class="page-link {{ $orders->currentPage() == 1 ? 'disabled' : ''}}" href="{{route('admin.orders.index')}}?page={{$orders->currentPage() -1}}">Precedenti</a>
                </li>
                <li class="page-item">
                  <a class="page-link  {{ $orders->currentPage() == $orders->lastPage() ? 'disabled' : ''}}" href="{{route('admin.orders.index')}}?page={{$orders->currentPage()+1}}">Successivi</a>
                </li>
              </ul>
            @endif
            @endif
          <div id="accordion" class="my_accordion">
            {{-- Single Card --}}
            @foreach ($orders as $order)
            <div class="card mb-2">
              <div class="card-header d-flex justify-content-between align-items-center" id="heading{{$order->id}}">
                <h5 class="mb-0">
                  {{-- Order Title --}}
                  <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{$order->id}}" aria-expanded="true" aria-controls="collapse{{$order->id}}">
                    <i class="fa" aria-hidden="true"></i>Ordine N° {{$order->id}} da {{$order->name}} {{$order->last_name}} 
                  </button>
                </h5>
                {{-- Order info badges --}}
                <div class="info d-flex">
                  <div class="total">
                    <span class="badge badge-price">€ {{$order->price }} <i class="fas fa-money-bill-wave"></i></span>
                  </div>
                  <div class="status">
                    <span class="badge" style="background-color: {{$order->status->color}}">{{strtoupper($order->status->name)}} <i class="{{$order->status->icon}}"></i></span>
                  </div>
                  <div class="date">
                    <span class="badge date-badge">
                      {{$order->created_at->format('d/d/y H:m')}}
                      <i class="far fa-calendar"></i>                    
                    </span>
                  </div>
                </div>
              </div>
          
              <div id="collapse{{$order->id}}" class="collapse collapsed " aria-labelledby="heading{{$order->id}}" data-parent="#accordion">
              {{-- ORDER BODY --}}
                <div class="card-body d-flex flex-wrap">
                  {{-- FOOD LIST --}}
                  <div class="order-content col-12 col-lg-6"">
                    <h5>Contenuto dell'ordine</h5>
                    <ul>
                      {{-- HEADING LI --}}
                      <li>
                        <div class="row flex-grow-1 align-items-center">
                          <div class="col-7"><strong>PIATTI</strong></div>
                          <div class="col-5 text-center"><strong>PZ.</strong></div>
                        </div>
                        
                      </li>
                      @foreach ($order->foods as $food)
                      {{-- single dish --}}
                      <li>
                        <div class="row flex-grow-1 align-items-center">
                          <div class="col-7 dish-name"> <i class="fas fa-caret-right"></i>{{ucfirst($food->name)}}</div>
                          <div class="col-5 text-center">{{$food->pivot->quantity}}</div>
                          @if($food->pivot->note != '') 
                          {{-- NOTE row --}}
                          <div class="col-12">
                            <p class="mt-1 mb-2">
                              <i class="fas fa-exclamation-triangle"></i>
                              {{$food->pivot->note}}
                            </p>
                          </div>
                          @endif
                        </div>
                      </li>
                    {{-- single dish ends --}}
                    @endforeach
                    </ul>  
                  </div>              
                  {{-- FOOD LIST ENDS --}}
                  <div class="order-info col-12 col-lg-6 d-flex flex-wrap">
                    <div>
                      {{-- DELIVERY INFO --}}
                      <h5>Info Consegna</h5>
                      <div class="delivery-info d-flex flex-wrap justify-content-between">
                        <div>
                          <div class="label">destinatario</div>
                          <div class="data">{{ucfirst($order->name)}} {{ucfirst($order->last_name)}}</div>
                        </div>
                        <div>
                          <div class="label"> telefono</div>
                          <div class="data"> {{$order->phone}}</div>
                        </div>
                        <div class="w-100">
                          <div class="label">indirizzo</div>
                          <div class="data">{{ucfirst($order->delivery_address)}}</div>
                        </div>
                      </div>                
                      {{-- DELIVERY INFO ENDS--}}
                    </div>
                    {{-- ORDER UPDATE --}}
                    @if ($order->status_id == 3) 
                      <div class="order-update w-100 align-self-end">
                        <form action="{{route('admin.orders.complete')}}" method="post">
                          @csrf
                          @method('PUT')

                          <input type="hidden" name="uri" value={{Request::getQueryString()}}>
                          <input type="hidden" name="orderid" value={{$order->id}}>
                          <input type="submit" value="COMPLETATO" class="w-100 complete-btn">
                        </form>
                      </div>
                    @endif

                    {{-- ORDER UPDATE  --}}
                  </div>
                </div>
              {{-- ORDER BODY ENDS --}}
             
              </div>
            </div>
                       
            @endforeach
            <ul class="pagination my_paginate justify-content-start mt-3">
              @if($orders instanceof \Illuminate\Pagination\LengthAwarePaginator )
              @if ($orders->lastPage() != 1)
                <ul class="pagination my_paginate justify-content-end">
                  <li class="page-item">
                    <a class="page-link {{ $orders->currentPage() == 1 ? 'disabled' : ''}} " href="{{route('admin.orders.index')}}?page={{$orders->currentPage() -1}}">Precedenti</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link  {{ $orders->currentPage() == $orders->lastPage() ? 'disabled' : ''}}" href="{{route('admin.orders.index')}}?page={{$orders->currentPage()+1}}">Successivi</a>
                  </li>
                </ul>
              @endif
            @endif
            {{-- End Single Card --}}
        </div>
      </div>
        @endif 
    </div>
    
    </div> 
  </div> 
</div>
@endsection