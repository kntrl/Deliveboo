<?php

use Illuminate\Database\Seeder;

use App\User;

use Faker\Generator as Faker;


class RestaurantsCategoryTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        
        $users = User::all();
                
        foreach ($users as $user) {
            $categories = [1,2,3,4,5,6,7,8,9,10,11,12];
            $catProbability = [1,1,1,1,1,1,2,2,2,3];
            for ($i = 0; $i < (integer) substr(shuffle($catProbability),0,1);$i++) {
                $randomCat = $faker->numberBetween(0,count($categories)-1);
                $user->categories()->attach($categories[$randomCat]);
                unset($categories[$randomCat]);
                $categories = array_values($categories);
            }
        }
    }
}
