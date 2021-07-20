@extends('layouts.app')

@section('content')
<div class="receipt container mt-2">

    @if ($result->success)
        <h1>Grazie per il tuo ordine</h1>        
        <p>Numero ordine: 0000{{$order->id}}</p>
        <p>A breve verrà consegnato presso: {{$order->delivery_address}}</p>
    @else
        <h1>Qualcosa è andato storto</h1>
        @if ($result->message)
          <strong>Errore:</strong> <p>{{($result->message)}}</p>
          <strong>Stato dell'ordine: </strong> <p>{{$order->status}}</p>
        @endif
    @endif


</div>

@endsection