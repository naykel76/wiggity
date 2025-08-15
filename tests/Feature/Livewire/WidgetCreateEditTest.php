<?php

use App\Livewire\WidgetCreateEdit;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(WidgetCreateEdit::class)
        ->assertStatus(200);
});
