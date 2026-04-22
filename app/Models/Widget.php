<?php

namespace App\Models;

use Database\Factories\WidgetFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Widget extends Model
{
    /** @use HasFactory<WidgetFactory> */
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'extra_data' => 'array',
        'is_active' => 'boolean',
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
        'expired_at' => 'datetime',
        'published_at' => 'datetime',
        'released_at' => 'datetime',
    ];

    // ======================================================================
    // -- Accessors & Mutators --
    // ======================================================================

    // ======================================================================
    // -- Relationships --
    // ======================================================================

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Widget::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Widget::class, 'parent_id');
    }

    // ======================================================================
    // -- Statuses --
    // ======================================================================

    // ======================================================================
    // -- Query Scopes --
    // ======================================================================

    // ======================================================================
    // -- Methods --
    // ======================================================================

}
