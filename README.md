<p align="center"><a href="https://naykel.com.au" target="_blank"><img src="https://avatars0.githubusercontent.com/u/32632005?s=460&u=d1df6f6e0bf29668f8a4845271e9be8c9b96ed83&v=4" width="120"></a></p>

# NAYKEL Web Application

## Database TODO

Add and explore these indexes to improve query performance:

```php
// In your products migration
$table->index('active');                                    // Fast filtering of active/inactive products
$table->index(['special_start_date', 'special_end_date']); // Fast queries for current specials
```

- **Why**: Without indexes, queries scan every row (slow). With indexes, queries jump directly to relevant rows (fast).
- **Impact**: 100x+ performance improvement on large datasets.
- **Rule**: Index columns you frequently use in `WHERE` clauses and sorting.

## Component Structure and Responsibilities

- `ProductCreateEdit` focuses on form management for individual products.
- `ProductIndex` handles listing and displaying products.
- `ProductFormObject` centralises form-related logic and validation.

1. **`ProductCreateEdit` Component**:
    - **Purpose**: Handles the creation and editing of `Product` models.
    - **Responsibilities**:
        - Manages the `ProductFormObject` form object for creating or editing
          products.
        - Initialises the form with either a new model or a factory-generated
          model.
        - Provides functionality to reset the form.

2. **`ProductIndex` Component**:
    - **Purpose**: Displays a paginated and sortable list of `Product` models.
    - **Responsibilities**:
        - Manages pagination and sorting of the product list.
        - Responds to the `model-saved` event to refresh the component and reset
          pagination.
        - Prepares data for rendering by applying sorting and pagination to the
          `Product` query.

3. **`ProductFormObject` Form Object**:
    - **Purpose**: Encapsulates the form logic and validation for `Product`
      models.
    - **Responsibilities**:
        - Defines and validates form fields such as `title`, `start_date`,
          `end_date`, and `related_product_id`.
        - Initialises the form with a given `Product` model.
        - Provides a method to create a new `Product` model with default or
          provided data.




## Notes

- The trait automatically handles type conversion and prevents duplicate values
  in array filters
- Null and empty string values are ignored during query application
- The trait works with any Laravel Query Builder or Eloquent Builder instance
- Filter state is maintained in the model instance - create new instances for
  different filter sets

<!--  -->
<!--  -->
<!--  -->
<!--  -->




## Complete Example


And the corresponding Blade template:

```html
<div>
    <!-- Filter Controls -->
    <div class="filters mb-4">
        <!-- Search -->
        <input type="text" 
               wire:model.debounce.500ms="filters.name" 
               placeholder="Search products..."
               class="form-input">
        
        <!-- country Filter -->
        <select wire:change="setFilter('country_id', $event.target.value)" class="form-select">
            <option value="">All Categories</option>
            @foreach($categories as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
            @endforeach
        </select>
        
        <!-- Brand Checkboxes -->
        <div class="brand-filters">
            @foreach($brands as $brand)
                <label class="inline-flex items-center">
                    <input type="checkbox" 
                           wire:change="setFilter('brand_id', '{{ $brand->id }}')"
                           {{ in_array($brand->id, (array)($this->filters['brand_id'] ?? [])) ? 'checked' : '' }}>
                    <span class="ml-2">{{ $brand->name }}</span>
                </label>
            @endforeach
        </div>
        
        <!-- Clear Filters -->
        @if(count($this->filters) > 0)
            <button wire:click="clearAllFilters" class="btn btn-secondary">
                Clear All ({{ count($this->filters) }})
            </button>
        @endif
    </div>
    
    <!-- Active Filters Display -->
    @if(count($this->filters) > 0)
        <div class="active-filters mb-4">
            @foreach($this->filters as $key => $value)
                @if(is_array($value))
                    @foreach($value as $item)
                        <span class="filter-tag">
                            {{ $key }}: {{ $item }}
                            <button wire:click="clearFilter('{{ $key }}', '{{ $item }}')" class="ml-1">×</button>
                        </span>
                    @endforeach
                @else
                    <span class="filter-tag">
                        {{ $key }}: {{ $value }}
                        <button wire:click="clearFilter('{{ $key }}')" class="ml-1">×</button>
                    </span>
                @endif
            @endforeach
        </div>
    @endif
    
    <!-- Products Grid -->
    <div class="products-grid">
        @foreach($products as $product)
            <div class="product-card">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->country->name }} - {{ $product->brand->name }}</p>
                <p>${{ $product->price }}</p>
            </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    {{ $products->links() }}
</div>
```










    public function toggleActiveFilter(): void
    {
        $isActive = $this->filters['is_active'] ?? null;
        $this->setFilter('is_active', $isActive ? null : 1);
    }
    // <button wire:click="toggleActiveFilter" class="btn">Toggle Active</button>







## 6. Advanced Example with Multiple Filter Types

**ProductIndex.php:**
```php
public function filterByDateRange($from, $to)
{
    $this->setFilter('date_from', $from);
    $this->setFilter('date_to', $to);
}

protected function applyFilters($query)
{
    foreach ($this->filters as $key => $value) {
        if ($value !== null && $value !== '') {
            switch ($key) {
                case 'search':
                    $query->where('title', 'like', "%{$value}%");
                    break;
                case 'date_from':
                    $query->where('start_date', '>=', $value);
                    break;
                case 'date_to':
                    $query->where('start_date', '<=', $value);
                    break;
                case 'has_content':
                    $query->whereNotNull('content');
                    break;
                default:
                    $query->where($key, $value);
            }
        }
    }
    return $query;
}
```

## 7. URL-Friendly Filters (with queryString)

**ProductIndex.php:**
```php
protected $queryString = ['filters'];

public function mount()
{
    $this->filters = request()->only(['country', 'is_active', 'search']) ?: [];
}
```










        // the cast is not being applied?
        dd($model->price, $model->special_price);

        $this->price = $model->price;
        $this->special_price = $model->special_price;
        // Format as string to preserve decimals for currency display
        // $this->price = number_format($model->price ?? 0, 2, '.', '');