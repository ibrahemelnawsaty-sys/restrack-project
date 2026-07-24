@extends('layouts.admin')
@section('title', __('general.add_new') . ' ' . __('general.guideline'))
@section('page-title', __('general.add_new') . ' ' . __('general.guideline'))
@section('content')
<div class="mx-auto max-w-xl">
    <form method="POST" action="{{ route('admin.guidelines.store') }}" enctype="multipart/form-data" class="space-y-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.name') }} (AR)</label><input type="text" name="name_ar" value="{{ old('name_ar') }}" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.name') }} (EN)</label><input type="text" name="name_en" value="{{ old('name_en') }}" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div><label class="block text-sm font-medium text-gray-700">{{ __('general.logo') }}</label><input type="file" name="logo" accept="image/*" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-lg file:border-0 file:bg-navy/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-navy hover:file:bg-navy/20"></div>
        <div><label class="block text-sm font-medium text-gray-700">{{ __('general.url') }}</label><input type="url" name="url" value="{{ old('url') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.type') }}</label><input type="text" name="type" value="{{ old('type') }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.order') }}</label><input type="number" name="order" value="{{ old('order', 0) }}" min="0" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.save') }}</button>
            <a href="{{ route('admin.guidelines.index') }}" class="rounded-lg border border-gray-300 px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">{{ __('general.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
