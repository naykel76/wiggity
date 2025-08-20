<div>
    <x-gt-resource-action action="create" dispatchTo="widget-create-edit" text="Create (DispatchTo)" />

    <x-gt-table>
        <x-slot:thead>
            <tr>
                <x-gt-table.th wire:click="sortBy('id')" class="w-4"
                    sortable :direction="$this->getSortDirection('id')"> id </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('title')"
                    sortable :direction="$this->getSortDirection('title')"> title </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('start_date')"
                    sortable :direction="$this->getSortDirection('start_date')"> start date </x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('end_date')"
                    sortable :direction="$this->getSortDirection('end_date')"> end date </x-gt-table.th>
                <th></th>
            </tr>
        </x-slot:thead>
        <x-slot:tbody>
            @forelse($items as $item)
                <tr wire:key="{{ $item->id }}">
                    <td wire:loading.class="green">{{ str_pad($item->id, 5, 0, STR_PAD_LEFT) }}</td>
                    <td>
                        {{ $item->title }}
                        {{-- when i have the key, how do i get the value from the array? --}}
                        <div class="flex space-x txt-xs">
                            <strong>Country</strong>: {{ $item->country ?? 'None' }}
                            <strong>RelatedID</strong>: {{ $item->related_widget_id ?? 'None' }}
                        </div>
                    </td>
                    <td>{{ $item->start_date }}</td>
                    <td>{{ $item->end_date }}</td>
                    <td>
                        <x-gt-resource-action action="edit" dispatchTo="widget-create-edit" :id="$item->id" text="Edit (DispatchTo)" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="tac pxy" colspan="10">No records found...</td>
                </tr>
            @endforelse
        </x-slot:tbody>
    </x-gt-table>
    {{ $items->links('gotime::pagination.livewire') }}
</div>
