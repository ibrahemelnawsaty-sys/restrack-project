@extends('layouts.admin')
@section('title', __('general.edit') . ' ' . __('general.lecture'))
@section('page-title', __('general.edit') . ': ' . $lecture->title_en)
@section('content')
<div class="mx-auto max-w-2xl">
    <form method="POST" action="{{ route('admin.lectures.update', $lecture) }}" enctype="multipart/form-data" class="space-y-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf @method('PUT')
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.title') }} (AR)</label><input type="text" name="title_ar" value="{{ old('title_ar', $lecture->title_ar) }}" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.title') }} (EN)</label><input type="text" name="title_en" value="{{ old('title_en', $lecture->title_en) }}" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.level') }}</label><select name="level_id" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"><option value="">—</option>@foreach($levels as $level)<option value="{{ $level->id }}" {{ old('level_id', $lecture->level_id) == $level->id ? 'selected' : '' }}>{{ $level->title_en }}</option>@endforeach</select></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.speaker') }}</label><select name="speaker_id" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"><option value="">—</option>@foreach($speakers as $speaker)<option value="{{ $speaker->id }}" {{ old('speaker_id', $lecture->speaker_id) == $speaker->id ? 'selected' : '' }}>{{ $speaker->name_en }}</option>@endforeach</select></div>
        </div>
        <div><label class="block text-sm font-medium text-gray-700">{{ __('general.video_url') }}</label><input type="text" name="video_url" value="{{ old('video_url', $lecture->video_url) }}" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        <div class="grid gap-4 sm:grid-cols-3">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.video_provider') }}</label><select name="video_provider" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"><option value="vimeo" {{ $lecture->video_provider === 'vimeo' ? 'selected' : '' }}>Vimeo</option><option value="youtube" {{ $lecture->video_provider === 'youtube' ? 'selected' : '' }}>YouTube</option><option value="custom" {{ $lecture->video_provider === 'custom' ? 'selected' : '' }}>Custom</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.order') }}</label><input type="number" name="order" value="{{ old('order', $lecture->order) }}" min="1" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.duration') }} (min)</label><input type="number" name="duration_minutes" value="{{ old('duration_minutes', $lecture->duration_minutes) }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.description') }} (AR)</label><textarea name="description_ar" rows="3" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('description_ar', $lecture->description_ar) }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.description') }} (EN)</label><textarea name="description_en" rows="3" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('description_en', $lecture->description_en) }}</textarea></div>
        </div>
        <div class="flex items-center gap-4">
            <label class="flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="is_published" value="1" {{ $lecture->is_published ? 'checked' : '' }} class="rounded border-gray-300 text-gold focus:ring-gold"> {{ __('general.published') }}</label>
            <label class="flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="is_free_preview" value="1" {{ $lecture->is_free_preview ? 'checked' : '' }} class="rounded border-gray-300 text-gold focus:ring-gold"> {{ __('general.free_preview') }}</label>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.save') }}</button>
            <a href="{{ route('admin.lectures.index') }}" class="rounded-lg border border-gray-300 px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">{{ __('general.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
