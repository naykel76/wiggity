<?php

use App\Livewire\ProductIndex;
use App\Models\Product;
use Illuminate\Support\Str;
use Livewire\Livewire;

/**
 * Test what users see and interact with such as buttons, forms, and lists.
 * Focus on the visual output and UI state, not the underlying implementation.
 */
describe('rendering', function () {
    it('renders successfully', function () {
        Livewire::test(ProductIndex::class)->assertOk();
    });

    it('displays products in a paginated table', function () {
        $products = Product::factory()->count(10)->create();

        Livewire::test(ProductIndex::class)
            ->set('perPage', 5)
            ->assertSee($products->first()->title)        // First item should be visible
            ->assertDontSee($products->last()->title)     // Last item should NOT be visible (on page 2)
            ->assertSee('Results:');
    });

    it('shows empty state message when no products exist', function () {
        Livewire::test(ProductIndex::class)
            ->assertSee('No products found...');
    });

    it('displays product data correctly in table rows', function () {
        $product = createProduct();

        Livewire::test(ProductIndex::class)
            ->assertSee([
                $product->id,
                Str::limit($product->name, 60), // Test the truncated version
                $product->code,
                $product->price,
                $product->active,
                $product->created_at,
            ]);
    });
});
