<x-gt-app-layout layout="{{ config('gotime.template') }}" hasContainer class="py-5-3-2-2">

    <div class="grid cols-2">
        <livewire:product-create-edit mode="edit" />
        <livewire:product-create-edit mode="create" />
    </div>
    <livewire:product-index @model-saved="apples" />

    {{-- @<livewire:edit-post > --}}
</x-gt-app-layout>
