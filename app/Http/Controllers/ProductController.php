<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEditProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('productDetail')->latest()->get();

        return view('products.index', [
            'pageTitle' => 'Products',
            'products' => $products,
        ]);
    }

    public function create()
    {
        return view('products.create', [
            'pageTitle' => 'Create Product',
        ]);
    }

    public function store(CreateEditProductRequest $request)
    {
        $validatedData = $request->validated();

        // Create the product
        $product = Product::create($validatedData);

        // Only create ProductDetail if data is provided
        if ($request->filled('description')) {
            $product->productDetail()->create([
                'description' => $request->description,
            ]);
        }

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $product->load('productDetail');

        return view('products.show', [
            'pageTitle' => 'Product Details',
            'product' => $product,
        ]);
    }

    public function edit(Product $product)
    {
        $product->load('productDetail');

        return view('products.edit', [
            'pageTitle' => 'Edit Product',
            'product' => $product,
        ]);
    }

    public function update(CreateEditProductRequest $request, Product $product)
    {
        $validatedData = $request->validated();

        // Update the product itself
        $product->update($validatedData);

        // This will need to be adjusted if more fields are added
        if ($request->filled('description')) {
            $product->productDetail()->updateOrCreate(
                ['product_id' => $product->id],
                ['description' => $request->description]
            );
        } else {
            $product->productDetail()->delete();
        }

        return redirect()->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
