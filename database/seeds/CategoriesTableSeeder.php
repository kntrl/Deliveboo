<?php

use Illuminate\Database\Seeder;
//model
use App\Category;
//services
use App\Services\Slug;


class CategoriesTableSeeder extends Seeder
{
    
    public function run(Slug $slug)
    {
        $categories = [
            "italiano",
            "cinese",
            "indiano",
            "hamburger",
            "pizza",
            "libanese",
            "americano",
            "sushi",
            "vegano",
            "messicano",
            "kebab",
            "hawaiano"
        ];


        foreach ($categories as $category) {
            $new_category = new Category();
            $new_category->name = $category;
            $new_category->slug = $slug($new_category->name,'categories');

            $new_category->timestamps = false;
            $new_category->save();
        }
    }
}
