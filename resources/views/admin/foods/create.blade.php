@extends('layouts.app')

@section('content')

    <div class="admin-create">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        
    
        <div class="create-form">

            <div class="create-form-title">  
                <h2>Crea un nuovo piatto da aggiungere al menù del tuo ristorante</h2>                
            </div>

            {{-- Form --}}
            <div class="form-create-body">
                <form method="POST" action="{{ route('admin.foods.store') }}">
                    @csrf
                    @method('POST')


                    {{-- NAME --}}
                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label str-label text-md-right">Nome piatto</label>

                        <div class="col-md-6">

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        </div>
                    </div>
                    
                    {{-- Price --}}
                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label str-label text-md-right">Price</label>

                        <div class="col-md-6">

                            <input id="price" type="text" class="form-control @error('email') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price">

                        </div>
                    </div>

                    {{-- Course --}}
                    <div class="form-group row">
                        <label for="course" class="col-md-4 col-form-label str-label text-md-right">Course</label>

                        <div class="col-md-6">
                            <select name="course" class="custom-select" id="course">

                                <option value="primo" {{ old('course') == 'primo' ? 'selected' : '' }}>Primo</option>
                                <option value="secondo" {{ old('course') == 'secondo' ? 'selected' : '' }}>Secondo</option>
                                <option value="contorno" {{ old('course') == 'contorno' ? 'selected' : '' }}>Contorno</option>

                            </select>
                        </div>
                    </div>

                    {{-- Ingredients --}}
                    <div class="form-group row">
                        <label for="ingredients" class="col-md-4 col-form-label str-label text-md-right">Ingredients</label>

                        <div class="col-md-6">
                            <textarea name="ingredients" id="ingredients" class="form-control" cols="30" rows="10">{{old('ingredients')}}</textarea>
                        </div>
                    </div>

                    
                    {{-- Categories --}}
                    <div class="form-group row">
                        <span class="col-md-4 col-form-label str-label text-md-right">Tipo Cibo</span>
                        

                        {{-- category list column --}}
                        <div class="col-md-6 ml-2 d-flex flex-wrap justify-content-between">
                            
                            <div class="col-5">

                                <input class="custom-control-input" name="is_vegan" type="checkbox" value="1" id="is_vegan" {{ old('is_vegan') ? 'checked' : '' }} >
                                <label class="custom-control-label" for="is_vegan">
                                    Vegano
                                </label>        
                                
                            </div>

                            <div class="col-5">
                                
                                <input class="custom-control-input" name="is_veggy" type="checkbox" value="1" id="is_veggy" {{ old('is_veggy') ? 'checked' : '' }} >
                                <label class="custom-control-label" for="is_veggy">
                                    Vegetariano
                                </label>        
                                
                            </div>

                            <div class="col-5">
                                
                                <input class="custom-control-input" name="is_hot" type="checkbox" value="1" id="is_hot" {{ old('is_hot') ? 'checked' : '' }} >
                                <label class="custom-control-label" for="is_hot">
                                    Piccante
                                </label>        
                                
                            </div>

                            <div class="col-5">
                                
                                <input class="custom-control-input" name="is_lactose_free" type="checkbox" value="1" id="is_lactose_free" {{ old('is_lactose_free') ? 'checked' : '' }} >
                                <label class="custom-control-label" for="is_lactose_free">
                                    Senza Lattosio
                                </label>        
                                
                            </div>

                            <div class="col-5">
                                
                                <input class="custom-control-input" name="is_gluten_free" type="checkbox" value="1" id="is_gluten_free" {{ old('is_gluten_free') ? 'checked' : '' }} >
                                <label class="custom-control-label" for="is_gluten_free">
                                    Senza Glutine
                                </label>        
                                
                            </div>
                        
                        </div>

                    </div>

                    {{-- Available --}}
                    <div class="form-group row">
                        <label for="available" class="col-md-4 col-form-label str-label text-md-right">Available</label>

                        <div class="col-md-6">
                            <select name="available" id="available" class="custom-select">

                                <option value="1" selected>Disponibile</option>
                                <option value="0">Non Disponibile</option>

                            </select>
                        </div>

                    </div>

                    

                    
                    {{-- CUSTOM FIELDS SECTION ENDS --}}

                    <div class="btn-create">
                        
                        <button type="submit" class="btn btn-outline-primary">
                            Aggiungi piatto
                        </button>
                        
                    </div>

                </form>

            </div>
            {{-- end Form --}}
        </div>
            
        
    </div>
    
@endsection