<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Chairs',
                'slug' => 'chairs',
                'description' => 'Comfortable and stylish chairs for your home and office',
                'is_active' => true,
            ],
            [
                'name' => 'Tables',
                'slug' => 'tables',
                'description' => 'Modern and functional tables for every room',
                'is_active' => true,
            ],
            [
                'name' => 'Sofas',
                'slug' => 'sofas',
                'description' => 'Luxurious sofas for your living room',
                'is_active' => true,
            ],
            [
                'name' => 'Storage',
                'slug' => 'storage',
                'description' => 'Smart storage solutions for organized spaces',
                'is_active' => true,
            ],
            [
                'name' => 'Lighting',
                'slug' => 'lighting',
                'description' => 'Elegant lighting fixtures to brighten your space',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
