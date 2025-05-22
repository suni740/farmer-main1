<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index(Request $request)
    {
        $categoryId = $request->input('category');
        $categories = Category::all();

        // Fetch products, optionally filtered by category
        $products = Product::when($categoryId, function ($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        })->latest()->paginate(9);

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    // The following methods are placeholders for future use

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
