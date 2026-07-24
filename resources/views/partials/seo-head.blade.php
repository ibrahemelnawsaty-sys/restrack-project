{{-- Automatic SEO head fragment. @include inside the public <head>. Emits meta/canonical/hreflang/OG/Twitter/JSON-LD — never a <title>. --}}
@php
    $seoSlug = $seoSlug ?? (request()->routeIs('home') ? 'home' : (request()->routeIs('speakers*') ? 'speakers' : (request()->routeIs('contact') ? 'contact' : 'home')));
    $data = app(\App\Services\SeoService::class)->renderMeta($seoSlug);
    $locale = app()->getLocale();
    $siteName = 'Restrack';
    $desc = $data['meta']['description'] ?? ($locale === 'ar'
        ? 'منصة ريستراك لتعليم البحث الطبي — من المبتدئ إلى الخبير، بمحاضرات مسجّلة وشهادات موثّقة.'
        : 'Restrack — master medical research from beginner to expert, with recorded lectures and verified certificates.');

    $canonical = $data['canonical'] ?? url()->current();
    $robots = $data['meta']['robots'] ?? 'index, follow';
    $keywords = $data['meta']['keywords'] ?? null;

    $ogTitle = $data['og']['title'] ?? $siteName;
    $ogDesc = $data['og']['description'] ?? $desc;
    $ogImage = $data['og']['image'] ?? null;
    $ogLocale = $locale === 'ar' ? 'ar_SA' : 'en_US';

    // Non-empty social links → schema sameAs.
    $sameAs = array_values(array_filter([
        optional($siteSettings->get('social_twitter'))->value ?? null,
        optional($siteSettings->get('social_linkedin'))->value ?? null,
        optional($siteSettings->get('social_instagram'))->value ?? null,
        optional($siteSettings->get('social_youtube'))->value ?? null,
    ]));

    $orgSchema = array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'EducationalOrganization',
        'name' => $siteName,
        'url' => config('app.url'),
        'description' => $desc,
        'sameAs' => $sameAs ?: null,
    ]);

    $websiteSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        'name' => $siteName,
        'url' => config('app.url'),
        'inLanguage' => ['ar', 'en'],
    ];

    $pageSchema = (isset($data['schema']) && is_array($data['schema']) && !empty($data['schema'])) ? $data['schema'] : null;
@endphp
<meta name="description" content="{{ $desc }}">
@if($keywords)
<meta name="keywords" content="{{ $keywords }}">
@endif
<meta name="robots" content="{{ $robots }}">
<link rel="canonical" href="{{ $canonical }}">
<link rel="alternate" hreflang="ar" href="{{ request()->fullUrlWithQuery(['lang' => 'ar']) }}">
<link rel="alternate" hreflang="en" href="{{ request()->fullUrlWithQuery(['lang' => 'en']) }}">
<link rel="alternate" hreflang="x-default" href="{{ url()->current() }}">
<meta property="og:type" content="website">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="{{ $ogLocale }}">
<meta property="og:title" content="{{ $ogTitle }}">
<meta property="og:description" content="{{ $ogDesc }}">
<meta property="og:url" content="{{ url()->current() }}">
@if($ogImage)
<meta property="og:image" content="{{ $ogImage }}">
@endif
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $ogTitle }}">
<meta name="twitter:description" content="{{ $ogDesc }}">
@if($ogImage)
<meta name="twitter:image" content="{{ $ogImage }}">
@endif
<script type="application/ld+json">{!! json_encode($orgSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
<script type="application/ld+json">{!! json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@if($pageSchema)
<script type="application/ld+json">{!! json_encode($pageSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
@endif
