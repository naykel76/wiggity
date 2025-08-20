<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Widget;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Widget::factory(1)->create(['start_date' => now()]);
        Widget::factory(1)->future()->create();
        Widget::factory(1)->past()->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
