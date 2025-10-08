<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory(150)->has(ProductDetail::factory())->create();

        Product::factory()->create([
            'name' => 'Product One',
            'code' => 'PRO001',
            'price' => 49.90,
            // 'special_price' => 20,
            'created_at' => now(),
        ]);

        Product::factory()->create([
            'name' => 'Product Two',
            'code' => 'PRO002',
            'price' => null,
            // 'special_price' => 800,
            'created_at' => now(),
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
