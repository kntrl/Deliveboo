<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Use Faker\Generator as Faker;

class TestCategoryController extends Controller
{
    public function index(){
        $categories = [
            'italiano',
            'indiano',
            'giapponese',
            'libanese',
            'americano',
            'thailandese',
            'pizza',
            'sardo',
            'sushi'
        ];

        $response = [
            'status' => '200',
            'categories' => $categories,
        ];

        return response()->json($response);
    }

    public function show($category){

        $faker = \Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\it_IT\Restaurant($faker));

        $categories = [
            'italiano',
            'indiano',
            'giapponese',
            'libanese',
            'americano',
            'thailandese',
            'pizza',
            'sardo',
            'sushi'
        ];


        if (!in_array(strtolower($category),$categories,true)) {
            $response = [
                'status' => '404',
                'error' => 'Category not found',
            ];
            return response()->json($response);

        }
        //removing from categories the $category parameter used for API call
        unset($categories[array_search($category,$categories)]);
        $categories = array_values($categories);


        for ($i = 0; $i < 10; $i++ ) {
            //resetting categories
            $filteredCat = $categories;

            $restaurantCategories = [strtolower($category)];
            //getting a random number (1 to 5) of categories from $filteredCat array
            for ($y = 0; $y < $faker->numberBetween(0,4);$y++) {
                $randomCatIndex = $faker->numberBetween(0,7-$y);
                $restaurantCategories[] = $filteredCat[$randomCatIndex];
                unset($filteredCat[$randomCatIndex]);
                $filteredCat = array_values($filteredCat);
            }
            
            $restaurant = [
                'name' => str_replace('.','',$faker->sentence($faker->numberBetween(1,3))),
                'categories' =>  $restaurantCategories,
                'description' => $faker->paragraphs(2,true),
            ];
            $restaurants[] = $restaurant;
        }

        $response = [
            'status' => '200',
            'restaurants' => $restaurants
            
        ];

        return response()->json($response);

    }
}
