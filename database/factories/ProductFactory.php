<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $department = fake()->randomElement(array_keys(Product::DEPARTMENTS));

        return [
            'name' => fake()->sentence(random_int(3, 10)),
            'code' => fake()->unique()->bothify($department . '-####'),
        ];
    }
}
