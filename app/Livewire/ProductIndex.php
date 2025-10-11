<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Naykel\Gotime\Traits\Filterable;
use Naykel\Gotime\Traits\Renderable;
use Naykel\Gotime\Traits\Sortable;

class ProductIndex extends Component
{
    use Filterable, Renderable, Sortable, WithPagination;

    protected string $modelClass = Product::class;
    public string $pageTitle = 'Product Table';
    public int $perPage = 16;
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

<<<<<<< Updated upstream
    // define the example you want to use, otherwise just show the normal table.
    // This should allow me to build out different examples without needing
    // to create new components for each one.
    public string $example = '';

=======
>>>>>>> Stashed changes
    public function export()
    {
        return $this->modelClass::query()->toCsv();
    }

<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes
    #[On('model-saved')]
    public function refreshComponent()
    {
        $this->resetPage(); // Reset to the first page
    }

    protected function prepareData()
    {
        $query = $this->modelClass::query();
        $query = $this->applySorting($query);
        $query = $this->applyFilters($query);

        return ['items' => $query->paginate($this->perPage)];
    }
}
