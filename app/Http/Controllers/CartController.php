<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = collect();
        $subtotal = 0;

        foreach ($cart as $id => $details) {
            $product = Product::find($id);
            if ($product) {
                $cartItems->push((object)[
                    'id' => $id,
                    'product' => $product,
                    'quantity' => $details['quantity']
                ]);
                $subtotal += $product->price * $details['quantity'];
            }
        }

        $shipping = $cartItems->count() > 0 ? 10 : 0;
        $tax = $subtotal * 0.1; // 10% tax
        $total = $subtotal + $shipping + $tax;

        return view('cart.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'quantity' => 1
            ];
        }
        
        session()->put('cart', $cart);
        
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!'
        ]);
    }

    public function updateQuantity(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('id');
        $action = $request->input('action');

        if (isset($cart[$id])) {
            if ($action === 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($action === 'decrease' && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            }
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    public function destroy($id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
