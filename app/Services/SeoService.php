<?php

namespace App\Services;

use App\Models\SeoMeta;

class SeoService
{
    public function getForPage(string $pageSlug): ?SeoMeta
    {
        return SeoMeta::where('page_slug', $pageSlug)->first();
    }

    public function renderMeta(string $pageSlug): array
    {
        $seo = $this->getForPage($pageSlug);

        if (!$seo) {
            return [
                'title' => config('app.name'),
                'meta' => [],
            ];
        }

        $locale = app()->getLocale();
        $title = $locale === 'ar' ? $seo->meta_title_ar : $seo->meta_title_en;
        $description = $locale === 'ar' ? $seo->meta_description_ar : $seo->meta_description_en;
        $keywords = $locale === 'ar' ? $seo->meta_keywords_ar : $seo->meta_keywords_en;
        $ogTitle = $locale === 'ar' ? ($seo->og_title_ar ?? $title) : ($seo->og_title_en ?? $title);
        $ogDesc = $locale === 'ar' ? ($seo->og_description_ar ?? $description) : ($seo->og_description_en ?? $description);

        return [
            'title' => $title ?? config('app.name'),
            'meta' => array_filter([
                'description' => $description,
                'keywords' => $keywords,
                'robots' => $seo->robots,
            ]),
            'og' => array_filter([
                'title' => $ogTitle,
                'description' => $ogDesc,
                'image' => $seo->og_image ? asset('storage/' . $seo->og_image) : null,
            ]),
            'canonical' => $seo->canonical_url,
            'schema' => $seo->schema_markup,
        ];
    }
}
