<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pizza;

class PizzaSeeder extends Seeder
{
    public function run()
    {
        Pizza::create([
            'name' => 'Маргарита',
            'description' => 'Классическая пицца с томатным соусом, сыром и базиликом.',
            'price' => 499.99,
            'image_url' => 'path_to_image_url',
        ]);

        Pizza::create([
            'name' => 'Пепперони',
            'description' => 'Пицца с пепперони, сыром и томатным соусом.',
            'price' => 599.99,
            'image_url' => 'path_to_image_url',
        ]);


    }
}
