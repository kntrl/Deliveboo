@extends('layouts.app')

{{-- TEST VIEW ADDED FOR THE SAKE OF TESTING  --}}
@section('content')
<div class="container">
    <div class="row">
    @foreach (Auth::user()->foods as $food)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="card-header"><h5><a href="{{route('admin.foods.edit',['food' => $food->id])}}">{{$food->name}}</a></h5></div>
                <div class="card-body">
                    <div class="row">
                        <div class="pl-3"><strong>Price: </strong></div>
                        <div class="px-1">{{$food->price}} €</div>
                    </div>
                    <div class="row">
                        <div class="pl-3"><strong>Ingredients: </strong></div>
                        <div class="px-1">{{$food->ingredients}}</div>
                    </div>
                    <div class="row">
                        <div class="pl-3"><strong>Course: </strong></div>
                        <div class="px-1">{{$food->course}}</div>
                    </div>
                    <div class="row">
                        <div class="pl-3"><strong>Available: </strong></div>
                        <div class="px-1">{{$food->available == 1 ? 'Yes' : 'No'}}</div>
                    </div>
                    <div class="row">
                        <div class="pl-3"><strong>Vegan: </strong></div>
                        <div class="px-1">{{$food->is_vegan == 1 ? 'Yes' : 'No'}}</div>
                    </div>
                    <div class="row">
                        <div class="pl-3"><strong>Vegetarian: </strong></div>
                        <div class="px-1">{{$food->is_veggy == 1 ? 'Yes' : 'No'}}</div>
                    </div>
                    <div class="row">
                        <div class="pl-3"><strong>Spicy: </strong></div>
                        <div class="px-1">{{$food->is_hot == 1 ? 'Yes' : 'No'}}</div>
                    </div>
                    <div class="row">
                        <div class="pl-3"><strong>Lactose Free: </strong></div>
                        <div class="px-1">{{$food->is_lactose_free == 1 ? 'Yes' : 'No'}}</div>
                    </div>
                    <div class="row">
                        <div class="pl-3"><strong>Gluten Free: </strong></div>
                        <div class="px-1">{{$food->is_gluten_free == 1 ? 'Yes' : 'No'}}</div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection 