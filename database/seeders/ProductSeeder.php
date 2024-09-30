<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = [
            [
                'name' => 'Smartphone',
                'quantity' => 50,
                'price' => 299.99,
                'seller_id' => 1,
                'category_id' => Category::where('name', 'Electronics')->first()->id,
            ],
            [
                'name' => 'Laptop',
                'quantity' => 30,
                'price' => 999.99,
                'seller_id' => 2,
                'category_id' => Category::where('name', 'Electronics')->first()->id,
            ],
            [
                'name' => 'T-shirt',
                'quantity' => 100,
                'price' => 19.99,
                'seller_id' => 2,
                'category_id' => Category::where('name', 'Clothing')->first()->id,
            ],
            [
                'name' => 'Refrigerator',
                'quantity' => 15,
                'price' => 499.99,
                'seller_id' => 3,
                'category_id' => Category::where('name', 'Home Appliances')->first()->id,
            ],
            [
                'name' => 'Fiction Book',
                'quantity' => 80,
                'price' => 9.99,
                'seller_id' => 3,
                'category_id' => Category::where('name', 'Books')->first()->id,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
