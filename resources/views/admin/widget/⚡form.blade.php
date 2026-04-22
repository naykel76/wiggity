<?php

use App\Livewire\Forms\WidgetFormObject;
use App\Models\Widget;
use Naykel\Gotime\Livewire\BaseForm;

new class extends BaseForm
{
    public WidgetFormObject $form;

    protected string $modelClass = Widget::class;

    protected function configKey(): string
    {
        return 'widget';
    }

    
    public function mount(?Widget $widget): void
    {
        $this->initForm($widget ?? new Widget);
    }
};
?>

<div>
     <div class="my flex va-c space-x-1">
        <x-gt-button.primary wire:click="saveAndEdit" wire:dirty.attr.remove="disabled" text="Save Changes" disabled />
        <a href="{{ route($routePrefix . '.index') }}" class="btn dark">Back to list</a>
        <div wire:dirty class="txt-red">Unsaved changes...</div>
    </div>
    <form wire:submit="save">
        <x-gt-input label="Name" wire:model="form.name" />
        <x-gt-input label="Code" wire:model="form.code" />
        <x-gt-input label="Headline" wire:model="form.headline" />
        <x-gt-textarea label="Overview" wire:model="form.overview" />
        <x-gt-toggle label="Active" wire:model="form.is_active" />
        <x-gt-input label="Status" wire:model="form.status" />
    </form>
</div>
