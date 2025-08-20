<?php

use App\Livewire\WidgetCreateEdit;
use Livewire\Livewire;

describe('rendering', function () {
    /**
     * Here we are testing form field bindings rather than HTML elements or
     * labels. Bindings are always present when the form renders correctly and
     * won't break if styling, labels, or input types change.
     */
    it('renders form with correct fields', function () {
        Livewire::test(WidgetCreateEdit::class)
            ->assertSee('form.title')
            ->assertSee('form.country')
            ->assertSee('form.start_date')
            ->assertSee('form.end_date')
            ->assertSee('form.related_widget_id');
    });

    it('renders form with save and cancel buttons', function () {
        Livewire::test(WidgetCreateEdit::class)
            ->assertSee('SAVE')
            ->assertSee('CANCEL');
    });
});

describe('initialisation', function () {
    /**
     * Here we are testing that the form is initialised with the expected
     * default values when the component is mounted.
     */
    it('initialises form with default values when creating', function () {
        Livewire::test(WidgetCreateEdit::class)
            ->call('create')
            ->assertSet('form.title', '')
            ->assertSet('form.country', '')
            ->assertSet('form.start_date', null)
            ->assertSet('form.end_date', null)
            ->assertSet('form.related_widget_id', '');
    });

    // is this the best place to test this?
    it('initialises form with existing data when editing', function () {
        $widget = createWidget();

        Livewire::test(WidgetCreateEdit::class)
            ->call('edit', $widget->id)
            ->assertSet('form.title', $widget->title)
            ->assertSet('form.country', $widget->country)
            // This must match the format expected by the date picker
            ->set('form.start_date', $widget->start_date?->format(config('gotime.date_format')))
            ->set('form.end_date', $widget->end_date?->format(config('gotime.date_format')))
            ->assertSet('form.related_widget_id', $widget->related_widget_id);
    });
});

describe('validation', function () {

    it('requires title field', function () {
        Livewire::test(WidgetCreateEdit::class)
            ->call('create')
            ->set('form.title', '')
            ->call('save')
            ->assertHasErrors(['form.title' => 'required']);
    });

    it('validates title max length', function () {
        Livewire::test(WidgetCreateEdit::class)
            ->call('create')
            ->set('form.title', str_repeat('a', 256)) // Over 255 chars
            ->call('save')
            ->assertHasErrors(['form.title' => 'max']);
    });

    it('validates country max length', function () {
        Livewire::test(WidgetCreateEdit::class)
            ->call('create')
            ->set('form.title', 'Valid Title') // Provide required field
            ->set('form.country', str_repeat('a', 256)) // Over 255 chars
            ->call('save')
            ->assertHasErrors(['form.country' => 'max']);
    });

    it('validates start_date is today or future', function () {
        Livewire::test(WidgetCreateEdit::class)
            ->call('create')
            ->set('form.title', 'Valid Title')
            ->set('form.start_date', now()->subDay()->format('d-m-Y')) // Past date
            ->call('save')
            ->assertHasErrors(['form.start_date']);
    });

    it('validates end_date is after start_date', function () {
        Livewire::test(WidgetCreateEdit::class)
            ->call('create')
            ->set('form.title', 'Valid Title')
            ->set('form.start_date', now()->addDays(2)->format('d-m-Y'))
            ->set('form.end_date', now()->addDay()->format('d-m-Y')) // Before start_date
            ->call('save')
            ->assertHasErrors(['form.end_date']);
    });

    it('validates related_widget_id is integer when provided', function () {
        Livewire::test(WidgetCreateEdit::class)
            ->call('create')
            ->set('form.title', 'Valid Title')
            ->set('form.related_widget_id', 'not-an-integer')
            ->call('save')
            ->assertHasErrors(['form.related_widget_id']);
    });
});

describe('data persistence', function () {

    it('creates new widget with valid data', function () {
        $widget = makeWidget();

        $this->assertDatabaseEmpty('widgets');

        Livewire::test(WidgetCreateEdit::class)
            ->call('create') // This calls init() with a new model
            ->set('form.title', $widget->title)
            ->set('form.country', $widget->country)
            ->set('form.start_date', $widget->start_date)
            ->set('form.end_date', $widget->end_date)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('widgets', [
            'title' => $widget->title,
            'country' => $widget->country,
            'start_date' => $widget->start_date,
            'end_date' => $widget->end_date,
        ]);

        $this->assertDatabaseCount('widgets', 1);
    });

    it('updates existing widget', function () {
        $widget = createWidget(['title' => 'Original Title']);

        Livewire::test(WidgetCreateEdit::class)
            ->call('edit', $widget->id)
            ->set('form.title', 'Updated Title')
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('widgets', [
            'id' => $widget->id,
            'title' => 'Updated Title',
        ]);
    });

    it('saves widget with valid date range', function () {
        Livewire::test(WidgetCreateEdit::class)
            ->call('create')
            ->set('form.title', 'Dated Widget')
            ->set('form.start_date', now()->addDay())
            ->set('form.end_date', now()->addDays(3))
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('widgets', [
            'title' => 'Dated Widget',
        ]);
    });

    it('saves widget with related widget id', function () {
        $widget = makeWidget(); // the widget to be created
        $relatedWidget = createWidget(); // the related widget

        Livewire::test(WidgetCreateEdit::class)
            ->call('create')
            ->set('form.title', $widget->title)
            ->set('form.related_widget_id', $relatedWidget->id)
            ->call('save')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('widgets', [
            'title' => $widget->title,
            'related_widget_id' => $relatedWidget->id,
        ]);
    });
});
