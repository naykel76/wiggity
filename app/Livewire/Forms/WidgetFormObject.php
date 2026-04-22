<?php

namespace App\Livewire\Forms;

use App\Models\Widget;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Naykel\Gotime\Traits\Crudable;
use Naykel\Gotime\Traits\Formable;

class WidgetFormObject extends Form
{
    use Crudable, Formable;

    public array $storage = [
        'disk' => 'public',
        'dbColumn' => 'image_name',
        'path' => 'uploads/images',
    ];

    #[Validate('nullable|string|max:255')]
    public string $name = '';

    public string $code = '';

    #[Validate('nullable|string|max:255')]
    public string $headline = '';

    #[Validate('nullable|string')]
    public string $overview = '';

    #[Validate('nullable|boolean')]
    public ?bool $is_active = true;

    #[Validate('nullable|string|max:255')]
    public string $status = '';

    protected function rules(): array
    {
        return [
            'code' => ['nullable', 'string', 'max:255', Rule::unique('widgets', 'code')->ignore($this->editing)],
        ];
    }

    public function init(Widget $model): void
    {
        $this->editing = $model;
        $this->setFormProperties($this->editing);
    }
}
