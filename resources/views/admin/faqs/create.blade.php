@extends('layouts.admin')
@section('title', __('general.add_new') . ' ' . __('general.faq'))
@section('page-title', __('general.add_new') . ' ' . __('general.faq'))
@section('content')
<div class="mx-auto max-w-2xl">
    <form method="POST" action="{{ route('admin.faqs.store') }}" class="space-y-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.question') }} (AR)</label><textarea name="question_ar" rows="2" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('question_ar') }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.question') }} (EN)</label><textarea name="question_en" rows="2" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('question_en') }}</textarea></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.answer') }} (AR)</label><textarea name="answer_ar" rows="4" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('answer_ar') }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.answer') }} (EN)</label><textarea name="answer_en" rows="4" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('answer_en') }}</textarea></div>
        </div>
        <div><label class="block text-sm font-medium text-gray-700">{{ __('general.order') }}</label><input type="number" name="order" value="{{ old('order', 0) }}" min="0" class="mt-1 block w-32 rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.save') }}</button>
            <a href="{{ route('admin.faqs.index') }}" class="rounded-lg border border-gray-300 px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">{{ __('general.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
