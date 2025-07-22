<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {

        $smartphones = Category::where('slug', 'smartphones')->first();
        $laptops = Category::where('slug', 'ordinateurs-portables')->first();
        $accessories = Category::where('slug', 'accessoires')->first();

        $products = [
            [
                'name' => 'iPhone 15 Pro',
                'slug' => 'iphone-15-pro', 
                'description' => 'Le dernier iPhone avec puce A17 Pro et caméra titanium',
                'price' => 1199.99,
                'stock_quantity' => 25,
                'category_id' => $smartphones->id
            ],
            [
                'name' => 'MacBook Air M3',
                'slug' => 'macbook-air-m3',
                'description' => 'Ordinateur portable ultra-fin avec puce M3 et écran Retina',
                'price' => 1499.00,
                'stock_quantity' => 15,
                'category_id' => $laptops->id
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'slug' => 'samsung-galaxy-s24',
                'description' => 'Smartphone Android avec IA intégrée et appareil photo 200MP',
                'price' => 899.99,
                'stock_quantity' => 30,
                'category_id' => $smartphones->id
            ],
            [
                'name' => 'AirPods Pro 2',
                'slug' => 'airpods-pro-2',
                'description' => 'Écouteurs sans fil avec réduction de bruit active',
                'price' => 279.00,
                'stock_quantity' => 50,
                'category_id' => $accessories->id
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}