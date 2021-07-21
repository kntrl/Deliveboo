@extends('layouts.app')

@section('content')
<div class="error container mt-2 text-center">
    <h1>Non autorizzato</h1>
    <p>Non sei autorizzato ad accedere a questa risorsa,<a href="{{route('guest.welcome')}}">torna alla home.</a></p>    
</div>

@endsection