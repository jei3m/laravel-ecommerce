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
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:orders,id',
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $validated['user_id'] = auth()->id();

        Rating::create($validated);

        return back()->with('success', 'Thank you for your rating!');
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
