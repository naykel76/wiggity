# Events

## Livewire

### Dispatch from Blade View

```html +torchlight-blade
@verbatim
<button wire:click="$dispatch('event-name', { id: {{ $model->id }} })"> Dispatch Event </button>
@endverbatim
```