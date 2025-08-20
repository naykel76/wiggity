<?php

use App\Livewire\WidgetIndex;
use App\Models\Widget;
use Livewire\Livewire;

describe('rendering', function () {
    it('renders successfully', function () {
        Livewire::test(WidgetIndex::class)->assertOk();
    });

    it('displays widgets in a paginated table', function () {
        $widgets = Widget::factory()->count(10)->create();

        Livewire::test(WidgetIndex::class)
            ->set('perPage', 5)
            ->assertSee($widgets->first()->title)        // First item should be visible
            ->assertDontSee($widgets->last()->title)     // Last item should NOT be visible (on page 2)
            ->assertSee('Results:');
    });

    it('shows empty state message when no widgets exist', function () {
        Livewire::test(WidgetIndex::class)
            ->assertSee('No records found...');
    });

    it('displays widget data correctly in table rows', function () {
        $widget = createWidget();

        Livewire::test(WidgetIndex::class)
            ->assertSee([
                $widget->title,
                $widget->country,
                $widget->start_date,
                $widget->end_date,
            ]);
    });
});

describe('reactivity & events', function () {
    it('refreshes to show new widget after model-saved event', function () {
        $widgetOne = createWidget();
        $component = Livewire::test(WidgetIndex::class);
        $widgetTwo = createWidget();

        // Only the first widget should be visible initially
        $component->assertSee($widgetOne->title)
            ->assertDontSee($widgetTwo->title);

        // After refreshComponent, both widgets should be visible
        $component->dispatch('model-saved')
            ->assertSee([$widgetOne->title, $widgetTwo->title]);
    });

    it('refreshes to show updated widget after model-saved event', function () {
        $widget = createWidget(['title' => 'Original Widget Title']);

        $component = Livewire::test(WidgetIndex::class);

        // Should see the original widget title
        $component->assertSee($widget->title);

        $widget->update(['title' => 'Updated Widget Title']);

        // After model-saved event, should see the updated title and not the old one
        $component->dispatch('model-saved')
            ->assertSee('Updated Widget Title')
            ->assertDontSee('Original Widget Title');
    });
});
