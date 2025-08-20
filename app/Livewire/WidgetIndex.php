<?php

namespace App\Livewire;

use App\Models\Widget;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Naykel\Gotime\Traits\Renderable;
use Naykel\Gotime\Traits\Sortable;

class WidgetIndex extends Component
{
    use Renderable, Sortable, WithPagination;

    protected string $modelClass = Widget::class;
    public string $pageTitle = 'Widget Table';
    public int $perPage = 8;

    #[On('model-saved')]
    public function refreshComponent()
    {
        $this->resetPage(); // resets pagination to page 1 and triggers a re-render
    }

    protected function prepareData()
    {
        $query = $this->modelClass::query();
        $query = $this->applySorting($query);

        return ['items' => $query->paginate($this->perPage)];
    }
}
