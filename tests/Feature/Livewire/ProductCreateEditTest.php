<?php

use App\Livewire\Forms\ProductFormObject;
use App\Livewire\ProductCreateEdit;
use App\Models\Product;
use Livewire\Livewire;

it('casts the price correctly', function () {})->todo();

// Test what users see and interact with such as buttons, forms, and lists.
// Focus on the visual output and UI state, not the underlying implementation.
describe('rendering', function () {
    // it('renders successfully', function () {
    //     Livewire::test(ProductCreateEdit::class)->assertOk();
    // });
    /**
     * Here we are testing form field bindings rather than HTML elements or
     * labels. Bindings are always present when the form renders correctly and
     * won't break if styling, labels, or input types change.
     */
    // it('renders form with correct fields', function () {
    //     Livewire::test(ProductCreateEdit::class)
    //         ->assertSee('form.name');
    //     // ->assertSee('form.headline')
    //     // ->assertSee('form.description');

    //     // name
    //     // headline
    //     // description
    //     // main_image
    //     // slug
    //     // code
    //     // department
    //     // price
    //     // stock
    //     // special_start_date
    //     // special_end_date
    //     // special_price
    //     // extra_data
    //     // active

    // });
});

describe('initialisation', function () {
    // Test component setup and initial state such as default values and data loading.
});

describe('user interactions', function () {
    // Test form submissions, clicks, and UI responses to user actions.
});

describe('reactivity & events', function () {
    // Test silent event dispatching and responses to external events.
    // Use this section when events happen without direct user interaction.
});

describe('validation', function () {
    // Test that invalid data is properly rejected with appropriate error messages.
});

describe('data persistence', function () {
    // Test successful save/update/delete operations and their side effects.
});

//
//

it('correctly handles custom cast in livewire form initialization', function () {
    // Create a product with a price that uses the custom cast
    $product = Product::create([
        'name' => 'Test Product',
        'price' => 149.99, // This should be stored as 14999 in database
        // ... other required fields
    ]);

    // Verify the cast works correctly when accessing via Eloquent
    expect($product->price)->toBe(149.99);

    // Verify the raw database value is stored as integer
    expect($product->getRawOriginal('price'))->toBe(14999);

    // Test Livewire component initialization
    $component = Livewire::test(ProductFormObject::class)
        ->call('init', $product);

    // The Livewire component should correctly display the cast value
    expect($component->price)->toBe(149.99);

    // Should not be the raw database value
    expect($component->price)->not->toBe(14999);
    expect($component->price)->not->toBe(149); // Not truncated
})->todo();

it('handles cast correctly when updating price in livewire form', function () {
    $product = Product::create([
        'name' => 'Test Product',
        'price' => 99.50,
    ]);

    $component = Livewire::test(ProductFormObject::class)
        ->call('init', $product)
        ->set('price', 199.99)
        ->call('save'); // Assuming you have a save method

    // Refresh the product from database
    $product->refresh();

    // Should be stored correctly with cast
    expect($product->price)->toBe(199.99);
    expect($product->getRawOriginal('price'))->toBe(19999);
})->todo();

it('preserves decimal precision in livewire form', function () {
    $testPrices = [
        149.99,
        0.01,
        999.50,
        1.23,
        10.00,
    ];

    foreach ($testPrices as $testPrice) {
        $product = Product::create([
            'name' => 'Test Product',
            'price' => $testPrice,
        ]);

        $component = Livewire::test(ProductFormObject::class)
            ->call('init', $product);

        expect($component->price)
            ->toBe($testPrice)
            ->and($component->price)
            ->not->toBe((int) $testPrice); // Ensure not truncated to integer
    }
})->todo();

it('validates numeric input correctly', function () {
    $product = Product::create([
        'name' => 'Test Product',
        'price' => 100.00,
    ]);

    // Test valid numeric input
    Livewire::test(ProductFormObject::class)
        ->call('init', $product)
        ->set('price', 199.99)
        ->assertHasNoErrors('price');

    // Test invalid input
    Livewire::test(ProductFormObject::class)
        ->call('init', $product)
        ->set('price', 'invalid')
        ->assertHasErrors('price');

    // Test negative price
    Livewire::test(ProductFormObject::class)
        ->call('init', $product)
        ->set('price', -10.00)
        ->assertHasErrors('price');
})->todo();
