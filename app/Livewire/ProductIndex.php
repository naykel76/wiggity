<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Naykel\Gotime\Traits\Renderable;
use Naykel\Gotime\Traits\Sortable;

class ProductIndex extends Component
{
    use Renderable, Sortable, WithPagination;

    protected string $modelClass = Product::class;
    public string $pageTitle = 'Product Table';
    public int $perPage = 8;

    protected function prepareData()
    {
        $query = $this->modelClass::query();
        $query = $this->applySorting($query);

        return ['items' => $query->paginate($this->perPage)];
    }
}
