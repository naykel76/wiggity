<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::factory()->create([
            'name' => 'Product One',
            'code' => 'PRO001',
            'price' => 149.99,
            'special_price' => 149.99,
        ]);

        //  88000.0,
        //   187.5,
        Product::factory()->create([
            'name' => 'Product Two',
            'code' => 'PRO002',
            'price' => 887.50,
        ]);

        // Product::factory(100)->create();
        // Product::factory(100)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
