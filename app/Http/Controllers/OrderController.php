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
        
        $shipping = 10; // Fixed shipping rate
        $tax = $subtotal * 0.1; // 10% tax
        $total = $subtotal + $tax + $shipping;

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
            'payment_status' => 'pending',
            'order_status' => 'pending'
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

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'order_id' => $order->id,
                'redirect_url' => route('orders.success', $order)
            ]);
        }

        if ($request->payment_method === 'cod') {
            return redirect()->route('orders.success', $order)
                ->with('success', 'Order completed successfully!');
        }

        return redirect()->route('payment.process', $order);
    }

    public function success(Order $order)
    {
        return view('orders.success', compact('order'));
    }

    /**
     * Update the order status.
     */
    public function updateStatus(Request $request, Order $order)
    {
        try {
            $validated = $request->validate([
                'order_status' => 'required|string|in:pending,processing,completed,cancelled'
            ]);

            $oldStatus = $order->order_status;
            $order->update($validated);

            if ($validated['order_status'] === 'completed' && $oldStatus !== 'completed') {
                foreach ($order->items as $item) {
                    $item->product->increment('sold', $item->quantity);
                }
            }

            $statusMap = [
                'cod' => [
                    'completed' => 'completed',
                    'cancelled' => 'cancelled',
                    'pending' => 'pending'
                ],
                'online' => [
                    'completed' => 'completed',
                    'cancelled' => 'cancelled',
                    'pending' => 'pending'
                ],
                'paypal' => [
                    'completed' => 'completed',
                    'cancelled' => 'cancelled',
                    'pending' => 'pending'
                ]
            ];

            $paymentMethod = $order->payment_method;
            $orderStatus = $validated['order_status'];

            if (isset($statusMap[$paymentMethod][$orderStatus])) {
                $order->update(['payment_status' => $statusMap[$paymentMethod][$orderStatus]]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update order status',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cancel an order.
     */
    public function cancelOrder(Order $order)
    {
        try {
            if ($order->order_status !== 'completed') {
                $order->update([
                    'order_status' => 'cancelled',
                    'payment_status' => 'cancelled'
                ]);

                return redirect()->back()->with('success', 'Order cancelled successfully');
            }

            return redirect()->back()->with('error', 'Cannot cancel a completed order');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to cancel order');
        }
    }

    /**
     * Display the orders dashboard.
     */
    public function dashboard()
    {
        $orders = Order::with(['user','items.product'])
            ->latest()
            ->paginate(10);

        return view('orders.dashboard', compact('orders'));
    }
    
}
