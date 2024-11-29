<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Display cart contents and calculate totals
    public function index()
    {
        $cartItems = CartItem::where('user_id', auth()->id())
            ->with('product')
            ->get();

        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $shipping = $cartItems->count() > 0 ? 10 : 0;
        $tax = $subtotal * 0.1; // 10% tax
        $total = $subtotal + $shipping + $tax;

        return view('cart.index', compact('cartItems', 'subtotal', 'shipping', 'tax', 'total'));
    }

    // Add a product to the cart or increment its quantity if already exists
    public function addToCart(Request $request, Product $product)
    {
        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!'
        ]);
    }

    // Update the quantity of a cart item (increase/decrease)
    public function updateQuantity(Request $request)
    {
        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('id', $request->input('id'))
            ->first();

        if ($cartItem) {
            if ($request->input('action') === 'increase') {
                $cartItem->increment('quantity');
            } elseif ($request->input('action') === 'decrease' && $cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            }
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }

    // Remove a specific item from the cart
    public function destroy($id)
    {
        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();
        
        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
