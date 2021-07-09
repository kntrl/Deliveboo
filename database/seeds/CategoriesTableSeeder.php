<?php

use Illuminate\Database\Seeder;
//model
use App\Category;
//per lo slug
use Illuminate\Support\Str;


class CategoriesTableSeeder extends Seeder
{
    
    public function run()
    {
        $categories = [
            "italian",
            "chinese",
            "indian",
            "hamburger",
            "chinese",
        ];


        foreach ($categories as $category) {
            $new_category = new Category();
            $new_category->name = $category;
            $new_category->slug = Str::slug($new_category->name, '-');

            $new_category->save();
        }
    }
}
