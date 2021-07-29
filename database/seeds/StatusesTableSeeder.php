<?php

use Illuminate\Database\Seeder;
use App\Status;
class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_list = [
                0 => [
                'name' =>'in attesa',
                'color' => '#c4a6ff',
                'icon'=> 'fas fa-cart-arrow-down'
                ],
                1 => [
                    'name'=> 'respinto',
                    'color' => '#ff4d72',
                    'icon'=> 'fas fa-times'
                ],
                2 => [
                    'name'=> 'in preparazione',
                    'color' => '#fca854',
                    'icon'=> 'fas fa-spinner'
                ],
                3 => [
                    'name'=> 'completato',
                    'color' => '#63c9c9',
                    'icon'=> 'fas fa-check'
                ]
            ];

        foreach ($status_list as $statusTemplate) {
            $status = new Status();
            $status->fill($statusTemplate);
            $status->save();
        }
    }
}