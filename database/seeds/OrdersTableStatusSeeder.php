<?php

use Illuminate\Database\Seeder;
use App\Order;
use Faker\Generator as Faker;


class OrdersTableStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        //
        $orders = Order::all();
        foreach ($orders as $order) {
            $order->status = $faker->numberBetween(0,4);
            $order->save();
        }

    }
}