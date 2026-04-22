<?php

namespace Database\Factories;

use App\Models\Widget;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Widget>
 */
class WidgetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(2, true);

        return [
            'code' => fake()->unique()->lexify('widget-????'),
            'name' => $name,
            'slug' => Str::slug($name) . '-' . fake()->unique()->randomNumber(4),
            'headline' => fake()->sentence(),
            'overview' => fake()->paragraph(),
            'highlights' => '<ul><li>Item one</li><li>Item two</li><li>Item three</li></ul>',
            'content' => fake()->paragraphs(3, true),
            'image_name' => null,
            'file_name' => null,
            'is_active' => true,
            'status' => null,
            'position' => fake()->numberBetween(0, 100),
            'price' => null,
            'extra_data' => null,
            'started_at' => null,
            'ended_at' => null,
            'expired_at' => null,
            'published_at' => null,
            'released_at' => null,
        ];
    }

    public function published(): static
    {
        return $this->state(fn(array $attributes) => [
            'published_at' => now(),
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn(array $attributes) => [
            'is_active' => false,
        ]);
    }
}
