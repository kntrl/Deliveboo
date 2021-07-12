@extends('layouts.app')

@section('content')

    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Aggiungi Piatto</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.foods.update', ['food' => $food->id]) }}" >
                            @csrf
                            @method('PUT')


                            {{-- NAME --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Nome piatto</label>
    
                                <div class="col-md-6">

                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $food->name) }}" required autocomplete="name" autofocus>
    
                                </div>
                            </div>
                            
                            {{-- Price --}}
                            <div class="form-group row">
                                <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>
    
                                <div class="col-md-6">

                                    <input id="price" type="text" class="form-control @error('email') is-invalid @enderror" name="price" value="{{ old('price', $food->price) }}" required autocomplete="price">
    
                                </div>
                            </div>
    
                            {{-- Course --}}
                            <div class="form-group row">
                                <label for="course" class="col-md-4 col-form-label text-md-right">Course</label>
    
                                <div class="col-md-6">
                                    <select name="course" id="course">

                                        <option value="primo" {{ old('course', $food->course) == 'primo' ? 'selected' : '' }}>Primo</option>
                                        <option value="secondo" {{ old('course', $food->course) == 'secondo' ? 'selected' : '' }}>Secondo</option>
                                        <option value="contorno" {{ old('course', $food->course) == 'contorno' ? 'selected' : '' }}>Contorno</option>

                                    </select>
                                </div>
                            </div>
    
                            {{-- Ingredients --}}
                            <div class="form-group row">
                                <label for="ingredients" class="col-md-4 col-form-label text-md-right">Ingredients</label>
    
                                <div class="col-md-6">
                                    <textarea name="ingredients" id="ingredients" cols="30" rows="10">{{old('ingredients', $food->ingredients)}}</textarea>
                                </div>
                            </div>
    
                           
                            {{-- Categories --}}
                            <div class="form-group row">
                                <span class="col-md-4 col-form-label text-md-right">Tipo Cibo</span>
                              

                                {{-- category list column --}}
                                <div class="col-md-6 ml-2 d-flex flex-wrap justify-content-between">
                                    
                                    <div class="col-5">

                                        <input class="custom-control-input" name="is_vegan" type="checkbox" value="1" id="is_vegan" {{ old('is_vegan', $food->is_vegan) ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="is_vegan">
                                            Vegano
                                        </label>        
                                       
                                    </div>

                                    <div class="col-5">
                                        
                                        <input class="custom-control-input" name="is_veggy" type="checkbox" value="1" id="is_veggy" {{ old('is_veggy', $food->is_veggy) ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="is_veggy">
                                            Vegetariano
                                        </label>        
                                       
                                    </div>

                                    <div class="col-5">
                                        
                                        <input class="custom-control-input" name="is_hot" type="checkbox" value="1" id="is_hot" {{ old('is_hot', $food->is_hot) ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="is_hot">
                                            Piccante
                                        </label>        
                                       
                                    </div>

                                    <div class="col-5">
                                        
                                        <input class="custom-control-input" name="is_lactose_free" type="checkbox" value="1" id="is_lactose_free" {{ old('is_lactose_free', $food->is_lactose_free) ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="is_lactose_free">
                                            Senza Lattosio
                                        </label>        
                                       
                                    </div>

                                    <div class="col-5">
                                        
                                        <input class="custom-control-input" name="is_gluten_free" type="checkbox" value="1" id="is_gluten_free" {{ old('is_gluten_free', $food->is_gluten_free) ? 'checked' : '' }} >
                                        <label class="custom-control-label" for="is_gluten_free">
                                            Senza Glutine
                                        </label>        
                                       
                                    </div>
                               
                                </div>

                            </div>

                           {{-- Available --}}
                           <div class="form-group row">
                                <label for="available" class="col-md-4 col-form-label text-md-right">Available</label>

                                <div class="col-md-6">
                                    <select name="available" id="available">

                                        <option value="1" {{ old('available', $food->available) == 1 ? 'selected' : '' }} >Disponibile</option>
                                        <option value="0" {{ old('available', $food->available) == 0 ? 'selected' : '' }} >Non Disponibile</option>

                                    </select>
                                </div>

                            </div>

                           

                            
                            {{-- CUSTOM FIELDS SECTION ENDS --}}
    
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Modifica
                                    </button>
                                </div>
                            </div>

                            <form action="{{route('admin.foods.destroy', ['food' => $food->id])}} " method="post">
                                @csrf
                                @method('DELETE')
    
                                <input type="submit" class="btn btn-danger" value="Elimina">
                            </form>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection