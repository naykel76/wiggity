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

    #[Validate]
    public string $code = '';

    #[Validate('nullable|boolean')]
    public bool $active = true;

    // public string $main_image = '';
    // public string $slug = '';
    // public string $department = '';
    // public string $extra_data = '';

    /**
     * ======================================================================
     * Related Properties (ProductDetail)
     * ======================================================================
     */
    #[Validate('sometimes')]
    public string $headline = '';

    #[Validate('sometimes')]
    public string $description = '';

    /**
     * ======================================================================
     * Date Properties
     * ======================================================================
     */

    // public string $special_start_date = '';
    // public string $special_end_date = '';

    /**
     * ======================================================================
     * Numeric Properties
     * ======================================================================
     */
    #[Validate('nullable|numeric|min:0|max:99999.99')]
    public string $price = '0.00';

    #[Validate('nullable|numeric|min:0|max:99999.99')]
    public ?float $special_price = null;

    #[Validate('integer|min:0')]
    public int $stock = 0;

    protected function rules()
    {
        return [
            'code' => 'unique:products,code,' . $this->editing->id,
        ];
    }

    /**
     * ======================================================================
     * NOTES
     * ======================================================================
     * - when using price cast, make sure to set the property after
     *   setFormProperties() to ensure the cast is applied.
     */
    public function init(Product $model): void
    {
        $this->editing = $model;
        $this->setFormProperties($this->editing);

        // $this->price = $model->price;
    }

    public function createNewModel(array $data = []): Product
    {
        return Product::make(array_merge([
            //
        ], $data));
    }
}
