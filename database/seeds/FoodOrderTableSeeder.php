<?php

use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Illuminate\Support\Collection;
use App\Order;
use App\Food;
use App\User;

class FoodOrderTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        $orders = Order::all();
        $users = User::all();
           
        foreach ($orders as $order) {

            //picking a random restaurant(user) that will get his foods orderered
            $user = $users->random();
    
            //getting foods from restaurant(user)
            $foods = $user->foods->shuffle();
    
            //assigning up to 4 foods to order
            for ($i = 0; $i < $faker->numberBetween(1,4); $i++) {
                $order->foods()->attach($foods[$i]->id, ['quantity'=>$faker->numberBetween(1, 3), 'note'=>$faker->words(6, true)]);
            }
    
        }
    }
}
