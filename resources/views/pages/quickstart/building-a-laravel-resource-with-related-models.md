# Building a Laravel Resource with Related Models

- [Phase 1: Scaffold the Resource](#phase-1-scaffold-the-resource)
- [Phase 2: Configure Models, Migration and Relationships](#phase-2-configure-models-migration-and-relationships)
    - [Update Migrations](#update-migrations)
    - [Define Relationships](#define-relationships)
    - [Configure Factories](#configure-factories)
- [Phase 3: Define Routes](#phase-3-define-routes)
- [Phase 4: Implement Controller Logic](#phase-4-implement-controller-logic)
- [Phase 5: Create Views](#phase-5-create-views)
    - [Generate View Files](#generate-view-files)

## Phase 1: Scaffold the Resource

**Focus:** Generate all necessary files using Artisan commands.

```bash +torchlight-bash
pa make:model Product -mfc -r    # main resource with controller
pa make:model ProductDetail -mf  # related model
```

## Phase 2: Configure Models, Migration and Relationships

* [ ] Define migration schema
* [ ] Configure factory with fake data
* [ ] Add `$fillable` (or `$guarded`) in model
* [ ] Run migration

### Update Migrations

```php +torchlight-php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->timestamps();
    // other fields...
});
```

```php +torchlight-php
Schema::create('product_details', function (Blueprint $table) {
    $table->id();
    $table->foreignId('product_id')->constrained()->onDelete('cascade');
    $table->timestamps();
    // other fields...
});
```

### Define Relationships

* [ ] Define relationship in base model (`hasOne`)
* [ ] Define inverse relationship in related model (`belongsTo`)

```php +torchlight-php
class Product extends Model
{
    public function productDetail()
    {
        return $this->hasOne(ProductDetail::class);
    }
}
```

```php +torchlight-php
class ProductDetail extends Model
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
```


### Configure Factories

**ProductFactory:**

```php +torchlight-php
public function definition()
{
    return [
        'name' => fake()->sentence(random_int(3, 10)),
        // other fields...
    ];
}
```

**ProductDetailFactory:**

```php +torchlight-php
public function definition()
{
    return [
        'product_id' => Product::factory(),
        'description' => fake()->paragraphs(random_int(1, 5), true),
        // other fields...
    ];
}
```

## Phase 3: Define Routes

**routes/web.php:**

```php +torchlight-php
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);
```

**Generated routes:**
- `GET /products` → index
- `GET /products/create` → create
- `POST /products` → store
- `GET /products/{product}` → show
- `GET /products/{product}/edit` → edit
- `PUT/PATCH /products/{product}` → update
- `DELETE /products/{product}` → destroy

## Phase 4: Implement Controller Logic

* [ ] Implement `index()` - list all
* [ ] Implement `create()` - show form
* [ ] Implement `store()` - save new
* [ ] Implement `show()` - display single
* [ ] Implement `edit()` - show edit form
* [ ] Implement `update()` - save changes
* [ ] Implement `destroy()` - delete

## Phase 5: Create Views

### Generate View Files
```bash +torchlight-bash
php artisan make:view products/index
php artisan make:view products/create
php artisan make:view products/edit
php artisan make:view products/show
```

**Or using PowerShell:**
```powershell +torchlight-powershell
'index','create','edit','show' | ForEach-Object { php artisan make:view "products/$_" }
```

**resources/views/products/index.blade.php** - List all products with details
**resources/views/products/create.blade.php** - Form to create product + detail
**resources/views/products/edit.blade.php** - Form to edit product + detail
**resources/views/products/show.blade.php** - Display single product with detail





