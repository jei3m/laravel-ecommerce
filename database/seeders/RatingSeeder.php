<?php

namespace Database\Seeders;

use App\Models\Rating;
use App\Models\Order;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::where('order_status', 'completed')->get();
        
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                if (rand(0, 1)) { // 50% chance of rating
                    Rating::create([
                        'user_id' => $order->user_id,
                        'product_id' => $item->product_id,
                        'order_id' => $order->id,
                        'rating' => rand(3, 5),
                        'review' => ['Great product!', 'Very satisfied', 'Would buy again'][rand(0, 2)]
                    ]);
                }
            }
        }
    }
}