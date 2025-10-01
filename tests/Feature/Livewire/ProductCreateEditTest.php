<?php

use App\Livewire\Forms\ProductFormObject;
use App\Livewire\ProductCreateEdit;
use App\Models\Product;
use Livewire\Livewire;

/**
 * ==========================================================================
 * RENDERING
 * ==========================================================================
 * Tests the visual output and UI state of the component. Covers how data is
 * displayed to users, including empty states, populated forms, lists with
 * varying record counts, and the presence of interactive elements like buttons
 * and form fields.
 *
 * Focus on what users see, not how it's implemented.
 */
describe('rendering', function () {
    it('renders successfully', function () {
        Livewire::test(ProductCreateEdit::class)->assertOk();
    });
    /**
     * Here we are testing form field bindings rather than HTML elements or
     * labels. Bindings are always present when the form renders correctly and
     * won't break if styling, labels, or input types change.
     */
    it('renders form with correct fields', function () {
        Livewire::test(ProductCreateEdit::class)
            ->assertSee([
                'form.name',
                'form.code',
                'form.headline',
                'form.description',
                'form.main_image',
                'form.slug',
                'form.department',
                'form.price',
                'form.stock',
                'form.special_start_date',
                'form.special_end_date',
                'form.special_price',
                'form.extra_data',
                'form.active',
            ]);
    });

    it('renders form with save and cancel buttons', function () {
        Livewire::test(ProductCreateEdit::class)
            ->assertSee('SAVE')
            ->assertSee('CANCEL');
    });
});

/**
 * ==========================================================================
 * INITIALISATION
 * ==========================================================================
 * Tests the component's setup behavior when first loaded. Verifies that forms
 * start with appropriate default values for new records, correctly populate
 * with existing data when editing, and that all properties are bound and ready
 * for user interaction. Covers both "create new" and "edit existing" scenarios.
 */
describe('initialisation', function () {
    it('initialises form with correct values when creating', function () {
        $component = Livewire::test(ProductCreateEdit::class)
            ->call('create');

        expect($component->get('form.name'))->toBe('')
            ->and($component->get('form.code'))->toBe('')
            ->and($component->get('form.headline'))->toBe('')
            ->and($component->get('form.description'))->toBe('')
            //  ->and($component->get('form.main_image'))->toBe()
            //  ->and($component->get('form.slug'))->toBe()
            //  ->and($component->get('form.department'))->toBe()
            //  ->and($component->get('form.price'))->toBe(0.00)
            ->and($component->get('form.stock'))->toBe(0)
            //  ->and($component->get('form.special_start_date'))->toBe()
            //  ->and($component->get('form.special_end_date'))->toBe()
            //  ->and($component->get('form.special_price'))->toBe()
            //  ->and($component->get('form.extra_data'))->toBe()
            ->and($component->get('form.active'))->toBeTrue();

        // Test component state
        expect($component->get('showModal'))->toBeTrue();

    });

    /**
     * When testing against existing model data, assertSet() is fine since
     * we're comparing actual values, not testing falsy value distinctions.
     */
    it('initialises form with existing data when editing', function () {
        $product = createProduct();

        Livewire::test(ProductCreateEdit::class)
            ->call('edit', $product->id)
            ->assertSet('form.name', $product->name)
            ->assertSet('form.code', $product->code)
            ->assertSet('form.headline', $product->headline)
            ->assertSet('form.description', $product->description)
            ->assertSet('form.main_image', $product->main_image)
            ->assertSet('form.slug', $product->slug)
            // ->assertSet('form.department', $product->department)
            // ->assertSet('form.price', $product->price)
            ->assertSet('form.stock', $product->stock)
            // ->assertSet('form.special_start_date', $product->special_start_date)
            // ->assertSet('form.special_end_date', $product->special_end_date)
            // ->assertSet('form.special_price', $product->special_price)
            ->assertSet('form.extra_data', $product->extra_data)
            ->assertSet('form.active', $product->active);
    });
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

it('casts the price correctly', function () {})->todo();
