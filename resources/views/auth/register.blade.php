@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nome attività</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        {{-- CUSTOM FIELDS Section --}}
                        {{-- Address --}}
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Indirizzo attività</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Partita Iva --}}
                        <div class="form-group row">
                            <label for="piva" class="col-md-4 col-form-label text-md-right">Partita Iva</label>

                            <div class="col-md-6">
                                <input id="piva" type="text" class="form-control @error('piva') is-invalid @enderror" name="piva" value="{{ old('piva') }}" required autocomplete="piva" autofocus>

                                @error('piva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        {{-- Categories --}}
                        <div class="form-group row">
                            <span class="col-md-4 col-form-label text-md-right"> Categorie Ristorante</span>
                            @error('categories')
                            <span class="invalid-feedback" role="alert">
                                <strong>At least one category has to be checked</strong>
                            </span>
                            @enderror
                            {{-- category list column --}}
                            <div class="col-md-6 ml-2 d-flex flex-wrap justify-content-between">
                                @foreach ($categories as $category)
                                    <div class="{{ $loop->last ? 'col-12' : 'col-5'}}">
                                    <input class="custom-control-input @error('categories') is-invalid @enderror" name="categories[]" type="checkbox" value="{{$category->id}}" id="category-{{$category->id}}" >
                                    <label class="custom-control-label" for="category-{{$category->id}}">
                                        {{$category->name}}
                                    </label>        
                                    @if ($loop->last)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>At least one category has to be checked</strong>
                                        </span>
                                    @endif
                                </div>
                            @endforeach
                            </div>
                            
                        </div>
                       
                        {{-- CUSTOM FIELDS SECTION ENDS --}}

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection