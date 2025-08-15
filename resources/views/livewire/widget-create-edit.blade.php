<div>
    <x-gt-modal wire:model="showModal">
        <x-gt-button.primary wire:click="fillForm" text="Create New and Fill" />
        <x-gt-button.primary wire:click="doSomething" text="Do Something" />
        <form wire:submit="save">
            <x-gt-input wire:model="form.title" label="title" />
            <div class="grid md:cols-2">
                <x-gt-input wire:model="form.start_date" label="Start Date" />
                <x-gt-input wire:model="form.end_date" label="End Date" />
            </div>
            <div class="tar">
                <x-gt-button wire:click="cancel" class="btn sm" text="CANCEL" />
                <x-gt-button wire:click="save" class="btn primary sm" text="SAVE" />
            </div>
        </form>
    </x-gt-modal>
    <div class="maxw-sm bx my">
        <div class="bx-title">Inline Sibling Form</div>
        <p>This is the same form as the modal, but rendered inline.</p>
        <x-gt-button.primary wire:click="fillForm" text="Create New and Fill" />
        <x-gt-button.primary wire:click="doSomething" text="Do Something" />
        <form wire:submit="save">
            <x-gt-input wire:model="form.title" label="title" />
            <div class="grid md:cols-2">
                <x-gt-input wire:model="form.start_date" label="Start Date" />
                <x-gt-input wire:model="form.end_date" label="End Date" />
            </div>
            <div class="tar">
                <x-gt-button wire:click="cancel" class="btn sm" text="CANCEL" />
                <x-gt-button wire:click="save" class="btn primary sm" text="SAVE" />
            </div>
        </form>
    </div>
    {{-- <pre>{{ json_encode($form, JSON_PRETTY_PRINT) }}</pre> --}}
</div>
