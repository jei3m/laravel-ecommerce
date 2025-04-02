<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::role('customer')->get();
        $products = Product::all();

        foreach ($users as $user) {
            $numOrders = rand(1, 3);
            
            for ($i = 0; $i < $numOrders; $i++) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'total_amount' => 0,
                    'order_status' => ['pending', 'processing', 'completed'][rand(0, 2)],
                    'payment_status' => ['pending', 'paid'][rand(0, 1)],
                    'payment_method' => ['online', 'cod'][rand(0, 1)],
                    'shipping_address' => $user->street_address . ', ' . $user->barangay . ', ' . $user->city . ', ' . $user->province
                ]);

                $totalAmount = 0;
                $numItems = rand(1, 3);
                
                for ($j = 0; $j < $numItems; $j++) {
                    $product = $products->random();
                    $quantity = rand(1, 3);
                    $price = $product->price;
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price
                    ]);
                    
                    $totalAmount += ($price * $quantity);
                }
                
                $order->update(['total_amount' => $totalAmount]);
            }
        }
    }
}