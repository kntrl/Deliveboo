@extends('layouts.app')

@section('content')

    <div class="admin-create-edit">

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
            <div class="row justify-content-end right">
                <div class="col-md-9 col-lg-7 col-xl-6">
                    <div class="create-form-title">
                        <h4>Modifica il tuo piatto</h4>
                    </div>
        
                    {{-- Form --}}
                    <div class="card">
                        <div class="card-body">
                        
                            <form method="POST" action="{{ route('admin.foods.update', ['food' => $food->id]) }}" >
                                @csrf
                                @method('PUT')
            
            
                                {{-- NAME --}}
                                <div class="form-group row">
                                    <label for="name" class="col-md-5 col-form-label str-label text-md-right">Nome piatto</label>
            
                                    <div class="col-md-6">
            
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $food->name) }}" required autocomplete="name" autofocus>
            
                                    </div>
                                </div>
                                
                                {{-- Price --}}
                                <div class="form-group row">
                                    <label for="price" class="col-md-5 col-form-label str-label text-md-right">Price</label>
            
                                    <div class="col-md-6">
            
                                        <input id="price" type="text" class="form-control @error('email') is-invalid @enderror" name="price" value="{{ old('price', $food->price) }}" required autocomplete="price">
            
                                    </div>
                                </div>
            
                                {{-- Course --}}
                                <div class="form-group row">
                                    <label for="course" class="col-md-5 col-form-label str-label text-md-right">Portata</label>
            
                                    <div class="col-md-6">
                                        <select name="course" class="custom-select" id="course">

                                            @foreach ($courses as $course)
                                            <option value= {{$course}} {{ old('course', $course) == $food->course ? 'selected' : '' }}>{{$course}}</option>
                                            @endforeach
                        
                                        </select>
                                    </div>
                                </div>
            
                                {{-- Ingredients --}}
                                <div class="form-group row">
                                    <label for="ingredients" class="col-md-5 col-form-label str-label text-md-right">Ingredienti</label>
            
                                    <div class="col-md-6">
                                        <textarea name="ingredients" id="ingredients" class="form-control" cols="30" rows="10">{{old('ingredients', $food->ingredients)}}</textarea>
                                    </div>
                                </div>
            
                                
                                {{-- Categories --}}
                                <div class="form-group row">
                                    <span class="col-md-5 col-form-label str-label text-md-right">Tipo Cibo</span>
                                    
            
                                    {{-- category list column --}}
                                    <div class="description col-md-6 ml-2 d-flex flex-wrap">
                                        
                                        <div class="col-6 categories">
                                            {{--<img src="{{asset('/img/vegan1.png') }}" alt="">--}}
                                            <input class="custom-control-input" name="is_vegan" type="checkbox" value="1" id="is_vegan" {{ old('is_vegan', $food->is_vegan) ? 'checked' : '' }} >
                                            <label class="custom-control-label" for="is_vegan">
                                                Vegano
                                            </label>        
                                            
                                        </div>
            
                                        <div class="col-6 categories">
                                            {{--<img src="{{asset('/img/vegetarian.png') }}" alt="">--}}
                                            <input class="custom-control-input" name="is_veggy" type="checkbox" value="1" id="is_veggy" {{ old('is_veggy', $food->is_veggy) ? 'checked' : '' }} >
                                            <label class="custom-control-label" for="is_veggy">
                                                Vegetariano
                                            </label>        
                                            
                                        </div>
            
                                        <div class="col-6 categories">
                                            {{--<img src="{{asset('/img/spicy1.jpg') }}" alt="">--}}
                                            <input class="custom-control-input" name="is_hot" type="checkbox" value="1" id="is_hot" {{ old('is_hot', $food->is_hot) ? 'checked' : '' }} >
                                            <label class="custom-control-label" for="is_hot">
                                                Piccante
                                            </label>        
                                            
                                        </div>
            
                                        <div class="col-6 categories">
                                            {{--<img src="{{asset('/img/no-lactose.png') }}" alt="">--}}
                                            <input class="custom-control-input" name="is_lactose_free" type="checkbox" value="1" id="is_lactose_free" {{ old('is_lactose_free', $food->is_lactose_free) ? 'checked' : '' }} >
                                            <label class="custom-control-label" for="is_lactose_free">
                                                Senza Lattosio
                                            </label>        
                                            
                                        </div>
            
                                        <div class="col-6 categories">
                                            {{--<img src="{{asset('/img/no-gluten.png') }}" alt="">--}}
                                            <input class="custom-control-input" name="is_gluten_free" type="checkbox" value="1" id="is_gluten_free" {{ old('is_gluten_free', $food->is_gluten_free) ? 'checked' : '' }} >
                                            <label class="custom-control-label" for="is_gluten_free">
                                                Senza Glutine
                                            </label>        
                                            
                                        </div>
                                    
                                    </div>
            
                                </div>
            
                                {{-- Available --}}
                                <div class="form-group row">
                                    <label for="available" class="col-md-5 col-form-label str-label text-md-right">Available</label>
            
                                    <div class="col-md-6">
                                        <select name="available" id="available" class="custom-select">
            
                                            <option value="1" {{ old('available', $food->available) == 1 ? 'selected' : '' }} >Disponibile</option>
                                            <option value="0" {{ old('available', $food->available) == 0 ? 'selected' : '' }} >Non Disponibile</option>
            
                                        </select>
                                    </div>
            
                                </div>
            
                                {{-- BUTTONS --}}
                                
                                <div class="form-group  ">
                                    <div class="btn_green">
                                        {{-- EDIT --}}
                                        <button type="submit" id="edit" name="edit" class="btn btn-success">
                                            Modifica piatto
                                        </button>
                                    </div>
                                </div>
                                       
                            </form>
                            {{-- end form --}}
            
                            {{-- DELETE --}}
                            <div class="delete-form">
                               <form action="{{route('admin.foods.destroy', ['food' => $food->id])}} " method="post">
                               @csrf
                               @method('DELETE')
    
                               <input type="submit" id="delete" name="delete" class="btn btn-danger" value="Elimina piatto">
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        
    </div>
    
@endsection