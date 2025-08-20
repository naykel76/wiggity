<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Widget>
 */
class WidgetFactory extends Factory
{
    public function definition(): array
    {
        $startDate = $this->randomStartDate();

        return [
            'title' => fake()->sentence(random_int(3, 10)),
            'start_date' => $startDate,
            'end_date' => $startDate->copy()->addDays(random_int(1, 10)),
            // Randomly assigns a country from Widget::COUNTRIES or null (50% chance)
            'country' => fake()->boolean() ? fake()->randomElement(array_keys(\App\Models\Widget::COUNTRIES)) : '',
        ];
    }

    public function future($days = null): self
    {
        return $this->state(function (array $attributes) use ($days) {
            $startDate = Carbon::now()->addDays($days ?? rand(1, 365));

            return [
                'start_date' => $startDate,
            ];
        });
    }

    public function past($days = null): self
    {
        return $this->state(function (array $attributes) use ($days) {
            $startDate = Carbon::now()->subDays($days ?? rand(1, 365));

            return [
                'start_date' => $startDate,
            ];
        });
    }

    protected function randomStartDate(): Carbon
    {
        return Carbon::instance($this->faker->dateTimeBetween('+1 months', '+6 months'));
    }
}
