<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product; 

class ProductController extends Controller
{
    // Dsiplay shop page with all products
    public function index()
    {
        // Fetches all candles from the DB using Eloquent
        $products = Product::all(); 
        return view('shop', compact('products'));
    }

    // Display specific product page
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product-detail', compact('product'));
    }
}