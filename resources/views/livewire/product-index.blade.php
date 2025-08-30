<div>
    <div class="bx">
        <div class="bx-header flex gap">
            <div class="bx-title">Active Filters</div>
            <div>
                @forelse ($filters as $key => $value)
                    @if (is_array($value))
                        @foreach ($value as $singleValue)
                            <x-gt-button wire:click="clearFilter('{{ $key }}', '{{ $singleValue }}')"
                                text="{{ $this->getFilterLabel($key) }}: {{ $this->getDisplayValue($key, $singleValue) }}"
                                icon="close" iconPosition="right" iconClass="pxy-025" class="dark xs" />
                        @endforeach
                    @else
                        <x-gt-button wire:click="clearFilter('{{ $key }}')"
                            text="{{ $this->getFilterLabel($key) }}: {{ $this->getDisplayValue($key, $value) }}"
                            icon="close" iconPosition="right" iconClass="pxy-025" class="dark xs" />
                    @endif
                @empty
                    <p>No active filters.</p>
                @endforelse
            </div>
        </div>
        <div>
            @foreach ($departments as $key => $value)
                <x-gt-button wire:click="setFilter('department', '{{ $key }}')" text="{{ $value }}" class="xs" />
            @endforeach
            |
            <x-gt-button wire:click="setFilter('active', 1)" text="Active" class="xs" />
            <x-gt-button wire:click="setFilter('active', 0)" text="InActive" class="xs" />
            |
            <x-gt-button.secondary wire:click="clearFilter('department')" text="Clear Department" class="xs" />
            <x-gt-button.secondary wire:click="clearAllFilters()" text="Clear All" class="xs" />
        </div>
    </div>
    <div class="tar">
        {{-- This select element allows multi selection. Under most situations
        this would not happen, but it's no biggie to leave it as is. --}}
        <select wire:change="setFilter('department', $event.target.value)" class="xs">
            <option value="">All Departments</option>
            @foreach ($departments as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>
    {{ $items->links('gotime::pagination.livewire') }}
    <x-gt-table>
        <x-slot:thead>
            <tr>
                <x-gt-table.th wire:click="sortBy('id')" class="w-4"
                    sortable :direction="$this->getSortDirection('id')"> id </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('name')"
                    sortable :direction="$this->getSortDirection('name')"> name </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('code')"
                    sortable :direction="$this->getSortDirection('code')"> code </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('price')"
                    sortable :direction="$this->getSortDirection('price')"> price </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('active')"
                    sortable :direction="$this->getSortDirection('active')"> active </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('created_at')"
                    sortable :direction="$this->getSortDirection('created_at')"> Created </x-gt-table.th>
                <th></th>
            </tr>
        </x-slot:thead>
        <x-slot:tbody>
            @forelse($items as $item)
                <tr wire:key="{{ $item->id }}">
                    <td>{{ str_pad($item->id, 5, 0, STR_PAD_LEFT) }}</td>
                    <td>
                        {{ Str::limit($item->name, 60) }}
                        <div class="flex space-x txt-xs">
                            <strong>Department</strong>: {{ \App\Models\Product::DEPARTMENTS[$item->department] }}
                        </div>
                    </td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->active ? 'true' : 'false' }}</td>
                    <td>{{ $item->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td class="tac pxy" colspan="10">No products found...</td>
                </tr>
            @endforelse
        </x-slot:tbody>
    </x-gt-table>
    {{ $items->links('gotime::pagination.livewire') }}
</div>
