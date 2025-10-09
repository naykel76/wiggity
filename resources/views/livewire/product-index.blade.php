{{-- This component uses partials to organize the Blade template into smaller,
reusable sections. Partials automatically inherit all variables from the parent
view, unlike components which require explicit data passing. This makes them
ideal for splitting Livewire views into maintainable, smaller sections. --}}

<div>
    <div class="grid md:cols-2 gap-3">
        <div>
            @if ($example === 'pagination-elements')
                {{ $items->links('livewire.pagination-elements') }}
            @elseif ($example === 'filters')
                @include('livewire.partials.example-table-filters')
            @elseif ($example === 'date-range-filters')
                @include('livewire.partials.example-table-filters-date-range')
            @endif
        </div>
        <div>
            @include('livewire.partials.product-table-filters')
            @include('livewire.partials.product-table')
            {{ $items->onEachSide(0)->links('gotime::pagination.livewire') }}
        </div>
    </div>
</div>
