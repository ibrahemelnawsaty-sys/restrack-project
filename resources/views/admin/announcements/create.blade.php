@extends('layouts.admin')
@section('title', __('general.add_new') . ' ' . __('general.announcement'))
@section('page-title', __('general.add_new') . ' ' . __('general.announcement'))
@section('content')
<div class="mx-auto max-w-2xl">
    @if($errors->any())
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
            <ul class="list-inside list-disc space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('admin.announcements.store') }}" enctype="multipart/form-data" class="space-y-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('general.type') }}</label>
            <select name="type" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                <option value="bar" @selected(old('type') === 'bar')>{{ __('general.announcement_type_bar') }}</option>
                <option value="popup" @selected(old('type') === 'popup')>{{ __('general.announcement_type_popup') }}</option>
            </select>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.title') }} (AR)</label><input type="text" name="title_ar" value="{{ old('title_ar') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.title') }} (EN)</label><input type="text" name="title_en" value="{{ old('title_en') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.body') }} (AR)</label><textarea name="body_ar" rows="3" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('body_ar') }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.body') }} (EN)</label><textarea name="body_en" rows="3" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('body_en') }}</textarea></div>
        </div>
        <div><label class="block text-sm font-medium text-gray-700">{{ __('general.link_url') }}</label><input type="url" name="link_url" value="{{ old('link_url') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.link_text') }} (AR)</label><input type="text" name="link_text_ar" value="{{ old('link_text_ar') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.link_text') }} (EN)</label><input type="text" name="link_text_en" value="{{ old('link_text_en') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div><label class="block text-sm font-medium text-gray-700">{{ __('general.image') }}</label><input type="file" name="image" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-lg file:border-0 file:bg-navy/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-navy hover:file:bg-navy/20"></div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.bg_color') }}</label><input type="color" name="bg_color" value="{{ old('bg_color', '#af9136') }}" class="mt-1 block h-11 w-full rounded-lg border border-gray-300 px-2 py-1"></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.text_color') }}</label><input type="color" name="text_color" value="{{ old('text_color', '#16264b') }}" class="mt-1 block h-11 w-full rounded-lg border border-gray-300 px-2 py-1"></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.starts_at') }}</label><input type="datetime-local" name="starts_at" value="{{ old('starts_at') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.ends_at') }}</label><input type="datetime-local" name="ends_at" value="{{ old('ends_at') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div><label class="block text-sm font-medium text-gray-700">{{ __('general.order') }}</label><input type="number" name="display_order" value="{{ old('display_order', 0) }}" min="0" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        <div class="flex flex-wrap gap-6">
            <label class="flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', true)) class="rounded border-gray-300 text-gold focus:ring-gold">{{ __('general.active') }}</label>
            <label class="flex items-center gap-2 text-sm text-gray-700"><input type="checkbox" name="is_dismissible" value="1" @checked(old('is_dismissible', true)) class="rounded border-gray-300 text-gold focus:ring-gold">{{ __('general.dismissible') }}</label>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.save') }}</button>
            <a href="{{ route('admin.announcements.index') }}" class="rounded-lg border border-gray-300 px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">{{ __('general.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
