<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaymentController extends Controller
{
    // Initialize PayPal payment process and create payment order
    public function processPayPal(Order $order)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        // Format the amount properly for PayPal
        $amount = number_format((float)$order->total_amount, 2, '.', '');

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payment.success', $order->id),
                "cancel_url" => route('payment.cancel', $order->id),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount
                    ],
                    "description" => "Order #" . $order->id,
                ]
            ]
        ]);

        if (isset($response['links'][1]['href'])) {
            $paypalUrl = $response['links'][1]['href'];
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'paypal_link' => $paypalUrl
                ]);
            }
            
            return redirect($paypalUrl);
        }

        if (request()->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to connect to PayPal'
            ]);
        }

        return redirect()->back()->with('error', 'Something went wrong with PayPal');
    }

    // Redirect user to PayPal payment page using stored payment link
    public function redirectToPayPal(Order $order)
    {
        $paypalLink = session('paypal_link');
        
        if (!$paypalLink) {
            return redirect()->route('cart.index')->with('error', 'PayPal session expired. Please try again.');
        }

        // Clear the session
        session()->forget('paypal_link');
        
        return redirect()->away($paypalLink);
    }

    // Handle successful PayPal payment and update order status
    public function success(Request $request, Order $order)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        
        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $order->update([
                'payment_status' => 'completed',
                'order_status' => 'completed'
            ]);

            // Increment sold count for each product
            foreach ($order->items as $item) {
                $item->product->increment('sold', $item->quantity);
            }

            return redirect()->route('orders.success', $order)
                ->with('success', 'Payment completed successfully!');
        }

        return redirect()->route('cart.index')
            ->with('error', 'Something went wrong with PayPal payment');
    }

    // Handle cancelled PayPal payment and update order status
    public function cancel(Order $order)
    {
        foreach ($order->items as $item) {
            $item->product->increment('stock', $item->quantity);
        }
        
        $order->update([
            'payment_status' => 'cancelled',
            'order_status' => 'cancelled'
        ]);

        return redirect()->route('cart.index')
            ->with('error', 'PayPal payment cancelled');
    }

    // Add payment status check endpoint
    public function checkStatus(Request $request)
    {
        $orderId = session('pending_payment_order_id');
        
        if (!$orderId) {
            return response()->json([
                'status' => 'pending'
            ]);
        }
        
        $order = Order::find($orderId);
        
        if (!$order) {
            return response()->json([
                'status' => 'pending'
            ]);
        }
        
        if ($order->payment_status === 'completed') {
            // Clear the session
            session()->forget('pending_payment_order_id');
            
            return response()->json([
                'status' => 'completed',
                'redirect_url' => route('orders.success', $order->id)
            ]);
        }
        
        if ($order->payment_status === 'cancelled') {
            // Clear the session
            session()->forget('pending_payment_order_id');
            
            return response()->json([
                'status' => 'cancelled'
            ]);
        }
        
        return response()->json([
            'status' => 'pending'
        ]);
    }
}
