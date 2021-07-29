@extends('layouts.app')

{{-- TEST VIEW ADDED FOR THE SAKE OF TESTING  --}}
@section('content')
<div class="admin-food-index">
    @if (isset($message))
    <div class="row d-flex justify-content-center">
        <div class="alert alert-success col-12 col-sm-6 text-center" role="alert">
            {{$message}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    </div>
    @endif
    {{-- Food collection --}}
    <div class="food-collection">
        
        @foreach (Auth::user()->foods->where('deleted','=',0)->sortBy('name') as $food)

            <div class="single-food">
                
                <div class="food-details">
                    {{-- Food name --}}
                
                    <h3><a href="{{route('admin.foods.edit',['food' => $food->id])}}">{{$food->name}}</a></h3>
                                                

                    {{-- Ingredients --}}              
                    
                    <div class="ingredients">{{$food->ingredients}}</div>
                    
                    {{-- Course --}}                
                    <div class="course">Portata: {{$food->course}}</div>

                    {{-- Availability --}} 
                    @if ($food->available == 1)
                        <div class="availability">Disponibile</div>
                        
                    @else
                        <div class="unavailable">Non disponibile</div>
                    @endif


                    {{-- Price --}}
                    <div class="price">{{$food->price}} €</div>                
                
                
                    {{-- Typology --}}                   

                    <div class="typology">
                        @if ($food->is_vegan == 1)
                            <div> Vegano </div>
                        @endif

                        @if ($food->is_veggy == 1) 
                            <div> Vegetariano </div>
                        @endif

                        @if ($food->is_hot == 1) 
                            <div> Piccante </div>
                        @endif

                        @if ($food->is_lactose_free == 1) 
                            <div> Senza lattosio </div>
                        @endif

                        @if ($food->is_gluten_free == 1) 
                            <div> Senza glutine </div>
                        @endif
                    </div>      
                </div>
                   

                
                
                <div class="btn-container">

                    {{-- Edit button     --}}
                    <div class="edit-btn">
                        <a href="{{route('admin.foods.edit', ['food' =>$food->id])}}">Modifica</a>
                    </div>

                    {{-- Delete button --}}
                    <div class="delete-form">
                        <form action="{{route('admin.foods.destroy', ['food' => $food->id])}} " method="post">
                            @csrf
                            @method('DELETE')
        
                            <input type="submit" id="delete" name="delete" class="delete-btn" value="Elimina">
                        </form>
                    </div>  
                </div>           
                
            </div>

        @endforeach

    </div>
    {{-- end Food collection --}}
</div>
@endsection 