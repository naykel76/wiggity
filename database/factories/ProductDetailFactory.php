<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductDetail>
 */
class ProductDetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'headline' => fake()->paragraphs(1, true),
            'description' => fake()->paragraphs(random_int(1, 5), true),
            'main_image' => '',
        ];
    }
}


