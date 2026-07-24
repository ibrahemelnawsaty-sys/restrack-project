<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'page_slug', 'section_key', 'title_ar', 'title_en',
        'subtitle_ar', 'subtitle_en', 'content_ar', 'content_en',
        'image', 'background_image', 'cta_text_ar', 'cta_text_en',
        'cta_url', 'extra_data', 'display_order', 'is_visible', 'updated_by',
    ];

    protected function casts(): array
    {
        return [
            'extra_data' => 'array',
            'is_visible' => 'boolean',
        ];
    }

    public function getTitleAttribute(): ?string
    {
        return app()->getLocale() === 'ar' ? $this->title_ar : $this->title_en;
    }

    public function getSubtitleAttribute(): ?string
    {
        return app()->getLocale() === 'ar' ? $this->subtitle_ar : $this->subtitle_en;
    }

    public function getContentAttribute(): ?string
    {
        return app()->getLocale() === 'ar' ? $this->content_ar : $this->content_en;
    }

    public function getCtaTextAttribute(): ?string
    {
        return app()->getLocale() === 'ar' ? $this->cta_text_ar : $this->cta_text_en;
    }

    public function scopeForPage($query, string $pageSlug)
    {
        return $query->where('page_slug', $pageSlug)->where('is_visible', true)->orderBy('display_order');
    }
}
