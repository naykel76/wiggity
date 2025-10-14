<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Naykel\Gotime\Traits\HasFormattedDates;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, HasFormattedDates;

    /**
     * A list of product departments for categorisation. This is for demo
     * purposes to use in filtering and selection. In a real app, this would
     * likely be a separate table with relationships.
     */
    public const DEPARTMENTS = [
        'GAD' => 'Gadgets',
        'WID' => 'Products',
        'DOO' => 'Doohickeys',
        'WHA' => 'Whatsits',
        'THI' => 'Thingamajigs',
    ];
}
