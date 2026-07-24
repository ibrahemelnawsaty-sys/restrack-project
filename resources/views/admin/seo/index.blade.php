@extends('layouts.admin')
@section('title', __('general.seo'))
@section('page-title', __('general.seo'))
@section('content')
<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50"><tr>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.page') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">Meta Title</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">Meta Description</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.actions') }}</th>
            </tr></thead>
            <tbody class="divide-y divide-gray-100">
            @forelse($pages as $seo)
                <tr>
                    <td class="px-4 py-3 font-medium text-navy">{{ $seo->page_slug }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ Str::limit($seo->meta_title_en ?? $seo->meta_title_ar, 40) }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ Str::limit($seo->meta_description_en ?? $seo->meta_description_ar, 50) }}</td>
                    <td class="px-4 py-3"><a href="{{ route('admin.seo.edit', $seo->page_slug) }}" class="text-navy hover:text-gold">{{ __('general.edit') }}</a></td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-8 text-center text-gray-400">{{ __('general.no_data') }}</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
