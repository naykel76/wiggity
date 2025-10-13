<?php

namespace App\Livewire\Products;

use App\Livewire\Forms\ProductFormObject;
use App\Models\Product;
use Livewire\Component;
use Naykel\Gotime\Traits\WithFormActions;

class CreateEdit extends Component
{
    use WithFormActions;

    public ProductFormObject $form;
    protected string $modelClass = Product::class;
    public string $mode = 'create';

    public function render()
    {
        return view('livewire.products.create-edit');
    }
}
