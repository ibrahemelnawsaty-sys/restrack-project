@extends('layouts.admin')
@section('title', __('general.add_new') . ' ' . __('general.speaker'))
@section('page-title', __('general.add_new') . ' ' . __('general.speaker'))
@section('content')
<div class="mx-auto max-w-3xl">
    <form method="POST" action="{{ route('admin.speakers.store') }}" enctype="multipart/form-data" class="space-y-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.name') }} (AR)</label><input type="text" name="name_ar" value="{{ old('name_ar') }}" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">@error('name_ar') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror</div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.name') }} (EN)</label><input type="text" name="name_en" value="{{ old('name_en') }}" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">@error('name_en') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror</div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.title') }} (AR)</label><input type="text" name="title_ar" value="{{ old('title_ar') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.title') }} (EN)</label><input type="text" name="title_en" value="{{ old('title_en') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.specialization') }} (AR)</label><input type="text" name="specialization_ar" value="{{ old('specialization_ar') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.specialization') }} (EN)</label><input type="text" name="specialization_en" value="{{ old('specialization_en') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.bio') }} (AR)</label><textarea name="bio_ar" rows="4" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('bio_ar') }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.bio') }} (EN)</label><textarea name="bio_en" rows="4" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('bio_en') }}</textarea></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.email') }}</label><input type="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.phone') }}</label><input type="text" name="phone" value="{{ old('phone') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.photo') }}</label><input type="file" name="photo" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:rounded-lg file:border-0 file:bg-gold/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-gold"></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.years_experience') }}</label><input type="number" name="years_of_experience" value="{{ old('years_of_experience') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.display_order') }}</label><input type="number" name="display_order" value="{{ old('display_order', 0) }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div class="flex items-center gap-4">
            <label class="flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded border-gray-300 text-gold focus:ring-gold"> {{ __('general.featured') }}</label>
            <label class="flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="is_visible" value="1" {{ old('is_visible', true) ? 'checked' : '' }} class="rounded border-gray-300 text-gold focus:ring-gold"> {{ __('general.visible') }}</label>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.save') }}</button>
            <a href="{{ route('admin.speakers.index') }}" class="rounded-lg border border-gray-300 px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">{{ __('general.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
