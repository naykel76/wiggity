<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Naykel\Gotime\Traits\Filterable;
use Naykel\Gotime\Traits\Sortable;

class Index extends Component
{
    use Filterable, Sortable, WithPagination;

    protected string $modelClass = Product::class;
    public string $pageTitle = 'Product Table';
    public int $perPage = 24;
    public $departments = Product::DEPARTMENTS;
    public array $filterOptions = [
        'department' => [
            'mode' => 'multi',
            'displayValues' => Product::DEPARTMENTS,
        ],
        'active' => [
            'label' => 'Status',
            'displayValues' => [
                1 => 'Active',
                0 => 'Inactive',
            ],
        ],
    ];

    // Set an example to display, otherwise show the default table.
    // Enables building different examples without new components.
    public string $example = '';

    public function export()
    {
        return $this->modelClass::query()->toCsv();
    }

    #[On('model-saved')]
    public function refreshComponent()
    {
        $this->resetPage(); // Reset to the first page
    }

    public function render()
    {
        $query = $this->modelClass::query();
        $query = $this->applySorting($query);
        $query = $this->applyFilters($query);

        return view('livewire.products.index', [
            'items' => $query->paginate($this->perPage),
        ]);
    }
}
