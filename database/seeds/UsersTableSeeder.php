<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
//model
use App\User;
//zaninotto faker
use Faker\Generator as Faker;

class UsersTableSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        for ($i=0; $i < 5; $i++) { 
            $new_user = new User();
            $new_user->name = $faker->words($faker->numberBetween(1,3), true);
            $new_user->piva = $faker->shuffle('80123456789');
            $new_user->address = $faker->address(); //da cambiare con faker address ===>>  https://fakerphp.github.io/formatters/#fakerprovideren_usaddress
            $new_user->slug = Str::slug($new_user->name, '-');
            $new_user->description = $faker->paragraph(6, true);
            $new_user->email = $faker->safeEmail();
            $new_user->password = $faker->password();
            
            $new_user->save();
        }
    }
}
