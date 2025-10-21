<?php

use App\Livewire\Products\CreateEdit;
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
        Livewire::test(CreateEdit::class)->assertOk();
    });
    /**
     * Here we are testing form field bindings rather than HTML elements or
     * labels. Bindings are always present when the form renders correctly and
     * won't break if styling, labels, or input types change.
     */
    it('renders form with correct fields', function () {
        Livewire::test(CreateEdit::class)
            ->assertSee([
                'form.name',
                'form.code',
                'form.department',
                'form.price',
                'form.stock',
                'form.active',
            ]);
    });

    it('renders form with save and cancel buttons', function () {
        Livewire::test(CreateEdit::class)
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
        $component = Livewire::test(CreateEdit::class)
            ->call('create');

        expect($component->get('form.name'))->toBe('')
            ->and($component->get('form.code'))->toBe('')
            ->and($component->get('form.department'))->toBe('')
            ->and($component->get('form.price'))->toBe('0.00')
            ->and($component->get('form.stock'))->toBe(0)
            ->and($component->get('form.active'))->toBeTrue();

        // Test component state
        expect($component->get('showModal'))->toBeTrue();
    });

    /**
     * When testing against existing model data, assertSet() is fine since
     * we're comparing actual values, not testing falsy value distinctions.
     */
    it('initialises form with existing data when editing', function () {
        $product = Product::factory()->create();

        Livewire::test(CreateEdit::class)
            ->call('edit', $product->id)
            ->assertSet('form.name', $product->name)
            ->assertSet('form.code', $product->code)
            ->assertSet('form.department', $product->department)
            ->assertSet('form.price', $product->price)
            ->assertSet('form.stock', $product->stock)
            ->assertSet('form.active', $product->active);
    });
});

describe('modal handling', function () {
    it('opens modal when create is called', function () {
        Livewire::test(CreateEdit::class)
            ->call('create')
            ->assertSet('showModal', true);
    });

    it('opens modal when edit is called', function () {
        $product = Product::factory()->create();
        Livewire::test(CreateEdit::class)
            ->call('edit', $product->id)
            ->assertSet('showModal', true);
    });

    it('closes modal when cancel is called', function () {
        $component = Livewire::test(CreateEdit::class)
            ->call('create')
            ->call('cancel');
        expect($component->get('showModal'))->toBeFalse();
    });

    it('closes modal when save is called', function () {
        // ====================================================================
        // MOCK SETUP: We're testing MODAL BEHAVIOR, not database operations
        // ====================================================================
        // We mock the Product model to simulate a successful save without
        // actually hitting the database. This isolates our test to focus purely
        // on whether the modal closes when save succeeds.

        $this->mock(\App\Models\Product::class, function ($mock) {
            // Mock the save() method to always return true (success)
            // This prevents actual database writes and validation issues
            $mock->shouldReceive('save')->andReturn(true);

            // Mock getAttribute/setAttribute to handle property access
            // These are called when the form interacts with the model
            $mock->shouldReceive('getAttribute')->andReturn(null);
            $mock->shouldReceive('setAttribute')->andReturn(null);
        });

        // TEST EXECUTION: Test the actual modal behavior
        $component = Livewire::test(CreateEdit::class)
            ->call('create')      // Opens the modal (showModal = true)
            ->call('save');       // Attempts to save (should close modal)

        // ASSERTION: Verify the modal closed after successful save
        expect($component->get('showModal'))->toBeFalse();
    });
});
