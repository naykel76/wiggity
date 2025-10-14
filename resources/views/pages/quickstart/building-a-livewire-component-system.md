# Building a Livewire Component System

- [Initial Setup](#initial-setup)
    - [1. Create Livewire Components](#1-create-livewire-components)
    - [2. Add Route and Update Navigation (optional)](#2-add-route-and-update-navigation-optional)
- [Component Implementation](#component-implementation)
    - [`Index`](#index)
    - [`CreateEdit`](#createedit)
    - [`ProductFormObject`](#productformobject)


## Initial Setup

### 1. Create Livewire Components
```bash +torchlight-bash
php artisan livewire:make Products/Index --pest
php artisan livewire:make Products/CreateEdit --pest
php artisan livewire:form ProductFormObject
```

### 2. Add Route and Update Navigation (optional)
```php +torchlight-php
use App\Livewire\Products\Index as ProductIndex;

Route::prefix('admin')->name('admin')->group(function () {
    Route::get('/products', ProductIndex::class)->name('.products.index');
});
```

```json +torchlight-json
{
    "name": "Product",
    "route_name": "admin.products.index",
    "exclude_route": true
}
```

## Component Implementation

### `Index`

- [ ] Edit button 
- [ ] Filters
    - [ ] Date range
- [ ] Export button
- [ ] Searchable columns
- [ ] Sorting
- [ ] Pagination

### `CreateEdit`

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



