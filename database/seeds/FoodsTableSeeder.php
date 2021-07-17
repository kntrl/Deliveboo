<?php

use Illuminate\Database\Seeder;

//model
use App\Food;
use App\User;
//zaninotto faker
use App\Services\Slug;

class FoodsTableSeeder extends Seeder
{
    public function run(Slug $slug)
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \FakerRestaurant\Provider\it_IT\Restaurant($faker));
        $users = User::all();
        //seeding each user with Foods
        foreach( $users as $user) {

            //creating up to 10 foods for each user
            for ($i=0; $i < $faker->numberBetween(5,10); $i++) { 
                $new_food = new Food();
                $new_food->name = $faker->foodName();
                $new_food->slug = $slug($new_food->name,'foods');
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
                $new_food->user_id = $user->id;
                $new_food->timestamps = false;
    
                $new_food->save();
            }
        }
    }
}
