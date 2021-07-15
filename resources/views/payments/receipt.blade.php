@extends('layouts.app')

@section('content')
<div class="receipt container">
    @if ($result->success)
        <h1>Grazie per il tuo ordine</h1>        
        {{dd($result)}}
    @else
        <h1>Qualcosa è andato storto</h1>
        @if ($result->message)
          <strong>Errore:</strong> {{($result->message)}}
          {{$result}}
        @endif
    @endif


</div>

@endsection