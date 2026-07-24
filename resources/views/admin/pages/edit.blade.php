@extends('layouts.admin')
@section('title', __('general.edit_page') . ': ' . $pageSlug)
@section('page-title', __('general.edit_page') . ': ' . $pageSlug)
@section('content')
<div class="mx-auto max-w-3xl">
    <form method="POST" action="{{ route('admin.pages.update', $pageSlug) }}" class="space-y-6">
        @csrf @method('PUT')
        @forelse($sections as $i => $section)
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-sm font-bold text-navy">{{ $section->section_key }}</h3>
                <span class="rounded bg-gray-100 px-2 py-0.5 text-xs text-gray-500">{{ __('general.order') }}: {{ $section->display_order }}</span>
            </div>
            <input type="hidden" name="sections[{{ $i }}][section_key]" value="{{ $section->section_key }}">
            <input type="hidden" name="sections[{{ $i }}][page_slug]" value="{{ $pageSlug }}">
            <div class="grid gap-4 sm:grid-cols-2">
                <div><label class="block text-sm font-medium text-gray-700">{{ __('general.title') }} (AR)</label><input type="text" name="sections[{{ $i }}][title_ar]" value="{{ old('sections.'.$i.'.title_ar', $section->title_ar) }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
                <div><label class="block text-sm font-medium text-gray-700">{{ __('general.title') }} (EN)</label><input type="text" name="sections[{{ $i }}][title_en]" value="{{ old('sections.'.$i.'.title_en', $section->title_en) }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
            </div>
            <div class="mt-4 grid gap-4 sm:grid-cols-2">
                <div><label class="block text-sm font-medium text-gray-700">{{ __('general.content') }} (AR)</label><textarea name="sections[{{ $i }}][content_ar]" rows="4" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('sections.'.$i.'.content_ar', $section->content_ar) }}</textarea></div>
                <div><label class="block text-sm font-medium text-gray-700">{{ __('general.content') }} (EN)</label><textarea name="sections[{{ $i }}][content_en]" rows="4" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('sections.'.$i.'.content_en', $section->content_en) }}</textarea></div>
            </div>
            <div class="mt-4"><label class="block text-sm font-medium text-gray-700">{{ __('general.order') }}</label><input type="number" name="sections[{{ $i }}][display_order]" value="{{ old('sections.'.$i.'.display_order', $section->display_order) }}" min="0" class="mt-1 block w-32 rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        @empty
        <div class="rounded-xl border border-gray-200 bg-white p-8 text-center text-gray-400">{{ __('general.no_data') }}</div>
        @endforelse
        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.save') }}</button>
        </div>
    </form>
</div>
@endsection
