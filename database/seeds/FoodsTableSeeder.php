<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

//model
use App\Food;
//zaninotto faker
use Faker\Generator as Faker;

class FoodsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\it_IT\Restaurant($faker));

        for ($i=0; $i < 5; $i++) { 
            $new_food = new Food();
            $new_food->name = $faker->foodName();
            $new_food->slug = Str::slug($new_food->name, '-');
            $new_food->ingredients = $faker->sentence(3);
            $new_food->price = $faker->randomFloat(2, 1, 50);
            $new_food->course = $faker->word();
            $new_food->available = $faker->numberBetween(0,1);
            
            // dettagli extra per il piatto
            $new_food->is_vegan = $faker->numberBetween(0,1);
            $new_food->is_veggy = $faker->numberBetween(0,1);
            $new_food->is_hot = $faker->numberBetween(0,1);
            $new_food->is_lactose_free = $faker->numberBetween(0,1);
            $new_food->is_gluten_free = $faker->numberBetween(0,1);

            //
            $new_food->user_id = $faker->numberBetween(1,5);
            $new_food->timestamps = false;

            $new_food->save();
        }
    }
}
