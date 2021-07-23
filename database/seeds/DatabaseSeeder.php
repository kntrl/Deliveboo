<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class, 
            CategoriesTableSeeder::class, 
            StatusesTableSeeder::class, 
            RestaurantsCategoryTableSeeder::class,
            FoodsTableSeeder::class, 
            OrdersTableSeeder::class, 
            FoodOrderTableSeeder::class
        ]);
    }
}

// php artisan db:seed