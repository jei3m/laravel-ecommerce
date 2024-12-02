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
                'image' => 'https://placehold.co/400'
            ],
            [
                'name' => 'Headphones',
                'price' => 199.99,
                'description' => 'Premium wireless headphones with noise cancellation',
                'category' => 'Electronics',
                'stock' => 20,
                'image' => 'https://placehold.co/400'
            ],
            [
                'name' => 'Smart Watch',
                'price' => 299.99,
                'description' => 'Advanced smartwatch with health tracking features',
                'category' => 'Electronics',
                'stock' => 15,
                'image' => 'https://placehold.co/400'
            ],
            [
                'name' => 'Coffee Maker',
                'price' => 79.99,
                'description' => 'Programmable coffee maker with thermal carafe',
                'category' => 'Home & Kitchen',
                'stock' => 25,
                'image' => 'https://placehold.co/400'
            ],
            [
                'name' => 'Office Chair',
                'price' => 149.99,
                'description' => 'Ergonomic office chair with lumbar support',
                'category' => 'Furniture',
                'stock' => 30,
                'image' => 'https://placehold.co/400'
            ],
            [
                'name' => 'Bluetooth Speaker',
                'price' => 89.99,
                'description' => 'Portable Bluetooth speaker with 360-degree sound',
                'category' => 'Electronics',
                'stock' => 40,
                'image' => 'https://placehold.co/400'
            ],
            [
                'name' => 'Electric Kettle',
                'price' => 39.99,
                'description' => 'Fast boiling electric kettle with auto shut-off',
                'category' => 'Home & Kitchen',
                'stock' => 50,
                'image' => 'https://placehold.co/400'
            ],
            [
                'name' => 'Yoga Mat',
                'price' => 29.99,
                'description' => 'Non-slip yoga mat with extra cushioning',
                'category' => 'Sports & Outdoors',
                'stock' => 35,
                'image' => 'https://placehold.co/400'
            ],
            [
                'name' => '4K TV',
                'price' => 499.99,
                'description' => '55-inch 4K Ultra HD Smart TV with HDR',
                'category' => 'Electronics',
                'stock' => 12,
                'image' => 'https://placehold.co/400'
            ],
            [
                'name' => 'Running Shoes',
                'price' => 79.99,
                'description' => 'Lightweight running shoes with breathable material',
                'category' => 'Clothing & Shoes',
                'stock' => 60,
                'image' => 'https://placehold.co/400'
            ],
            [
                'name' => 'Keyboard',
                'price' => 49.99,
                'description' => 'Compact wireless keyboard with ergonomic design',
                'category' => 'Electronics',
                'stock' => 45,
                'image' => 'https://placehold.co/400'
            ],
            [
                'name' => 'Fitness Tracker',
                'price' => 99.99,
                'description' => 'Fitness tracker with heart rate monitor and GPS',
                'category' => 'Electronics',
                'stock' => 25,
                'image' => 'https://placehold.co/400'
            ],
            [
                'name' => 'Backpack',
                'price' => 39.99,
                'description' => 'Durable and water-resistant backpack for everyday use',
                'category' => 'Accessories',
                'stock' => 35,
                'image' => 'https://placehold.co/400'
            ],
            [
                'name' => 'Portable Charger',
                'price' => 29.99,
                'description' => 'High-capacity portable charger for smartphones and tablets',
                'category' => 'Electronics',
                'stock' => 50,
                'image' => 'https://placehold.co/400'
            ],
            [
                'name' => 'Desk Lamp',
                'price' => 19.99,
                'description' => 'Adjustable desk lamp with LED lighting',
                'category' => 'Home & Kitchen',
                'stock' => 40,
                'image' => 'https://placehold.co/400'
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
