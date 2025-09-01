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

// the filter has been applied to the prepareData method

// describe('initialisation', function () {
//     // Test component setup and initial state such as default values and data loading.
// });

// describe('user interactions', function () {
//     // Test form submissions, clicks, and UI responses to user actions.
// });

/**
 * Test silent event dispatching and responses to external events.
 * Use this section when events happen without direct user interaction.
 */
describe('reactivity & events', function () {

    it('refreshes to show new product after model-saved event', function () {
        $productOne = createProduct();
        $component = Livewire::test(ProductIndex::class);
        $productTwo = createProduct();

        // Only the first product should be visible initially
        $component->assertSee(Str::limit($productOne->name, 60))
            ->assertDontSee(Str::limit($productTwo->name, 60));

        // After refreshComponent, both products should be visible
        $component->dispatch('model-saved')
            ->assertSee([
                Str::limit($productTwo->name, 60),
                Str::limit($productOne->name, 60),
            ]);
    });

    it('refreshes to show updated product after model-saved event', function () {
        $product = createProduct(['code' => 'OriginalCode']);
        $originalCode = $product->code;

        $component = Livewire::test(ProductIndex::class);
        $component->assertSee($originalCode);

        $product->update(['code' => 'UpdatedCode']);
        $updatedCode = $product->code;

        // After model-saved event, should see new code
        $component->dispatch('model-saved')
            ->assertSee($updatedCode)
            ->assertDontSee($originalCode);
    });
});

// describe('validation', function () {
//     // Test that invalid data is properly rejected with appropriate error messages.
// });

// describe('data persistence', function () {
//     // Test successful save/update/delete operations and their side effects.
// });
