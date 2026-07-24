<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Speaker extends Model
{
    protected $fillable = [
        'name_ar', 'name_en', 'slug', 'title_ar', 'title_en',
        'specialization_ar', 'specialization_en', 'bio_ar', 'bio_en',
        'short_bio_ar', 'short_bio_en', 'photo', 'cover_photo',
        'email', 'phone', 'achievements', 'qualifications', 'social_links',
        'affiliated_institutions', 'years_of_experience', 'display_order',
        'is_featured', 'is_visible', 'meta_title', 'meta_description',
    ];

    protected function casts(): array
    {
        return [
            'achievements' => 'array',
            'qualifications' => 'array',
            'social_links' => 'array',
            'affiliated_institutions' => 'array',
            'is_featured' => 'boolean',
            'is_visible' => 'boolean',
        ];
    }

    public function lectures(): HasMany
    {
        return $this->hasMany(Lecture::class);
    }

    public function getNameAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->name_ar : $this->name_en;
    }

    public function getTitleAttribute(): string
    {
        return app()->getLocale() === 'ar' ? $this->title_ar : $this->title_en;
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }
}
