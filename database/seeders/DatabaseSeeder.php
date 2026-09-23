<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin User
        User::factory()->create([
            'name' => 'Akaego Admin',
            'email' => 'admin@akaegoluxury.com',
        ]);

        // 2. Define Luxury Categories
        $categories = [
            [
                'name' => 'Haute Apparel',
                'slug' => 'haute-apparel',
                'description' => 'Precision tailoring and handcrafted silks for evening statement looks.',
            ],
            [
                'name' => 'Bespoke Handbags',
                'slug' => 'bespoke-handbags',
                'description' => 'Italian calfskin leather goods engineered for functional luxury.',
            ],
            [
                'name' => 'Fine Jewellery',
                'slug' => 'fine-jewellery',
                'description' => 'Subtle gold accents and timeless pieces to elevate every ensemble.',
            ],
            [
                'name' => 'Timepieces',
                'slug' => 'timepieces',
                'description' => 'Swiss-engineered mechanical watches crafted with artisanal precision.',
            ],
        ];

        foreach ($categories as $catData) {
            $category = Category::create([
                'name' => $catData['name'],
                'slug' => $catData['slug'],
                'description' => $catData['description'],
                'is_active' => true,
            ]);

            // 3. Create Featured & Regular Luxury Products per Category
            for ($i = 1; $i <= 3; $i++) {
                $productName = $category->name . ' Item ' . $i;
                $product = Product::create([
                    'category_id' => $category->id,
                    'name' => $productName,
                    'slug' => Str::slug($productName) . '-' . Str::random(5),
                    'sku' => 'AKG-' . strtoupper(Str::random(6)),
                    'summary' => 'Exquisite artisan-crafted ' . strtolower($category->name) . ' piece.',
                    'description' => 'Handcrafted using premium materials. Designed with elegance and precision for the discerning individual.',
                    'price' => rand(250, 3500) + 0.99,
                    'compare_at_price' => rand(0, 1) ? rand(3600, 4500) : null,
                    'quantity' => rand(5, 25),
                    'is_active' => true,
                    'is_featured' => ($i === 1), // Make 1st item featured
                ]);

                // Primary Image
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'products/placeholder.jpg',
                    'sort_order' => 0,
                    'is_primary' => true,
                ]);

                // Secondary Image
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'products/placeholder-alt.jpg',
                    'sort_order' => 1,
                    'is_primary' => false,
                ]);
            }
        }
    }
}