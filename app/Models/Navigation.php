<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Navigation extends Model
{
    protected $fillable = [
        'location', 'parent_id', 'label_ar', 'label_en',
        'url', 'target', 'icon', 'display_order', 'is_visible',
    ];

    protected function casts(): array
    {
        return [
            'is_visible' => 'boolean',
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Navigation::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Navigation::class, 'parent_id')->orderBy('display_order');
    }

    public function getLabelAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->label_ar : $this->label_en;
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeByLocation($query, string $location)
    {
        return $query->where('location', $location)->whereNull('parent_id')->orderBy('display_order');
    }
}
