<?php

use Illuminate\Database\Seeder;

use App\Food;

use Faker\Generator as Faker;

class FoodOrderTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $foods = Food::all();

        foreach ($foods as $food) {
            $food->orders()->attach($faker->numberBetween(1, 5), ['quantity'=>$faker->numberBetween(1, 3), 'note'=>$faker->words(6, true)]);
        }
    }
}
