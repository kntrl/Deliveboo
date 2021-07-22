@extends('layouts.app')

@section('content')
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
        <div class="dashboard-order w-100">
          @if (!isset($orders))
            <div class="message">
                <h2 class="mb-0">Ops..</h2>
                {{$message}}
            </div>
          @else
          @if ($orders->lastPage() != 1)
            <ul class="pagination my_paginate justify-content-end">
              <li class="page-item {{ $orders->currentPage() == 1 ? 'disabled' : ''}} ">
                <a class="page-link" href="{{route('admin.orders.index')}}?page={{$orders->currentPage() -1}}">Precedenti</a>
              </li>
              <li class="page-item  {{ $orders->currentPage() == $orders->lastPage() ? 'disabled' : ''}}">
                <a class="page-link" href="{{route('admin.orders.index')}}?page={{$orders->currentPage()+1}}">Successivi</a>
              </li>
            </ul>
          @endif
          <div class="order-list pt-20">
            <div id="accordion" class="my_accordion">
              {{-- Single Card --}}
              @foreach ($orders as $order)
      
              <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center" id="heading{{$order->id}}">
                  <h5 class="mb-0">
                    <button class="btn btn-link " data-toggle="collapse" data-target="#collapse{{$order->id}}" aria-expanded="true" aria-controls="collapse{{$order->id}}">
                      Ordine N° {{$order->id}} da {{$order->name}} {{$order->last_name}} 
                    </button>
                  </h5>
                  <div class="order-info d-flex">
                    <div class="date">
                      {{$order->created_at}}
                    </div>
                    <div class="status pl-3">
                      <strong>{{$order->status}}</strong>
                    </div>
                  </div>
                </div>
            
                <div id="collapse{{$order->id}}" class="collapse collapsed " aria-labelledby="heading{{$order->id}}" data-parent="#accordion">
                  <div class="card-body">
      
                      @foreach ($order->foods as $food)
      
                          <div>Qt: {{$food->pivot->quantity}} - {{ucfirst($food->name)}}  </div>
                          <div>Price: {{$food->price}}</div>
      
                          @if($food->pivot->note != '') 
                              <p>Note: {{$food->pivot->note}}</p>
                          @endif
                          
                      @endforeach
      
                      <h5>Total: {{$order->price}}</h5>
                    
                  </div>
                </div>
              </div>           
              @endforeach
              <ul class="pagination my_paginate justify-content-start mt-3">
                <li class="page-item {{ $orders->currentPage() == 1 ? 'disabled' : ''}} ">
                  <a class="page-link" href="{{route('admin.orders.index')}}?page={{$orders->currentPage() -1}}">Precedenti</a>
                </li>
                <li class="page-item  {{ $orders->currentPage() == $orders->lastPage() ? 'disabled' : ''}}">
                  <a class="page-link" href="{{route('admin.orders.index')}}?page={{$orders->currentPage()+1}}">Successivi</a>
                </li>
              </ul>
              {{-- End Single Card --}}
          </div>
        </div>
          @endif 
      </div>
      
      </div> 
    </div> 
@endsection