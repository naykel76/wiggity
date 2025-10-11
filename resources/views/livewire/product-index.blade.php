{{-- This component uses partials to organize the Blade template into smaller,
reusable sections. Partials automatically inherit all variables from the parent
view, unlike components which require explicit data passing. This makes them
ideal for splitting Livewire views into maintainable, smaller sections. --}}

<div>
<<<<<<< Updated upstream
    <div class="grid md:cols-2 gap-3">
        <div>
            @if ($example === 'pagination-elements')
                {{ $items->links('livewire.pagination-elements') }}
            @elseif ($example === 'filters')
                @include('livewire.partials.example-table-filters')
            @elseif ($example === 'date-range-filters')
                @include('livewire.partials.example-table-filters-date-range')
            @endif
=======
    <div class="bx">
        <div class="bx-header flex gap">
            <div class="bx-title">Active Filters</div>
            <div>
                @forelse ($filters as $key => $value)
                    @if (is_array($value))
                        @foreach ($value as $singleValue)
                            <x-gt-button wire:click="clearFilter('{{ $key }}', '{{ $singleValue }}')" class="dark xs"
                                text="{{ $this->getActiveFilterLabel($key) }}: {{ $this->getActiveFilterValue($key, $singleValue) }}"
                                icon="close" iconClass="bg-pink" />
                        @endforeach
                    @else
                        <x-gt-button wire:click="clearFilter('{{ $key }}')" class="dark xs"
                            text="{{ $this->getActiveFilterLabel($key) }}: {{ $this->getActiveFilterValue($key, $value) }}"
                            icon="close" iconClass="bg-pink" />
                    @endif
                @empty
                    <p>No active filters.</p>
                @endforelse
            </div>
>>>>>>> Stashed changes
        </div>
        <div>
            @include('livewire.partials.product-table-filters')
            @include('livewire.partials.product-table')
            {{ $items->onEachSide(0)->links('gotime::pagination.livewire') }}
        </div>
    </div>
</div>
