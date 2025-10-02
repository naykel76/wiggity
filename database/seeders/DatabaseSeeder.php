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
        // Product::factory()->create([
        //     'name' => 'Product One',
        //     'code' => 'PRO001',
        //     'price' => 49.90,
        //     'special_price' => 20,
        // ]);

        // Product::factory()->create([
        //     'name' => 'Product Two',
        //     'code' => 'PRO002',
        //     'price' => null,
        //     'special_price' => 800,
        // ]);

        Product::factory(5)
            ->has(ProductDetail::factory())
            ->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
