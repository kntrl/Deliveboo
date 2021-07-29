@extends('layouts.app')

@section('content')
<div class="dashboard-wrapper">
    <div class="row justify-content-center">
        <div class=" mx-4">
            <div><h1>Verifica il tuo indirizzo email</h1></div>

            <div>
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        Ti abbiamo appena inviato una mail contenente un link per confermare il tuo indirizzo.
                    </div>
                @endif

                <p>Per poter accedere alla dashboard è necessario verificare il tuo indirizzo email. Controlla la tua mail.</p>
                Se non hai ricevuto nessuna mail 
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">clicca qui per riceverne un'altra</button>.
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
