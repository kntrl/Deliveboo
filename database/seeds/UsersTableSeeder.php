<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
//model
use App\User;
//services
use App\Services\Slug;
//zaninotto faker
use Faker\Generator as Faker;



class UsersTableSeeder extends Seeder
{
    public function run(Faker $faker,Slug $slug)
    {
        for ($i=0; $i < 100; $i++) { 
            $new_user = new User();
            $new_user->name = $faker->words($faker->numberBetween(1,4), true);
            $new_user->piva = $faker->shuffle('80123456789');
            $new_user->address = $faker->address(); //da cambiare con faker address ===>>  https://fakerphp.github.io/formatters/#fakerprovideren_usaddress
            $new_user->slug = $slug($new_user->name,'users');
            $new_user->description = $faker->paragraph(6, true);
            $new_user->email = $faker->safeEmail();
            $new_user->password = Hash::make('password');
            ;
            
            $new_user->save();
        }
    }
}
