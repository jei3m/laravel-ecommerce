<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::withAvg('ratings', 'rating')
            ->orderByDesc('ratings_avg_rating')
            ->take(4)
            ->get();

        return view('products.index', compact('products'));
    }

    public function browse(Request $request)
    {
        $query = Product::query();

        // Category filtering
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Sorting
        $sort = $request->get('sort', 'price_low'); // Default to 'price_low'
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('price', 'asc'); // Default to 'price_low'
                break;
        }

        // Get products with pagination
        $products = $query->paginate(12)->withQueryString();
        
        // Get unique categories for the filter dropdown
        $categories = Product::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->sort()
            ->values();
        
        return view('products.browse', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $request->category,
            'selectedSort' => $sort
        ]);
    }

    public function search(Request $request)
    {
        $searchQuery = $request->get('query');
        $query = Product::query();
        
        // Apply search filter
        if ($searchQuery) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $searchQuery . '%')
                    ->orWhere('category', 'like', '%' . $searchQuery . '%');
            });
        }

        // Category filtering
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Sorting
        $sort = $request->get('sort', 'price_low'); // Default to 'price_low'
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('price', 'asc'); // Default to 'price_low'
                break;
        }

        // Get products with pagination
        $products = $query->paginate(12)->withQueryString();
        
        // Get unique categories for the filter dropdown
        $categories = Product::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->pluck('category')
            ->sort()
            ->values();

        return view('products.browse', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $request->category,
            'selectedSort' => $sort,
            'searchQuery' => $searchQuery
        ]);
    }

    public function dashboard()
    {
        $products = Product::latest()
            ->paginate(10);
        
        return view('products.dashboard', compact('products'));
    }

    // Seperate search function only for product dashboard
    public function dashboardSearch(Request $request)
    {
        $query = $request->input('query');
        
        $products = Product::query()
            ->when($query, function ($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('category', 'LIKE', "%{$query}%")
                  ->orWhere('price', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('stock', 'LIKE', "%{$query}%");
            })
            ->latest()
            ->paginate(10);

        return view('products.dashboard', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'category' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image'
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        } else {
            $validated['image'] = 'products/placeholder.png';
        }

        $validated['user_id'] = auth()->id();
        $validated['rating'] = 0;
        $validated['sold'] = 0;
        
        $product = Product::create($validated);

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // To edit products
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'category' => 'required|string|max:50',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && $product->image !== 'products/placeholder.png') {
                Storage::disk('public')->delete($product->image);
            }
            
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        $product->update($validated);

        return redirect()
            ->route('products.show', $product)
            ->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function destroy(Product $product)
    {
        if ($product->image && $product->image !== 'products/placeholder.png') {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('products.dashboard')
            ->with('success', 'Product deleted successfully!');
    }
}
