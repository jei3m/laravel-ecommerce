<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Gaming Laptop',
                'price' => 1299.99,
                'description' => 'High-performance gaming laptop with RTX 3070',
                'category' => 'Electronics',
                'stock' => 10,
                'image' => 'products/placeholder.png'
            ],
            [
                'name' => 'Wireless Headphones',
                'price' => 199.99,
                'description' => 'Premium wireless headphones with noise cancellation',
                'category' => 'Electronics',
                'stock' => 20,
                'image' => 'products/placeholder.png'
            ],
            [
                'name' => 'Smart Watch',
                'price' => 299.99,
                'description' => 'Advanced smartwatch with health tracking features',
                'category' => 'Electronics',
                'stock' => 15,
                'image' => 'products/placeholder.png'
            ],
            [
                'name' => 'Coffee Maker',
                'price' => 79.99,
                'description' => 'Programmable coffee maker with thermal carafe',
                'category' => 'Home & Kitchen',
                'stock' => 25,
                'image' => 'products/placeholder.png'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
