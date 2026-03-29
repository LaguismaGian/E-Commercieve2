<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class PageController extends Controller
{
    public function home()
    {
        
        $featuredIds = [1, 2, 3, 4]; 
        $newDesignIds = [5, 6, 7, 8, 9];

        $featured = Product::whereIn('id', $featuredIds)->get();
        $newDesigns = Product::whereIn('id', $newDesignIds)->get();

        return view('home', compact('featured', 'newDesigns'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}