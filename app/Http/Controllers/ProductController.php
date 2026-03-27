<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Added

class ProductController extends Controller
{
    private function getProducts()
    {
        return [
            
            [
                'name'      => 'Customizable Bouquet Candle',
                'price'     => '₱Varies from design',
                'old_price' => null,
                'image'     => 'images/bouquetcandle.jpg',
                'category'  => 'Flower Candles', 
                'on_sale'   => true
            ],
            
            [
                'name'      => 'Strawberry Dessert Candle',
                'old_price' => '₱260.00',
                'price'     => '₱250.00',
                'image'     => 'images/strawberryproduct.png', 
                'category'  => 'Dessert Candles', 
                'on_sale'   => true            
            ],
    
            [
                'name'      => 'PumpkinSpice Dessert Candle',
                'old_price' => '₱260.00',
                'price'     => '₱250.00',
                'image'     => 'images/pumpkinproduct.png',
                'category'  => 'Dessert Candles', 
                'on_sale'   => true
            ],
            
            [
                'name'      => 'Orange Dessert Candle',
                'old_price' => '₱260.00',
                'price'     => '₱250.00',
                'image'     => 'images/orangeproduct.png',
                'category'  => 'Dessert Candles', 
                'on_sale'   => true
            ],
    
            [
                'name'      => 'Peony Flower Candle',
                'old_price' => '₱55.00',
                'price'     => '₱60.00',
                'image'     => 'images/rose candle.png',
                'category'  => 'Flower Candles', 
                'on_sale'   => true
            ],
              
            [
                'name'      => 'Choco Frappe Candle',
                'old_price' => '₱160.00',
                'price'     => '₱150.00',
                'image'     => 'images/chocofrappe.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => true
            ],
    
            [
                'name'      => 'Coffee Candle',
                'old_price' => '₱160.00',
                'price'     => '₱150.00',
                'image'     => 'images/coffee candle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => true
            ],
    
            [
                'name'      => 'Bear Candle',
                'old_price' => '₱55.00',
                'price'     => '₱45.00',
                'image'     => 'images/bear candle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => true
            ],
    
            [
                'name'      => 'Tincan Candle',
                'old_price' => '₱165.00',
                'price'     => '₱155.00',
                'image'     => 'images/tincan candle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => true
            ],
    
            [
                'name'      => 'Couple Candle',
                'price'     => '₱75.00',
                'old_price' => null,
                'image'     => 'images/couplecandle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Baby Candle',
                'price'     => '₱45.00',
                'old_price' => null,
                'image'     => 'images/baby candle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Heart Bubble',
                'price'     => '₱85.00',
                'old_price' => null,
                'image'     => 'images/bubbleheart.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Bubble Candle',
                'price'     => '₱90.00',
                'old_price' => null,
                'image'     => 'images/bubblecandle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Mama Mary Candle',
                'price'     => '₱45.00',
                'old_price' => null,
                'image'     => 'images/mamamarycandle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Cylindrical Candle',
                'price'     => '₱150.00',
                'old_price' => null,
                'image'     => 'images/cylindricalcandle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Angel Candle',
                'price'     => '₱80.00',
                'old_price' => null,
                'image'     => 'images/angelcandle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Trio Candle',
                'price'     => '₱65.00',
                'old_price' => null,
                'image'     => 'images/triocandle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Rose Candle',
                'price'     => '₱80.00',
                'old_price' => null,
                'image'     => 'images/peonyflower.jpg',
                'category'  => 'Flower Candles', 
                'on_sale'   => false
            ],
            
        ];
    }

    public function index()
    {
        $products = $this->getProducts();
        return view('shop', compact('products'));
    }

    public function show($slug)
    {
        $products = $this->getProducts();
        
        $product = collect($products)->first(function($item) use ($slug) {
            return Str::slug($item['name']) === $slug;
        });

        if (!$product) {
            abort(404);
        }

        return view('product-detail', compact('product'));
    }
}
