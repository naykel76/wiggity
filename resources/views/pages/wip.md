# TL;DR Guide to Add a New Livewire Resource 

## Initial Setup

### 1. Create Livewire Components
```bash +torchlight-bash
php artisan livewire:make Widget/Index
php artisan livewire:make Widget/CreateEdit
php artisan livewire:form WidgetFormObject
```

### 2. Add Route
```php +torchlight-php
use App\Livewire\Widget\WidgetIndex;

Route::get('/admin/widgets', WidgetIndex::class)
    ->name('admin.widgets.index');
```

### 3. Update Navigation

688

```json +torchlight-json
{
    "name": "Widget",
    "route_name": "admin.widgets.index"
}
```

## Component Implementation

### `WidgetIndex`


Add edit button 

### `WidgetCreateEdit`

`gtl:form-class` command scaffolds this basic functionality.

1. Add `WithFormActions` trait to handle form actions.
2. Add `WidgetFormObject` for form fields and validation.


Make sure you set perPage in pagination if using pagination.


**View**

add modal
add form
buttons

```php +torchlight-php
<x-gt-button wire:click="$dispatchTo('product-create-edit', 'create-model')" text="Create" />
```

### `WidgetFormObject`



**Using**

- Index will likely be a full-page component so this is handled in the route.
- When `CreateEdit` component is separate component and used in a modal att the
  component to the index page