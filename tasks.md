## Task Summary

**Goal:** Convert between integer (cents) in the database and float (dollars) in
Laravel Livewire application.

**Requirements:**
- Use (modern) mutators or custom casts in the model
- Support nullable columns
- Display with two decimal places in forms

Preferred Approach:
- Database: `integer` column (nullable)
- Prefer to define as `?float` in Livewire components 
- Validation: `nullable|numeric|min:0|max:999999.99`
- Handle string, float, and integer inputs




**Problem:** I am having a tough time working with data types in livewire.

1. Should I type hint data types in livewire components or is it better to
   leave as untyped? 


2. When working with numbers is it common to convert to string? For example, I
   need convert between integer (cents) in the database and float (dollars) in
   Laravel Livewire application.

   
   I will extend this question to mutators and casts in the model. Are these correct?

    public function get(Model $model, string $key, mixed $value, array $attributes): ?float
    {
       return $value === null ? null : round($value / 100, 2);
    }

    public function set(Model $model, string $key, mixed $value, array $attributes): ?int
    {
        return $value === null ? null : (int) round((float) $value * 100);
    }



ProductDetail.php (Model)
Create a ono-to-one relationship and:

Create 


Split Product