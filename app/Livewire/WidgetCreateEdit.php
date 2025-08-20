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
    public array $dateRangeOptions = [];

    public function mount()
    {
        $this->dateRangeOptions = Widget::getDateRangeOptions();
    }

    public function fillForm(bool $useFactory = false): void
    {
        $model = $useFactory
            ? Widget::factory()->make()
            : $this->form->createNewModel();

        $this->form->init($model);
    }

    public function doSomething()
    {
        $this->form->reset();
    }
}
