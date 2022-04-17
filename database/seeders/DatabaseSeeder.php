<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\Setting;
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
        // Customers
        $guest = Customer::create([
           'name' => 'Guest',
            'default' => true
        ]);

        $customer1 = Customer::create([
           'name' => 'Omar Kamal',
           'email' => 'e.omarkamal@gmail.com'
        ]);

        $customer2 = Customer::create([
            'name' => 'Mohammad Ahmad',
            'email' => 'mohammad@gmail.com'
        ]);

        $customer3 = Customer::create([
            'name' => 'Abdullah Tareq',
            'email' => 'abdullah@gmail.com'
        ]);

        // Products
        $beefBurger = Product::create([
            'name' => 'Beef Burger',
            'description' => 'The best burger in town!',
            'price' => 5,
            'image_path' => 'images/products/beef-burger.png'
        ]);

        $doubleBeefBurger = Product::create([
            'name' => 'Double Beef Burger',
            'description' => 'The best burger in town!',
            'price' => 6.5,
            'image_path' => 'images/products/double-beef-burger.png'
        ]);

        $chickenBurger = Product::create([
            'name' => 'Chicken Burger',
            'description' => 'The best burger in town!',
            'price' => 4.30,
            'image_path' => 'images/products/chicken-burger.png'
        ]);

        $doubleChickenBurger = Product::create([
            'name' => 'Double Chicken Burger',
            'description' => 'The best burger in town!',
            'price' => 5.75,
            'image_path' => 'images/products/double-chicken-burger.png'
        ]);

        // Ingredients
        $beef = Ingredient::create([
            'name' => 'Beef',
            'stock' => 20,
            'low_stock_amount' => 10,
            'unit' => 'KG'
        ]);

        $chicken = Ingredient::create([
            'name' => 'Chicken',
            'stock' => 20,
            'low_stock_amount' => 10,
            'unit' => 'KG'
        ]);

        $cheese = Ingredient::create([
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

        $lettuce = Ingredient::create([
            'name' => 'lettuce',
            'stock' => 2,
            'low_stock_amount' => 1,
            'unit' => 'KG'
        ]);

        // Product Ingredients
        $beefBurger->ingredients()->withPivotValue('unit', 'G')->attach([
            $beef->id => ['qty' => 150],
            $cheese->id => ['qty' => 30],
            $onion->id => ['qty' => 20],
            $lettuce->id => ['qty' => 25]
        ]);

        $doubleBeefBurger->ingredients()->withPivotValue('unit', 'G')->attach([
            $beef->id => ['qty' => 300],
            $cheese->id => ['qty' => 60],
            $onion->id => ['qty' => 30],
            $lettuce->id => ['qty' => 30]
        ]);

        $chickenBurger->ingredients()->withPivotValue('unit', 'G')->attach([
            $chicken->id => ['qty' => 150],
            $cheese->id => ['qty' => 30],
            $onion->id => ['qty' => 20],
            $lettuce->id => ['qty' => 25]
        ]);

        $doubleChickenBurger->ingredients()->withPivotValue('unit', 'G')->attach([
            $chicken->id => ['qty' => 300],
            $cheese->id => ['qty' => 60],
            $onion->id => ['qty' => 30],
            $lettuce->id => ['qty' => 30]
        ]);

        // Merchant Settings

        $merchantSettings = Setting::create([
           'key' => 'merchant',
           'value' => [
               'name' => 'Omar Kamal',
               'email' => 'e.omarkamal@gmail.com'
           ]
        ]);
    }
}
