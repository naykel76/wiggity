<?php

namespace App\Livewire\Forms;

use App\Models\Product;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Naykel\Gotime\Traits\Crudable;
use Naykel\Gotime\Traits\Formable;

/**
 * ======================================================================
 * NOTES
 * ======================================================================
 * You will notice that some properties are type hinted (e.g. string, bool)
 * while others are not (e.g. $price, $stock). This is intentional because PHP
 * is a pig and if a user enters an invalid value (e.g. a string into a numeric
 * field) it will throw a type error and a 500 error page instead of a
 * validation error. Not good UX.
 * General rule for Livewire forms:
 *
 * - ✅ Type hint `string`, `bool`, `array` (user input naturally matches)
 * - ❌ Don't type hint `int`, `float`, or numeric types (let validation handle it)
 */
class ProductFormObject extends Form
{
    use Crudable, Formable;

    #[Validate('string|max: 255')]
    public string $name = '';

    #[Validate]
    public string $code = '';

    #[Validate]
    public string $department = '';

    #[Validate('nullable|numeric|min:0|max:99999.99')]
    public $price = '0.00';

    #[Validate('integer|min:0')]
    public $stock = 0;

    #[Validate('nullable|boolean')]
    public bool $active = true;

    #[Validate]
    public string $created_at = '';

    protected function rules()
    {
        return [
            'code' => 'unique:products,code,' . $this->editing->id,
            'department' => 'in:' . implode(',', array_keys(Product::DEPARTMENTS)),
        ];
    }

    public function init(Product $model): void
    {
        $this->editing = $model;
        $this->setFormProperties($this->editing);
    }

    public function createNewModel(array $data = []): Product
    {
        return Product::make(array_merge([
            //
        ], $data));
    }
}
