<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0', 
            'grams' => 'nullable|integer|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string',
            'on_sale' => 'boolean', 
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // 1. Define the $file variable FIRST!
            $file = $request->file('image');
        
            // 2. Make the unique name
            $filename = time() . '_' . $file->getClientOriginalName();
        
            // 3. Move it directly to your public path
            $file->move(public_path('images/products'), $filename);
        
            // 4. Save only the filename to your database array
            $data['image'] = $filename;
        }

        Product::create($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'grams' => 'nullable|string|max:50',
            'stock' => 'required|integer|min:0',
            'category' => 'nullable|string',
            'on_sale' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            
            if ($product->image) {
                
                // In here, I store the Images in the Storage-images that's why its images not products
                Storage::disk('public')->delete('images/' . $product->image);
            }
            
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = basename($path);
        }

        $product->update($data);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete('images/' . $product->image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
}