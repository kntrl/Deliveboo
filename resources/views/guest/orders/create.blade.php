@extends('Layouts.app')

@section('content')
<div class="container">

            <form method="POST" action="{{ route('guest.orders.store', ['user' => $user]) }}">
                @csrf
                @method('POST')
                <h2 class="text-center">{{$user->name}}</h2>
                {{-- MENU --}}
                <h4 class="text-center">Menu</h4>
                {{-- MENU CHECKBOXES --}}
                <div class="form-group row">
                    @foreach ($user->foods as $food)
                    <div class="offset-md-4 col-md-6 d-flex justify-content-between">
                        <div>
                            <input type="checkbox" name="foods[]" id="food-{{$food->id}}" value="{{$food->id}}" {{ in_array($food->id, old('foods', [])) ? 'checked' : ''}}>
                            <label class="form-check-label" for="food-{{$food->id}}">{{$food->name}}</label>
                        </div>

                        <div>
                            <label for="quantity{{$food->id}}" value="{{old('quantity'.$food->id)}}"  >Quantità :</label>
                            <input type="number" class="form-control form-control-sm d-inline" name="quantity{{$food->id}}" id="{{$food->id}}" min="0" style="width: 4em;" value="">
                        </div>
                    </div>
                    @endforeach                       
                </div>
              

                {{-- DELIVERY INFO --}}
                <h4 class="text-center">Informazioni di consegna</h4>
                {{-- NAME --}}
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                    <div class="col-md-6">

                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    </div>
                </div>

                {{-- LASTNAME --}}
                <div class="form-group row">
                    <label for="last_name" class="col-md-4 col-form-label text-md-right">Cognome</label>

                    <div class="col-md-6">

                        <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                    </div>
                </div>

                {{-- EMAIL-ADDRESS --}}
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                    <div class="col-md-6">

                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    </div>
                </div>

                {{-- ADDRESS --}}
                <div class="form-group row">
                    <label for="delivery_address" class="col-md-4 col-form-label text-md-right">Indirizzo</label>

                    <div class="col-md-6">

                        <input id="delivery_address" type="text" class="form-control @error('delivery_address') is-invalid @enderror" name="delivery_address" value="{{ old('delivery_address') }}" required autocomplete="delivery_address" autofocus>

                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary">Invia Ordine</button>
                </div>
            
            </form>
        </div>
@endsection