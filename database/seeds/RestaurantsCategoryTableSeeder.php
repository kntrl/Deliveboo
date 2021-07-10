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
            $user->categories()->attach($faker->numberBetween(1, 11));
        }
    }
}
