<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $burger = Product::create([
            'name' => 'Burger',
            'description' => 'The best burger in town!',
            'price' => 5,
            'image_path' => 'images/products/burger.png'
        ]);

        $beef =  Ingredient::create([
            'name' => 'Beef',
            'stock' => 20,
            'low_stock_amount' => 10,
            'unit' => 'KG'
        ]);

        $cheese = Ingredient::create( [
            'name' => 'Cheese',
            'stock' => 5,
            'low_stock_amount' => 2.5,
            'unit' => 'KG'
        ]);

        $onion = Ingredient::create([
            'name' => 'Onion',
            'stock' => 1,
            'low_stock_amount' => 0.5,
            'unit' => 'KG'
        ]);

        $burger->ingredients()->withPivotValue('unit', 'G')->attach([
            $beef->id => ['qty' => 150],
            $cheese->id => ['qty' => 30],
            $onion->id => ['qty' => 20]
        ]);
    }
}
