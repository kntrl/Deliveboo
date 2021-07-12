<?php

use Illuminate\Database\Seeder;
use App\Order;

use Faker\Generator as Faker;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Faker\Provider\it_IT\Person($faker));

        //array temporaneo che contiene 3 possibili status per l'ordine
        $temp_status_array = [ 
            0=>'accepted',
            1=>'pending',
            2=>'rejected',
        ];

        for ($i=0; $i < 5; $i++) { 
            $new_order = new Order();
            //customer personal infos
            $new_order->name = $faker->firstNameFemale(); //DA RIPROVARE ===>>> name($gender = null|'male'|'female')
            $new_order->last_name = $faker->lastName();
            $new_order->email = $faker->safeEmail();
            //address infos
            $new_order->delivery_address = $faker->address();
            $new_order->status = $temp_status_array[$faker->numberBetween(0,2)];
            $new_order->price = $faker->randomFloat(2, 1, 50);
 
        
            $new_order->save();
        }
    }
}
