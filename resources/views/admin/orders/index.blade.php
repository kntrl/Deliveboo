@extends('layouts.app')

@section('content')
    
    <div class="container">
        <div id="accordion">

            {{-- Single Card --}}
            @foreach ($orders as $order)

            <div class="card">
              <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                  <button class="btn btn-link " data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Ordine N° {{$order->id}} da {{$order->name}} {{$order->last_name}} 
                  </button>
                </h5>
              </div>
          
              <div id="collapseOne" class="collapse {{ ($loop->first) ? 'show' : 'collapsed' }} " aria-labelledby="headingOne" data-parent="#accordion">
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
            {{-- End Single Card --}}

        </div>
    </div>  
   
@endsection