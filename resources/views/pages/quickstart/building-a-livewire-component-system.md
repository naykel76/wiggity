# Building a Livewire Component System

- [Initial Setup](#initial-setup)
    - [1. Create Livewire Components](#1-create-livewire-components)
    - [2. Add Route and Update Navigation (optional)](#2-add-route-and-update-navigation-optional)
- [Component Implementation](#component-implementation)
    - [`ProductIndex`](#productindex)
    - [`ProductCreateEdit`](#productcreateedit)
    - [`ProductFormObject`](#productformobject)


## Initial Setup

### 1. Create Livewire Components
```bash +torchlight-bash
php artisan livewire:make Products/Index
php artisan livewire:make Products/CreateEdit
php artisan livewire:form ProductFormObject
```

### 2. Add Route and Update Navigation (optional)
```php +torchlight-php
use App\Livewire\Product\Index as ProductIndex;

Route::prefix('admin')->name('admin')->group(function () {
    Route::get('/products', ProductIndex::class)->name('.products.index');
});
```

```json +torchlight-json
{
    "name": "Product",
    "route_name": "admin.products.index"
}
```

## Component Implementation

### `ProductIndex`


Add edit button 

### `ProductCreateEdit`

`gtl:form-class` command scaffolds this basic functionality.

1. Add `WithFormActions` trait to handle form actions.
2. Add `ProductFormObject` for form fields and validation.


Make sure you set perPage in pagination if using pagination.


**View**

add modal
add form
buttons

```php +torchlight-php
<x-gt-button wire:click="$dispatchTo('product-create-edit', 'create-model')" text="Create" />
```

### `ProductFormObject`



**Using**

- Index will likely be a full-page component so this is handled in the route.
- When `CreateEdit` component is separate component and used in a modal att the
  component to the index page