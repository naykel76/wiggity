<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Widget;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Widget::create([
            'code' => 'widget-001',
            'name' => 'Sample Widget',
            'slug' => 'sample-widget',
            'headline' => 'This is the headline, you should keep it short and catchy.',
            'overview' => 'An overview of the sample widget.',
            'highlights' => '<ul><li>Highlight one</li><li>Highlight two</li><li>Highlight three</li></ul>',
            'content' => 'Detailed content about the sample widget.',
            'is_active' => true,
        ]);

        Widget::factory(3)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
