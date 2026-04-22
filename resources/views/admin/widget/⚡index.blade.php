<?php

use App\Models\Widget;
use Naykel\Gotime\Livewire\BaseIndex;
use Naykel\Gotime\Traits\Sortable;

new class extends BaseIndex
{
    use Sortable;

    protected string $modelClass = Widget::class;

    protected function configKey(): string
    {
        return 'widget';
    }

    protected function query($query)
    {
        return $this->applySorting($query);
    }
};
?>

<div>
    <x-gt-resource-action action="create" :$routePrefix />
    <x-gt-table>
        <x-slot:thead>
            <tr>
                <x-gt-table.th wire:click="sortBy('name')" sortable :direction="$this->getSortDirection('name')">Name</x-gt-table.th>
                <x-gt-table.th wire:click="sortBy('code')" sortable :direction="$this->getSortDirection('code')">Code</x-gt-table.th>
                <x-gt-table.th>Status</x-gt-table.th>
                <x-gt-table.th>Active</x-gt-table.th>
                <x-gt-table.th></x-gt-table.th>
            </tr>
        </x-slot:thead>
        <x-slot:tbody>
            @forelse($this->items as $item)
                <tr wire:key="{{ $item->id }}">
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->code }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ $item->is_active ? 'Yes' : 'No' }}</td>
                    <td class="whitespace-nowrap">
                        <x-gt-resource-action action="edit" :$routePrefix :id="$item->id" />
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="tac pxy" colspan="10">No records found...</td>
                </tr>
            @endforelse
        </x-slot:tbody>
    </x-gt-table>
    {{ $this->items->links('gotime::pagination.livewire') }}
</div>
