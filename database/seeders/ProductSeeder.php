<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $products = [
       [
                'name'      => 'Customizable Bouquet Candle',
                'price'     => 00.00,
                'old_price' => null,
                'description' => 'A soothing scent for relaxation.',
                'grams' => 'varies',
                'stock' => 50,
                'image'     => 'bouquetcandle.jpg',
                'category'  => 'Flower Candles', 
                'on_sale'   => true
                
            ],
            
            [
                'name'      => 'Strawberry Dessert Candle',
                'old_price' => 260.00,
                'price'     => 250.00,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '200g',
                'stock' => 50,
                'image'     => 'strawberryproduct.png', 
                'category'  => 'Dessert Candles', 
                'on_sale'   => true            
            ],
    
            [
                'name'      => 'PumpkinSpice Dessert Candle',
                'old_price' => 260.00,
                'price'     => 250.00,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '200g',
                'stock' => 50,
                'image'     => 'pumpkinproduct.png',
                'category'  => 'Dessert Candles', 
                'on_sale'   => true
            ],
            
            [
                'name'      => 'Orange Dessert Candle',
                'old_price' => 260.00,
                'price'     => 250.00,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '200g',
                'stock' => 50,
                'image'     => 'orangeproduct.png',
                'category'  => 'Dessert Candles', 
                'on_sale'   => true
            ],
    
            [
                'name'      => 'Peony Flower Candle',
                'old_price' => 55.00,
                'price'     => 60.00,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '60g',
                'stock' => 50,
                'image'     => 'rose candle.png',
                'category'  => 'Flower Candles', 
                'on_sale'   => true
            ],
              
            [
                'name'      => 'Choco Frappe Candle',
                'old_price' => 160.00,
                'price'     => 150.00,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '100g',
                'stock' => 50,
                'image'     => 'chocofrappe.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => true
            ],
    
            [
                'name'      => 'Coffee Candle',
                'old_price' => 160.00,
                'price'     => 150.00,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '100g',
                'stock' => 50,
                'image'     => 'coffee candle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => true
            ],
    
            [
                'name'      => 'Bear Candle',
                'old_price' => 55.00,
                'price'     => 45.00,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '55g',
                'stock' => 50,
                'image'     => 'bear candle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => true
            ],
    
            [
                'name'      => 'Tincan Candle',
                'old_price' => 165.00,
                'price'     => 155.00,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '100g',
                'stock' => 50,
                'image'     => 'tincan candle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => true
            ],
    
            [
                'name'      => 'Couple Candle',
                'price'     => 75.00,
                'old_price' => null,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '100g',
                'stock' => 50,
                'image'     => 'couplecandle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Baby Candle',
                'price'     => 45.00,
                'old_price' => null,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '40g',
                'stock' => 50,
                'image'     => 'baby candle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Heart Bubble',
                'price'     => 85.00,
                'old_price' => null,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '122g',
                'stock' => 50,
                'image'     => 'bubbleheart.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Bubble Candle',
                'price'     => 90.00,
                'old_price' => null,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '136g',
                'stock' => 50,
                'image'     => 'bubblecandle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Mama Mary Candle',
                'price'     => 45.00,
                'old_price' => null,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '33g',
                'stock' => 50,
                'image'     => 'mamamarycandle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Cylindrical Candle',
                'price'     => 150.00,
                'old_price' => null,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '200g',
                'stock' => 50,
                'image'     => 'cylindricalcandle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Angel Candle',
                'price'     => 80.00,
                'old_price' => null,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '100g',
                'stock' => 50,
                'image'     => 'angelcandle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Trio Candle',
                'price'     => 65.00,
                'old_price' => null,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '90g',
                'stock' => 50,
                'image'     => 'triocandle.png',
                'category'  => 'Unique Candles', 
                'on_sale'   => false
            ],
    
            [
                'name'      => 'Rose Candle',
                'price'     => 80.00,
                'old_price' => null,
                'description' => 'A soothing scent for relaxation.',
                'grams' => '100g',
                'stock' => 50,
                'image'     => 'peonyflower.jpg',
                'category'  => 'Flower Candles', 
                'on_sale'   => false
            ],

       ];

       foreach ($products as $product) {
        \App\Models\Product::create($product);
       }
    }
}
