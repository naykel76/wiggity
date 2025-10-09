<?php

namespace App\Livewire;

use App\Livewire\Forms\ProductFormObject;
use App\Models\Product;
use Livewire\Component;
use Naykel\Gotime\Traits\WithFormActions;

class ProductCreateEdit extends Component
{
    use WithFormActions;

    public ProductFormObject $form;
    protected string $modelClass = Product::class;
    public string $mode = 'create';

    // public function mount()
    // {
    //     $model = $this->modelClass::find(2);
    //     $this->form->init($model);
    // }
}
