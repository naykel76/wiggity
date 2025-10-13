<x-gt-table class="txt-xs bdr bdr-gray-200 mt-05">
    <x-slot:thead class="bdr-b bdr-gra-200">
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
                <td>{{ str_pad($item->id, 3, 0, STR_PAD_LEFT) }}</td>
                <td>
                    {{ Str::limit($item->name, 40) }}
                    <div class="flex space-x txt-xs">
                        <strong>Department</strong>: {{ \App\Models\Product::DEPARTMENTS[$item->department] ?? 'none' }}
                    </div>
                </td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->price }}</td>
                <td>{{ $item->active ? 'true' : 'false' }}</td>
                <td>{{ $item->createdAtDate() }}</td>
                <td><x-gt-resource-action action="edit" dispatchTo="product-create-edit" :id="$item->id" /></td>
            </tr>
        @empty
            <tr>
                <td class="tac pxy" colspan="10">No products found...</td>
            </tr>
        @endforelse
    </x-slot:tbody>
</x-gt-table>