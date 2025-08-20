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

    #[Validate('string|max: 255')]
    public string $country = '';

    #[Validate('nullable|date|after_or_equal:today')]
    public ?string $start_date = null;

    // need to exclude if existing, otherwise you can not update
    #[Validate('nullable|date|after:start_date')]
    public ?string $end_date = null;

    // Do not add type hint here. This is used in a select component and it will
    // not play well is the value is not a string. E.g. null or an int.
    #[Validate('sometimes|int')]
    public $related_widget_id = '';

    public function init(Widget $model): void
    {
        $this->editing = $model;
        $this->setFormProperties($model);
    }

    public function createNewModel(array $data = []): Widget
    {
        return Widget::make(array_merge([], $data));
    }
}
