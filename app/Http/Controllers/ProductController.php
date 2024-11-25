<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $products = [
        1 => [
            'id' => 1,
            'name' => 'Gaming Laptop',
            'price' => 1299.99,
            'description' => 'High-performance gaming laptop with RTX 3080',
            'image' => '/images/placeholder.png',
            'category' => 'Electronics',
            'rating' => 4.7,
            'sold' => 245,
            'stock' => 15
        ],
        2 => [
            'id' => 2,
            'name' => 'Smartphone',
            'price' => 799.99,
            'description' => 'Latest smartphone with 5G capability',
            'image' => '/images/placeholder.png',
            'category' => 'Mobile',
            'rating' => 4.5,
            'sold' => 189,
            'stock' => 42
        ],
        3 => [
            'id' => 3,
            'name' => 'Wireless Headphones',
            'price' => 199.99,
            'description' => 'Noise-cancelling wireless headphones',
            'image' => '/images/placeholder.png',
            'category' => 'Audio',
            'rating' => 4.8,
            'sold' => 432,
            'stock' => 78
        ],
        4 => [
            'id' => 4,
            'name' => 'Wireless Headphones',
            'price' => 199.99,
            'description' => 'Noise-cancelling wireless headphones',
            'image' => '/images/placeholder.png',
            'category' => 'Audio',
            'rating' => 4.8,
            'sold' => 167,
            'stock' => 25
        ]
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get most popular products by sales
        $products = collect($this->products)
            ->sortByDesc('sold')
            ->take(8)
            ->values();

        return view('products.index', ['products' => $products]);
    }

    /**
     * Display a listing of the resource.
     */
    public function browse(Request $request)
    {
        $category = $request->query('category');
        $sort = $request->query('sort', 'newest');

        $products = collect($this->products);

        // Filter by category if specified
        if ($category) {
            $products = $products->filter(function ($product) use ($category) {
                return $product['category'] === $category;
            });
        }

        // Apply sorting
        switch ($sort) {
            case 'price_low':
                $products = $products->sortBy('price');
                break;
            case 'price_high':
                $products = $products->sortByDesc('price');
                break;
            case 'popular':
                $products = $products->sortByDesc('sold');
                break;
            default: // newest
                $products = $products->sortByDesc('id');
                break;
        }

        // Get unique categories for the filter dropdown
        $categories = collect($this->products)->pluck('category')->unique()->values();

        // Paginate the results
        $perPage = 12;
        $page = $request->query('page', 1);
        $items = $products->forPage($page, $perPage);
        
        $paginator = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $products->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('products.browse', [
            'products' => $paginator,
            'categories' => $categories
        ]);
    }

    public function browseSimple()
    {
        return view('products.browse', ['products' => $this->products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = collect($this->products)->firstWhere('id', (int) $id);
        
        if (!$product) {
            abort(404);
        }

        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = collect($this->products)->get($id);
        if (!$product) {
            abort(404);
        }
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
