<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500'
        ]);

        // Check if user has already rated this product for this order
        $existingRating = Rating::where([
            'user_id' => auth()->id(),
            'product_id' => $data['product_id'],
            'order_id' => $data['order_id']
        ])->first();

        if ($existingRating) {
            return response()->json([
                'success' => false,
                'message' => 'You have already rated this product for this order'
            ]);
        }

        // Create new rating
        $rating = Rating::create([
            'user_id' => auth()->id(),
            'product_id' => $data['product_id'],
            'order_id' => $data['order_id'],
            'rating' => $data['rating'],
            'review' => $data['review'] ?? null
        ]);

        // Update product average rating
        $product = Product::find($data['product_id']);
        $avgRating = $product->ratings()->avg('rating');
        $product->update(['rating' => $avgRating]);

        return response()->json([
            'success' => true,
            'message' => 'Rating submitted successfully',
            'rating' => $rating
        ]);
    }

    public function update(Request $request, Rating $rating)
    {
        if ($rating->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }

        $data = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:500'
        ]);

        $rating->update([
            'rating' => $data['rating'],
            'review' => $data['review'] ?? null
        ]);

        // Update product average rating
        $product = Product::find($rating->product_id);
        $avgRating = $product->ratings()->avg('rating');
        $product->update(['rating' => $avgRating]);

        return response()->json([
            'success' => true,
            'message' => 'Rating updated successfully',
            'rating' => $rating
        ]);
    }
}
