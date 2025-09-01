<?php

namespace Database\Factories;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    public function definition(): array
    {
        $startDate = $this->randomStartDate();
        $price = fake()->numberBetween(500, 100000);
        $department = fake()->randomElement(array_keys(Product::DEPARTMENTS));

        return [
            'name' => fake()->realText(random_int(40, 100)),
            'headline' => fake()->paragraphs(1, true),
            'description' => fake()->paragraphs(random_int(1, 5), true),
            'main_image' => '',
            'code' => fake()->unique()->bothify($department . '-####'),
            'department' => $department,
            'price' => $price,
            'stock' => fake()->numberBetween(0, 15),
            // NK::TD Create a state for special pricing
            'special_start_date' => $startDate,
            'special_end_date' => $startDate->copy()->addDays(random_int(1, 10)),
            'special_price' => round($price * 0.8, 2), // 20% off
            'active' => fake()->boolean(),
            'extra_data' => null,
            'created_at' => Carbon::instance($this->faker->dateTimeBetween('-18 months', '-1 months')),
        ];
    }

    public function future($days = null): self
    {
        return $this->state(function (array $attributes) use ($days) {
            $startDate = Carbon::now()->addDays($days ?? rand(1, 365));

            return [
                'special_start_date' => $startDate,
            ];
        });
    }

    public function past($days = null): self
    {
        return $this->state(function (array $attributes) use ($days) {
            $startDate = Carbon::now()->subDays($days ?? rand(1, 365));

            return [
                'special_start_date' => $startDate,
            ];
        });
    }

    protected function randomStartDate(): Carbon
    {
        return Carbon::instance($this->faker->dateTimeBetween('+1 months', '+6 months'));
    }
}
