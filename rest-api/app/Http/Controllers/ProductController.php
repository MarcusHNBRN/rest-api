<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
        ]);

        $product = Product::create($validatedData);
        return response()->json($product, 201);
    }

    public function show(Product $product)
    {
        return response()->json($product);
    }

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'description' => 'string',
            'price' => 'numeric|min:0',
            'category' => 'string|max:255',
        ]);

        $product->update($validatedData);
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }

    public function byCategory($category)
    {
        $products = Product::category($category)->get();
        return response()->json($products);
    }
}
