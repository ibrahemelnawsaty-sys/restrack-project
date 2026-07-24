<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'type', 'title_ar', 'title_en', 'body_ar', 'body_en',
        'link_url', 'link_text_ar', 'link_text_en', 'image',
        'bg_color', 'text_color', 'is_active', 'is_dismissible',
        'starts_at', 'ends_at', 'display_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_dismissible' => 'boolean',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'display_order' => 'integer',
        ];
    }

    public function getTitleAttribute(): ?string
    {
        return app()->getLocale() === 'ar' ? $this->title_ar : $this->title_en;
    }

    public function getBodyAttribute(): ?string
    {
        return app()->getLocale() === 'ar' ? $this->body_ar : $this->body_en;
    }

    public function getLinkTextAttribute(): ?string
    {
        return app()->getLocale() === 'ar' ? $this->link_text_ar : $this->link_text_en;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', now());
            });
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }
}
