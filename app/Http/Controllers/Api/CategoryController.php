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
 
                foreach ($element->categories as $category) {
                    $elementCategories[] = [
                        'name' => $category->name,
                        'slug' => $category->slug,
                    ];
                }
                $restaurant = [
                    'id' => $element->id,
                    'name' => $element->name,
                    'slug' => $element->slug,
                    'address' => $element->address,
                    'description' => $element->description,
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
