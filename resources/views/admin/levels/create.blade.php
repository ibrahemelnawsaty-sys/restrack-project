@extends('layouts.admin')
@section('title', __('general.add_new') . ' ' . __('general.level'))
@section('page-title', __('general.add_new') . ' ' . __('general.level'))

@section('content')
<div class="mx-auto max-w-2xl">
    <form method="POST" action="{{ route('admin.levels.store') }}" class="space-y-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('general.title') }} (AR)</label>
                <input type="text" name="title_ar" value="{{ old('title_ar') }}" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                @error('title_ar') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('general.title') }} (EN)</label>
                <input type="text" name="title_en" value="{{ old('title_en') }}" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                @error('title_en') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('general.description') }} (AR)</label>
                <textarea name="description_ar" rows="3" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('description_ar') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('general.description') }} (EN)</label>
                <textarea name="description_en" rows="3" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('description_en') }}</textarea>
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-3">
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('general.order') }}</label>
                <input type="number" name="order" value="{{ old('order', 1) }}" min="1" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('general.pass_score') }} %</label>
                <input type="number" name="passing_score" value="{{ old('passing_score', 70) }}" min="1" max="100" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">{{ __('general.exam_questions_count') }}</label>
                <input type="number" name="exam_questions_count" value="{{ old('exam_questions_count', 30) }}" min="1" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
            </div>
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }} class="rounded border-gray-300 text-gold focus:ring-gold">
            <label for="is_published" class="text-sm text-gray-700">{{ __('general.published') }}</label>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.save') }}</button>
            <a href="{{ route('admin.levels.index') }}" class="rounded-lg border border-gray-300 px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">{{ __('general.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
