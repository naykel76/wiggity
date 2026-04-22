<?php

use App\Livewire\Forms\WidgetFormObject;
use App\Models\Widget;
use Livewire\WithFileUploads;
use Naykel\Gotime\Livewire\BaseForm;

new class extends BaseForm
{
    use WithFileUploads;

    public WidgetFormObject $form;

    protected string $modelClass = Widget::class;

    public string $createTitle = 'Create Widget';
    public string $editTitlePrefix = 'Edit';
    public ?string $titleField = 'name';

    protected function configKey(): string
    {
        return 'widget';
    }
};
?>

<x-gt-modal wire:model="showModal">
    <h4>{{ $this->formTitle() }}</h4>
    <form >
        <x-gt-input label="Name" wire:model="form.name" />
        <x-gt-input label="Code" wire:model="form.code" />
        <img src="{{ $this->imageUrl() }}" alt="{{ $form->name ?? null }}">
        <x-gt-filepond wire:model="form.tmpUpload" />
        <hr>
        <div class="tar">
            <x-gt-button wire:click="save" class="btn primary sm" text="SAVE" />
            <x-gt-button wire:click="saveAndClose" class="btn primary sm" text="SAVE & CLOSE" />
            <x-gt-button wire:click="cancel" class="btn sm" text="CANCEL" />
        </div>
    </form>
</x-gt-modal>
F