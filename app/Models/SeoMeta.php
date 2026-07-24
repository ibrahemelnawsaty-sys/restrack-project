<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    protected $table = 'seo_meta';

    protected $fillable = [
        'page_slug', 'meta_title_ar', 'meta_title_en',
        'meta_description_ar', 'meta_description_en',
        'meta_keywords_ar', 'meta_keywords_en',
        'og_title_ar', 'og_title_en', 'og_description_ar', 'og_description_en',
        'og_image', 'canonical_url', 'robots', 'schema_markup',
    ];

    protected function casts(): array
    {
        return [
            'schema_markup' => 'array',
        ];
    }

    public function getMetaTitleAttribute(): ?string
    {
        return app()->getLocale() === 'ar' ? $this->meta_title_ar : $this->meta_title_en;
    }

    public function getMetaDescriptionAttribute(): ?string
    {
        return app()->getLocale() === 'ar' ? $this->meta_description_ar : $this->meta_description_en;
    }
}
