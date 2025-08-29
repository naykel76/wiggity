<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    /**
     * A list of product departments for categorisation. This is for demo
     * purposes to use in filtering and selection. In a real app, this would
     * likely be a separate table with relationships.
     */
    public const DEPARTMENT = [
        'GAD' => 'Gadgets',
        'WID' => 'Widgets',
        'DOO' => 'Doohickeys',
        'WHA' => 'Whatsits',
        'THI' => 'Thingamajigs',
    ];
}
