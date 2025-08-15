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

    #[On('model-saved')]
    public function refreshComponent()
    {
        // Which one and why? How can i handle the lag?
        $this->resetPage(); // resets pagination to page 1 and triggers a re-render
        $this->dispatch('$refresh');
    }

    protected function prepareData()
    {
        $query = $this->modelClass::query();
        $query = $this->applySorting($query);

        return ['items' => $query->paginate(8)];
    }
}
