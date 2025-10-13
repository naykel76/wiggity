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
    </div>
    <div class="flex space-between">
        <div>
            {{-- Multi-value filter: allows selecting multiple options from the same database column --}}
            @foreach ($departments as $key => $value)
                <x-gt-button wire:click="setFilter('department', '{{ $key }}')" text="{{ $value }}"
                    class="xs bg-transparent txt-blue-700 hover:txt-white bdr bdr-blue-700 hover:bg-blue-800" />
            @endforeach
        </div>
        {{-- Single-value filter: allows selecting only one option from a database column --}}
        <div>
            @php
                $isActive = isset($filters['active']) && $filters['active'] == 1;
                $isInactive = isset($filters['active']) && $filters['active'] == 0;
            @endphp
            <x-gt-button wire:click="setFilter('active', 1)" text="Active"
                @class([
                    'xs hover:txt-white bdr bdr-red-700 hover:bg-red-700',
                    'bg-red-700 txt-white' => $isActive,
                    'bg-transparent txt-red-700' => !$isActive,
                ]) />
            <x-gt-button wire:click="setFilter('active', 0)" text="Inactive"
                @class([
                    'xs hover:txt-white bdr bdr-red-700 hover:bg-red-700',
                    'bg-red-700 txt-white' => $isInactive,
                    'bg-transparent txt-red-700' => !$isInactive,
                ]) />
        </div>
        <div>
            <x-gt-button.secondary wire:click="clearFilter('department')" text="Clear Department" class="xs" />
            <x-gt-button.secondary wire:click="clearAllFilters()" text="Clear All" class="xs" />
        </div>
    </div>
</div>
<div class="fw5 mt-05"> {{ $items->total() }} products found </div>
