@extends('layouts.app')

{{-- TEST VIEW ADDED FOR THE SAKE OF TESTING  --}}
@section('content')
<div class="admin-food-index">

    {{-- Food collection --}}
    <div class="food-collection">
        
        @foreach (Auth::user()->foods->sortBy('name') as $food)

            <div class="single-food">
                
                {{-- Food name --}}
                
                <h4><a href="{{route('admin.foods.edit',['food' => $food->id])}}">{{$food->name}}</a></h4>
                
                {{-- end Food name --}}

                {{-- Food details --}}

                {{-- Price --}}
                <div class="food-details">
                    <div class="food-key"><strong>Price: </strong></div>
                    <div class="food-value">{{$food->price}} €</div>
                </div>                

                {{-- Course --}}
                <div class="food-details">
                    <div class="food-key"><strong>Course: </strong></div>
                    <div class="food-value">{{$food->course}}</div>
                </div>

                {{-- Availability --}}
                <div class="food-details">
                    <div class="food-key"><strong>Available: </strong></div>
                    <div class="food-value">{{$food->available == 1 ? 'Yes' : 'No'}}</div>
                </div>
                
                {{-- Typology --}}
                @if ($food->is_vegan == 1)

                    <div class="food-details">
                        <div class="food-key"><strong>Vegan: </strong></div>
                        <div class="food-value">{{$food->is_vegan == 1 ? 'Yes' : 'No'}}</div>
                    </div>
                @endif  

                @if ($food->is_veggy == 1)   
                    <div class="food-details">
                        <div class="food-key"><strong>Vegetarian: </strong></div>
                        <div class="food-value">{{$food->is_veggy == 1 ? 'Yes' : 'No'}}</div>
                    </div>
                @endif

                @if ($food->is_hot == 1) 
                    <div class="food-details">
                        <div class="food-key"><strong>Spicy: </strong></div>
                        <div class="food-value">{{$food->is_hot == 1 ? 'Yes' : 'No'}}</div>
                    </div>
                @endif

                @if ($food->is_lactose_free == 1)   
                    <div class="food-details">
                        <div class="food-key"><strong>Lactose Free: </strong></div>
                        <div class="food-value">{{$food->is_lactose_free == 1 ? 'Yes' : 'No'}}</div>
                    </div>
                @endif

                @if ($food->is_gluten_free == 1) 
                    <div class="food-details">
                        <div class="food-key"><strong>Gluten Free: </strong></div>
                        <div class="food-value">{{$food->is_gluten_free == 1 ? 'Yes' : 'No'}}</div>
                    </div>
                @endif  
                {{-- end Typology     --}}

                {{-- Ingredients --}}
                <div class="food-details ingredient">
                    <div class="food-key"><strong>Ingredients: </strong></div>
                    <div class="food-value">{{$food->ingredients}}</div>
                </div>
                
                {{-- Edit button     --}}
                <div class="edit-btn">
                    <a href="{{route('admin.foods.edit', ['food' =>$food->id])}}">Edit</a>
                </div>

                {{-- Delete button --}}
                <div class="delete-form">
                    <form action="{{route('admin.foods.destroy', ['food' => $food->id])}} " method="post">
                        @csrf
                        @method('DELETE')
    
                        <input type="submit" id="delete" name="delete" class="delete-btn" value="Delete">
                    </form>
                </div>
                
                {{-- end Food details --}}
                    
                
                
            </div>

        @endforeach

    </div>
    {{-- end Food collection --}}
</div>
@endsection 