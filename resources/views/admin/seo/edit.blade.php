@extends('layouts.admin')
@section('title', __('general.edit') . ' SEO: ' . $pageSlug)
@section('page-title', __('general.edit') . ' SEO: ' . $pageSlug)
@section('content')
<div class="mx-auto max-w-2xl">
    <form method="POST" action="{{ route('admin.seo.update', $pageSlug) }}" enctype="multipart/form-data" class="space-y-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf @method('PUT')
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">Meta Title (AR)</label><input type="text" name="meta_title_ar" value="{{ old('meta_title_ar', $seo->meta_title_ar) }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
            <div><label class="block text-sm font-medium text-gray-700">Meta Title (EN)</label><input type="text" name="meta_title_en" value="{{ old('meta_title_en', $seo->meta_title_en) }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">Meta Description (AR)</label><textarea name="meta_description_ar" rows="3" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('meta_description_ar', $seo->meta_description_ar) }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700">Meta Description (EN)</label><textarea name="meta_description_en" rows="3" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('meta_description_en', $seo->meta_description_en) }}</textarea></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">Meta Keywords (AR)</label><input type="text" name="meta_keywords_ar" value="{{ old('meta_keywords_ar', $seo->meta_keywords_ar) }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
            <div><label class="block text-sm font-medium text-gray-700">Meta Keywords (EN)</label><input type="text" name="meta_keywords_en" value="{{ old('meta_keywords_en', $seo->meta_keywords_en) }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">OG Image</label>
            @if($seo->og_image)<img src="{{ asset('storage/' . $seo->og_image) }}" alt="" class="mb-2 h-20 rounded object-cover">@endif
            <input type="file" name="og_image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-lg file:border-0 file:bg-navy/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-navy hover:file:bg-navy/20">
        </div>
        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.update') }}</button>
            <a href="{{ route('admin.seo.index') }}" class="rounded-lg border border-gray-300 px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">{{ __('general.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
