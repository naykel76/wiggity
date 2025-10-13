<x-gt-modal wire:model="showModal" maxWidth="lg">
    <form wire:submit="save">
        <h4>Product Details</h4>
        <div class="flex gap">
            <x-gt-input wire:model="form.code" label="code" class="w-10 sm" />
            <x-gt-input wire:model="form.name" label="name" class="sm" rowClass="fg1" />
        </div>
        <div class="flex gap">
            <x-gt-input wire:model="form.price" label="Price" class="sm" />
            <x-gt-input wire:model="form.stock" label="stock" class="sm" />
            <x-gt-select wire:model="form.department" label="Department" class="sm" :options="\App\Models\Product::DEPARTMENTS" />
            <x-gt-input wire:model="form.created_at" label="created_at" class="sm" disabled />
        </div>
        <x-gt-checkbox wire:model="form.active" label="active" class="sm" />
        <div class="tar">
            <x-gt-button wire:click="cancel" class="btn sm" text="CANCEL" />
            <x-gt-button wire:click="save" class="btn primary sm" text="SAVE" />
        </div>
    </form>
</x-gt-modal>
