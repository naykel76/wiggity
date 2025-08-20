<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Widget extends Model
{
    /** @use HasFactory<\Database\Factories\WidgetFactory> */
    use HasFactory;

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    const COUNTRIES = [
        'AU' => 'Australia',
        'CA' => 'Canada',
        'NZ' => 'New Zealand',
        'UK' => 'United Kingdom',
        'US' => 'United States',
    ];

    /**
     * Set the related widget ID, converting empty strings to null.
     */
    protected function relatedWidgetId(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value === '' ? null : $value,
        );
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    |
    | Here you may specify ...
    |
    */

    /**
     * Defines a self-referential relationship to another widget.
     */
    public function relatedWidget()
    {
        return $this->belongsTo(self::class, 'related_widget_id');
    }

    /*
    |--------------------------------------------------------------------------
    | STATUSES
    |--------------------------------------------------------------------------
    |
    | Here you may specify ...
    |
    */

    /*
    |--------------------------------------------------------------------------
    | QUERY SCOPES
    |--------------------------------------------------------------------------
    |
    | Here you may specify ...
    |
    */
    public function scopeFuture($query)
    {
        return $query
            ->whereFuture('start_date')
            ->orderBy('start_date', 'asc');
    }

    /*
    |--------------------------------------------------------------------------
    | HELPER METHODS
    |--------------------------------------------------------------------------
    |
    | Here you may specify ...
    |
    */

    /**
     * Get formatted date range options for dropdown/select inputs
     *
     * @return array ['id' => 'start_date - end_date']
     */
    public static function getDateRangeOptions(): array
    {
        return self::future()
            ->get(['id', 'start_date', 'end_date'])
            ->mapWithKeys(function ($widget) {
                return [$widget->id => "$widget->start_date"];
                // $startDate = $widget->start_date->format('jS \o\f F Y');
                // $endDate = $widget->end_date->format('jS \o\f F Y');
                // return [$widget->id => "$startDate - $endDate"];
            })->toArray();
    }
}
