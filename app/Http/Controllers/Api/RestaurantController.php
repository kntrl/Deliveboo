<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = User::all();

        $response = [
            'restaurants' => $restaurants
        ];

        return response()->json($response);

    }

    public function show(User $user)
    {
        $user->foods;

        $response = [
            'restaurant' => $user
        ];

        return response()->json($response);

    }

    public function search($queryString)
    {
       $restaurants = User::where('name','LIKE','%'.$queryString.'%')->get();

       $response = [
           'restaurants' => $restaurants
       ];
     
       return response()->json($response);
    }
}
