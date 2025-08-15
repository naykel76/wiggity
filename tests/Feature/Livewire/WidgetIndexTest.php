<?php

use App\Livewire\WidgetIndex;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(WidgetIndex::class)
        ->assertStatus(200);
});
