<?php

namespace App\Http\Controllers\Api;
use App\Category;

use App\Http\Controllers\Controller;
use Braintree\Address;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $response = [
            'categories' => $categories
        ];

        return response()->json($response);
    }

    public function show(Category $category)
    {
        $restaurants = $category->users;
        $responseRestaurants = [];
        if ($restaurants->count() !=0 ) {
            foreach ($restaurants as $element) {
                $elementCategories=[];
                foreach ($element->categories->unique() as $restCategory) {
                    $elementCategories[] = [
                        'name' => $restCategory->name,
                        'slug' => $restCategory->slug,
                    ];
                }
                $restaurant = [
                    'id' => $element->id,
                    'name' => ucfirst($element->name),
                    'slug' => $element->slug,
                    'vote' => round($element->vote,0,PHP_ROUND_HALF_DOWN),
                    'phone' => $element->phone,
                    'address' => ucfirst($element->address),
                    'description' => ucfirst($element->description),
                    'piva' => $element->piva,
                    'categories' => $elementCategories
                ];  
                $responseRestaurants[]= $restaurant;
            }
    
        }
        $response = [
            'restaurants' => $responseRestaurants
        ];
        return response()->json($response);
    }
}
