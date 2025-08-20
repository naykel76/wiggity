<div>
    <x-gt-modal wire:model="showModal">
        <div class="bx-title">Inline Sibling Form</div>
        <p>This is the same form as the modal, but rendered inline.</p>
        <x-gt-button.primary wire:click="fillForm(true)" text="Create New and Fill" class="sm" />
        <x-gt-button.primary wire:click="doSomething" text="Do Something" class="sm" />
        <form wire:submit="save">
            <x-gt-input wire:model="form.title" label="title" />
            <div class="grid md:cols-2">
                <x-gt-input wire:model="form.start_date" label="Start Date" />
                <x-gt-input wire:model="form.end_date" label="End Date" />
            </div>
            <hr>
            <h4>Select Controls</h4>
            <x-gt-select wire:model="form.country" label="Country (const array)" :options="\App\Models\Widget::COUNTRIES" />
            <div>
                <x-gt-select wire:model="form.related_widget_id" label="Future Date Ranges (self-referencing)" :options="$dateRangeOptions" />
                <p class="mxy-0 txt-sm">Future date ranges for self-referencing relationship test.</p>
            </div>
            <hr>
            <div class="tar">
                <x-gt-button wire:click="cancel" class="btn sm" text="CANCEL" />
                <x-gt-button wire:click="save" class="btn primary sm" text="SAVE" />
            </div>
        </form>
    </x-gt-modal>
    {{-- <pre>{{ json_encode($form, JSON_PRETTY_PRINT) }}</pre> --}}
</div>
