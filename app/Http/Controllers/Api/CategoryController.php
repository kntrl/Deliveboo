<?php

namespace App\Http\Controllers\Api;
use App\Category;

use App\Http\Controllers\Controller;
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

        $response = [
            'category' => $category->name,
            'restaurants' => $restaurants
        ];

        return response()->json($response);
    }
}
