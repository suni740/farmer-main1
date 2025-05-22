<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer|min:0',
            'image'       => 'nullable|url',
            'description' => 'nullable',
            'featured'    => 'nullable',
        ]);

        Product::create([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'price'       => $request->price,
            'quantity'    => $request->quantity,
            'image'       => $request->image,
            'description' => $request->description,
            'featured'    => $request->has('featured') ? 1 : 0,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product created!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric',
            'quantity'    => 'required|integer|min:0',
            'image'       => 'nullable|url',
            'description' => 'nullable',
            'featured'    => 'nullable',
        ]);

        $product->update([
            'name'        => $request->name,
            'category_id' => $request->category_id,
            'price'       => $request->price,
            'quantity'    => $request->quantity,
            'image'       => $request->image,
            'description' => $request->description,
            'featured'    => $request->has('featured') ? 1 : 0,
        ]);

        return redirect()->route('admin.products.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product deleted!');
    }
}
