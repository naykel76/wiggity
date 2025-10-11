
# Efficient Reporting Queries

- [Core Principle](#core-principle)
- [Examples](#examples)
    - [❌ Inefficient (loads everything)](#-inefficient-loads-everything)
    - [✅ Efficient (query-level)](#-efficient-query-level)
    - [✅ Better (single query with aggregates)](#-better-single-query-with-aggregates)
    - [✅ Best (encapsulated in static method)](#-best-encapsulated-in-static-method)
- [Static Helper Methods](#static-helper-methods)
- [Advanced: Working with Relationships](#advanced-working-with-relationships)
    - [Counting Related Records](#counting-related-records)
    - [Conditional Counts on Relationships](#conditional-counts-on-relationships)
    - [Aggregates on Related Data](#aggregates-on-related-data)
    - [Grouped Aggregates](#grouped-aggregates)
    - [Subquery Selects (per-record calculations)](#subquery-selects-per-record-calculations)
    - [Date Range Aggregates](#date-range-aggregates)
    - [Complex Multi-table Stats](#complex-multi-table-stats)
- [Most Common Advanced Scenarios:](#most-common-advanced-scenarios)

## Core Principle

* **Database-level filtering/aggregation:** Let the database do the work.
* **In-memory (collections):** Only when data is already loaded (e.g., `$users = User::all()`).

## Examples

### ❌ Inefficient (loads everything)

```php +torchlight-php
$users = User::all();
$total = $users->count();
$unverified = $users->whereNull('email_verified_at')->count();
```

**Why bad:** Can Load thousands or even millions of records, not just to count them.

### ✅ Efficient (query-level)

```php +torchlight-php
$total = User::count();
$unverified = User::whereNull('email_verified_at')->count();
```

**Yes**, this runs two queries, but that's efficient! Each query returns only a
single number, not full records.

### ✅ Better (single query with aggregates)

```php +torchlight-php
$userStats = DB::table('users')
    ->selectRaw('
        COUNT(*) as total,
        COUNT(CASE WHEN email_verified_at IS NULL THEN 1 END) as unverified,
        COUNT(CASE WHEN email_verified_at IS NOT NULL THEN 1 END) as verified
    ')
    ->first();

// Access: $userStats->total, $userStats->unverified, $userStats->verified
```

**Why better:** Single query, ideal for dashboards or reports.



### ✅ Best (encapsulated in static method)

```php +torchlight-php
// In User.php model
public static function getUserStats()
{
    return DB::table('users')
        ->selectRaw('
            COUNT(*) as total,
            COUNT(CASE WHEN email_verified_at IS NULL THEN 1 END) as unverified,
            COUNT(CASE WHEN email_verified_at IS NOT NULL THEN 1 END) as verified
        ')
        ->first();
}

// Usage - clean and reusable
$userStats = User::getUserStats();

$userStats->total;      // Total users
$userStats->unverified; // Unverified users
$userStats->verified;   // Verified users
```

**Why best:** Combines performance with clean, reusable code.

## Static Helper Methods

If you want a clean API for your reports:

```php +torchlight-php
public static function totalUnverified()
{
    return static::whereNull('email_verified_at')->count();
}

// Usage
$totalUnverified = User::totalUnverified();
```

---
---
---
---
---
---
---
---
---
---
---
---
---
---
---
---


Great! Here are some advanced examples you'll likely need:

## Advanced: Working with Relationships

### Counting Related Records

```php +torchlight-php
// Get users with their order counts (single query with JOIN)
$users = User::withCount('orders')->get();
foreach ($users as $user) {
    echo $user->orders_count;
}

// Total orders across all users
$totalOrders = Order::count();

// Orders for active users only
$totalOrders = DB::table('orders')
    ->join('users', 'users.id', '=', 'orders.user_id')
    ->where('users.status', 'active')
    ->count();
```

### Conditional Counts on Relationships

```php +torchlight-php
// Count orders by status
$users = User::withCount([
    'orders',
    'orders as completed_orders_count' => fn($q) => $q->where('status', 'completed'),
    'orders as pending_orders_count' => fn($q) => $q->where('status', 'pending'),
])->get();
```

### Aggregates on Related Data

```php +torchlight-php
// Total revenue across all orders
$totalRevenue = Order::sum('total');

// Revenue from active users only
$activeUserRevenue = DB::table('orders')
    ->join('users', 'users.id', '=', 'orders.user_id')
    ->where('users.status', 'active')
    ->sum('orders.total');
```

### Grouped Aggregates

```php +torchlight-php
// Order count per user
$orderCounts = DB::table('orders')
    ->select('user_id', DB::raw('COUNT(*) as order_count'))
    ->groupBy('user_id')
    ->get();

// Revenue by month
$monthlyRevenue = DB::table('orders')
    ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, SUM(total) as revenue')
    ->groupBy('month')
    ->orderBy('month')
    ->get();

// Stats per user (multiple aggregates)
$userStats = DB::table('orders')
    ->select('user_id')
    ->selectRaw('COUNT(*) as order_count')
    ->selectRaw('SUM(total) as total_spent')
    ->selectRaw('AVG(total) as avg_order_value')
    ->groupBy('user_id')
    ->get();
```

### Subquery Selects (per-record calculations)

```php +torchlight-php
$users = User::select('users.*')
    ->selectSub(
        fn($q) => $q->selectRaw('COUNT(*)')
            ->from('orders')
            ->whereColumn('orders.user_id', 'users.id'),
        'orders_count'
    )
    ->selectSub(
        fn($q) => $q->selectRaw('SUM(total)')
            ->from('orders')
            ->whereColumn('orders.user_id', 'users.id'),
        'total_spent'
    )
    ->get();
```

### Date Range Aggregates

```php +torchlight-php
// Revenue stats for a date range
public static function getRevenueStats($startDate, $endDate)
{
    return DB::table('orders')
        ->whereBetween('created_at', [$startDate, $endDate])
        ->selectRaw('
            COUNT(*) as total_orders,
            SUM(total) as total_revenue,
            AVG(total) as avg_order_value,
            COUNT(DISTINCT user_id) as unique_customers
        ')
        ->first();
}
```

### Complex Multi-table Stats

```php +torchlight-php
public static function getDashboardStats()
{
    return DB::table('users')
        ->selectRaw('
            (SELECT COUNT(*) FROM users) as total_users,
            (SELECT COUNT(*) FROM orders WHERE DATE(created_at) = CURDATE()) as orders_today,
            (SELECT SUM(total) FROM orders WHERE DATE(created_at) = CURDATE()) as revenue_today,
            (SELECT COUNT(DISTINCT user_id) FROM orders WHERE created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY)) as active_users
        ')
        ->first();
}
```

---

## Most Common Advanced Scenarios:

1. **withCount()** - Counting related records without N+1
2. **Grouped aggregates** - Stats by user/category/time period
3. **Date-based reporting** - Daily/weekly/monthly stats
4. **Multi-table joins** - Aggregates across relationships
5. **Conditional counts** - Count with WHERE conditions on relationships
6. **Subquery selects** - Complex per-record calculations

Would you like me to create a full "Advanced Examples" section for your document
with any of these?
