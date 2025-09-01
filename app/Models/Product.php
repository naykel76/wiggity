<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Naykel\Gotime\Casts\FloatAsInteger;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $casts = [
        'price' => FloatAsInteger::class . ':2',
        'special_price' => FloatAsInteger::class . ':2',
    ];

    /**
     * A list of product departments for categorisation. This is for demo
     * purposes to use in filtering and selection. In a real app, this would
     * likely be a separate table with relationships.
     */
    public const DEPARTMENTS = [
        'GAD' => 'Gadgets',
        'WID' => 'Widgets',
        'DOO' => 'Doohickeys',
        'WHA' => 'Whatsits',
        'THI' => 'Thingamajigs',
    ];
}
