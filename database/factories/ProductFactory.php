<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);

        return [
            'category_id' => Category::factory(),
            'name' => ucwords($name),
            'slug' => Str::slug($name),
            'sku' => 'AKG-' . strtoupper(Str::random(8)),
            'summary' => $this->faker->sentence(),
            'description' => $this->faker->paragraphs(3, true),
            'price' => $this->faker->randomFloat(2, 150, 2500),
            'compare_at_price' => null,
            'quantity' => $this->faker->numberBetween(5, 50),
            'is_active' => true,
            'is_featured' => $this->faker->boolean(30),
        ];
    }
}