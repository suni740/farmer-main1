<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
       
        $leafy = Category::firstOrCreate(['name' => 'Leafy Greens']);
        $root = Category::firstOrCreate(['name' => 'Root Vegetables']);

      
        Product::create([
            'name' => 'Spinach',
            'description' => 'Fresh organic spinach.',
            'price' => 2.50,
            'category_id' => $leafy->id,
        ]);

        Product::create([
            'name' => 'Featured Spinach',
            'description' => 'Fresh and healthy spinach.',
            'price' => 5.99,
            'image' => 'spinach.jpg',
            'category_id' => $leafy->id,
            'featured' => true,
        ]);
        
        Product::create([
            'name' => 'Featured Carrot',
            'description' => 'Fresh, crisp carrots.',
            'price' => 4.99,
            'image' => 'carrot.jpg',
            'category_id' => $root->id,
            'featured' => true,
        ]);
    }
}
