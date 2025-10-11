<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

apply fix
git cherry-pick 716a09d

# NAYKEL Web Application

Add lazy loading to each component


The root parent component (`Page`) holds the state and passes it down to child
components (`Table`, `CreateEdit`).

## Livewire Admin Products Page

### 1. Create Livewire components
```bash +torchlight-bash
pa livewire:make Products/Page 
pa livewire:make Products/Table 
pa livewire:make Products/CreateEdit 
```

### 2. Add route for admin products page
```php
use App\Livewire\Products\Page;
Route::get('/admin/products', Page::class)->name('admin.products.index');
```

### 3. Add to nav-main.json
```json
{
    "name": "Products",
    "route_name": "admin.products.index",
    "exclude_route": true
}
```

## Update Livewire Components

### `Products/Page`

* Define a public property to store the data collection.
* Specify the layout in the render method.
* Use a query string to retrieve the data.

Add table to view and pass data to table component.

<livewire:products.table :$products />

### `Products/Table`


### `Products/CreateEdit`





Initial setup for livewire products management with single page table, sorting and export functionality.