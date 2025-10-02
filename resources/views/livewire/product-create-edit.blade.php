<div class="flex gap">
    <div class="bx fg1">
        <div class="bx-header flex space-between">
            @if ($mode === 'edit')
                <h3>Edit Product</h3>
            @else
                <h3>Create Product</h3>
            @endif
            <x-gt-resource-action action="create" />
        </div>
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
    </div>
    <div class="bx pxy-05 light w-16">
        <?php $selected = Arr::except($form->toArray(), ['editing', 'tmpUpload']); ?>
        <pre class="txt-xs">{{ json_encode($selected, JSON_PRETTY_PRINT) }}</pre>
    </div>
</div>
