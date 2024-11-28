<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $user = auth()->user();
        
        // Validate user has address
        if (!$user->street_address) {
            return back()->with('error', 'Please add a shipping address before checkout.');
        }

        // Get cart items
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        // Calculate totals
        $subtotal = $cartItems->sum(function ($item) {
            return $item->quantity * $item->product->price;
        });
        
        $shipping = 100; // Fixed shipping rate
        $tax = $subtotal * 0.12; // 12% tax
        $total = $subtotal + $shipping + $tax;

        // Create shipping address string
        $shippingAddress = implode(', ', [
            $user->street_address,
            $user->barangay,
            $user->city,
            $user->province
        ]);

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'total_amount' => $total,
            'shipping_address' => $shippingAddress,
            'payment_method' => $request->payment_method,
            'payment_status' => 'completed',
            'order_status' => 'completed'
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            $order->items()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ]);

            // Update product sold count and stock
            $item->product->increment('sold', $item->quantity);
            $item->product->decrement('stock', $item->quantity);
        }

        // Clear cart
        CartItem::where('user_id', $user->id)->delete();

        if ($request->payment_method === 'cod') {
            return redirect()->route('orders.success', $order)
                ->with('success', 'Order completed successfully!');
        } else {
            // Here you would typically redirect to a payment gateway
            // For now, we'll just redirect to success
            return redirect()->route('orders.success', $order)
                ->with('success', 'Order completed successfully!');
        }
    }

    public function success(Order $order)
    {
        return view('orders.success', compact('order'));
    }
}
