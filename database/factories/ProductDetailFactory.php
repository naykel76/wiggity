<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDetail>
 */
class ProductDetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'description' => fake()->paragraphs(random_int(1, 5), true),
        ];
    }
}
