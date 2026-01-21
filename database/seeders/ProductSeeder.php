<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chairsCategory = Category::where('slug', 'chairs')->first();
        
        $products = [
            [
                'name' => 'Nordic Chair',
                'slug' => 'nordic-chair',
                'description' => 'A beautiful Scandinavian-inspired chair with clean lines and comfortable seating.',
                'image' => 'product-1.png',
                'price' => 50.00,
                'compare_price' => 75.00,
                'stock' => 15,
                'is_active' => true,
                'is_featured' => true,
                'category_id' => $chairsCategory->id,
            ],
            [
                'name' => 'Kruzo Aero Chair',
                'slug' => 'kruzo-aero-chair',
                'description' => 'Modern ergonomic chair with advanced lumbar support and adjustable height.',
                'image' => 'product-2.png',
                'price' => 78.00,
                'compare_price' => 120.00,
                'stock' => 8,
                'is_active' => true,
                'is_featured' => true,
                'category_id' => $chairsCategory->id,
            ],
            [
                'name' => 'Ergonomic Chair',
                'slug' => 'ergonomic-chair',
                'description' => 'Professional office chair designed for maximum comfort during long work sessions.',
                'image' => 'product-3.png',
                'price' => 43.00,
                'compare_price' => 65.00,
                'stock' => 20,
                'is_active' => true,
                'is_featured' => false,
                'category_id' => $chairsCategory->id,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
