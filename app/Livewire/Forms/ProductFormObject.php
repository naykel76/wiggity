<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Naykel\Gotime\Traits\Crudable;
use Naykel\Gotime\Traits\Formable;

class ProductFormObject extends Form
{
    use Crudable, Formable;

    #[Validate('string|max: 255')]
    public string $name = '';

    #[Validate('sometimes')]
    public string $headline = '';

    #[Validate('sometimes')]
    public string $description = '';

    #[Validate('nullable|boolean')]
    public bool $active = true;

    #[Validate('numeric|min:0')]
    public float $price = 0.0;

    #[Validate('integer|min:0')]
    public int $stock = 0;

    public string $code = '';

    // public string $main_image = '';
    // public string $slug = '';
    // public string $department = '';
    // public string $special_start_date = '';
    // public string $special_end_date = '';
    // public string $special_price = '';
    // public string $extra_data = '';

    protected function rules()
    {
        return [
            'code' => 'unique:products,code,' . $this->editing->id,
        ];
    }

    public function init(Product $model): void
    {
        $this->editing = $model;
        $this->setFormProperties($this->editing);
        $this->price = $model->price;  // forces cast to run
    }

    public function createAndInit(bool $useFactory = false)
    {
        $model = $useFactory
            ? Product::factory()->make()
            : Product::make();

        $this->init($model);
    }
}
