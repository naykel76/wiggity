<?php

namespace App\Livewire\Forms;

use App\Models\Widget;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Naykel\Gotime\Traits\Crudable;
use Naykel\Gotime\Traits\Formable;

class WidgetFormObject extends Form
{
    use Crudable, Formable;

    #[Validate('required|string|max: 255')]
    public string $title = '';

    #[Validate('nullable|date|after_or_equal:today')]
    public ?string $start_date;

    #[Validate('nullable|date|after:start_date')]
    public ?string $end_date;

    public function init(Widget $model): void
    {
        $this->editing = $model;
        $this->setFormProperties($model);
    }

    public function createNewModel(array $data = []): Widget
    {
        return Widget::make(array_merge([
            // 'title' => '',
        ], $data));
    }
}
