<div>
    <div class="bx pxy-05 light">
        <?php $selected = Arr::except($form->toArray(), ['editing', 'tmpUpload']); ?>
        <pre class="txt-xs">{{ json_encode($selected, JSON_PRETTY_PRINT) }}</pre>
    </div>
    <div class="bx">
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
            </div>
            <x-gt-input wire:model="form.headline" label="headline" class="sm" />
            <x-gt-input wire:model="form.description" label="description" class="sm" />
            <hr>
            <div class="flex">
                <x-gt-input wire:model="form.main_image" label="main_image" class="sm" disabled />
                <x-gt-input wire:model="form.department" label="department" class="sm" disabled />
                <x-gt-input wire:model="form.extra_data" label="extra_data" class="sm" disabled />
            </div>
            <hr>
            <h4>Special Pricing</h4>
            <div class="flex">
                <x-gt-input wire:model="form.special_start_date" label="special_start_date" class="sm" disabled />
                <x-gt-input wire:model="form.special_end_date" label="special_end_date" class="sm" disabled />
                <x-gt-input wire:model="form.special_price" label="special_price" class="sm" disabled />
            </div>
            <hr>
            <x-gt-checkbox wire:model="form.active" label="active" class="sm" />
            <x-gt-input wire:model="form.slug" label="slug" class="sm" disabled />
            <div class="tar">
                <x-gt-button wire:click="cancel" class="btn sm" text="CANCEL" />
                <x-gt-button wire:click="save" class="btn primary sm" text="SAVE" />
            </div>
        </form>
    </div>
</div>
