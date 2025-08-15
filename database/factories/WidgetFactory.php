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
        ];
    }

    protected function randomStartDate(): Carbon
    {
        return Carbon::instance($this->faker->dateTimeBetween('+1 months', '+6 months'));
    }
}
