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
        $products = Product::factory(10)->create();

        Livewire::test(ProductIndex::class)
            ->set('perPage', 5)
            ->assertSee($products->first()->code)        // First item should be visible
            ->assertDontSee($products->last()->code)     // Last item should NOT be visible on page 1
            ->call('gotoPage', 2)
            ->assertDontSee($products->first()->code)    // First item should NOT be visible on page 2
            ->assertSee($products->last()->code);        // Last item should now be visible on page 2
    });

    it('always displays the results count message', function () {
        Product::factory(1)->create();
        Livewire::test(ProductIndex::class)
            ->assertSee('results');
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
                Str::limit($product->name, 40), // Test the truncated version
                $product->code,
                $product->price,
                $product->active,
                $product->createdAtDate(),
            ]);
    });
});

/**
 * Test silent event dispatching and responses to external events.
 * Use this section when events happen without direct user interaction.
 */
describe('reactivity & events', function () {
    it('shows new product after receiving model-saved event', function () {
        $productOne = createProduct();
        $component = Livewire::test(ProductIndex::class);
        $productTwo = createProduct();

        // Should only see productOne initially
        $component->assertSee(Str::limit($productOne->name, 40))
            ->assertDontSee(Str::limit($productTwo->name, 40));

        // After event, should see both products
        $component->dispatch('model-saved')
            ->assertSee([
                Str::limit($productTwo->name, 40),
                Str::limit($productOne->name, 40),
            ]);
    });

    it('shows updated product after receiving model-saved event', function () {
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

// THESE ARE VARIATIONS OF THE SAME TEST FOR DEMONSTRATION PURPOSES

//
// Test date formatting and updates
//

// it('shows updated event after receiving model-saved event', function () {
//     $event = ScheduledEvent::factory()->future()->create();
//     $originalStartDate = $event->startDate();

//     $component = Livewire::test(ScheduledEventIndex::class);
//     $component->assertSee($originalStartDate);

//     $event->update(['start_date' => now()->addDays(10)]);
//     $updatedStartDate = $event->startDate();

//     $component->dispatch('model-saved')
//         ->assertSee($updatedStartDate)
//         ->assertDontSee($originalStartDate);
// });
