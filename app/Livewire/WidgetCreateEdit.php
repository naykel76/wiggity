<?php

namespace App\Livewire;

use App\Livewire\Forms\WidgetFormObject;
use App\Models\Widget;
use Livewire\Component;
use Naykel\Gotime\Traits\Renderable;
use Naykel\Gotime\Traits\WithFormActions;

class WidgetCreateEdit extends Component
{
    use Renderable, WithFormActions;

    public WidgetFormObject $form;
    protected string $modelClass = Widget::class;

    public function fillForm()
    {
        $model = Widget::factory()->make();
        $this->form->init($model);
    }

    public function doSomething()
    {
        $this->form->reset();
    }
}
