{{-- This component uses partials to organise the Blade template into smaller,
maintainable sections. When $example is set, it displays side-by-side
documentation examples alongside a simplified product table. When $example is
empty, it shows the full product table with filters and pagination. --}}

<div @class(['grid md:cols-2 md:gap-3' => $example !== ''])>
    @if ($example !== '')
        <div>
            @if ($example === 'pagination-elements')
                {{ $items->links('livewire.pagination-elements') }}
            @elseif ($example === 'filters')
                @include('livewire.example-filters')
            @elseif ($example === 'date-range-filters')
                @include('livewire.example-filters-date-range')
            @endif
        </div>
        <div>
            @include('livewire.products.partials.product-table-filters')
            @include('livewire.products.partials.product-table')
        </div>
    @else
        @include('livewire.products.partials.product-table-filters')
        @include('livewire.products.partials.product-table')
        {{ $items->onEachSide(0)->links('gotime::pagination.livewire') }}
    @endif
</div>
