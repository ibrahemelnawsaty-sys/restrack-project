@extends('layouts.admin')
@section('title', __('general.edit') . ' ' . __('general.coupon'))
@section('page-title', __('general.edit') . ' ' . __('general.coupon'))
@section('content')
<div class="mx-auto max-w-xl">
    <form method="POST" action="{{ route('admin.coupons.update', $coupon) }}" class="space-y-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf @method('PUT')
        <div><label class="block text-sm font-medium text-gray-700">{{ __('general.code') }}</label><input type="text" name="code" value="{{ old('code', $coupon->code) }}" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-mono uppercase focus:border-gold focus:ring-gold"></div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.type') }}</label><select name="type" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"><option value="percentage" {{ old('type', $coupon->type) === 'percentage' ? 'selected' : '' }}>{{ __('general.percentage') }}</option><option value="fixed" {{ old('type', $coupon->type) === 'fixed' ? 'selected' : '' }}>{{ __('general.fixed') }}</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.value') }}</label><input type="number" name="value" value="{{ old('value', $coupon->value) }}" required step="0.01" min="0" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.max_uses') }}</label><input type="number" name="max_uses" value="{{ old('max_uses', $coupon->max_uses) }}" min="1" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.valid_until') }}</label><input type="date" name="valid_until" value="{{ old('valid_until', $coupon->valid_until?->format('Y-m-d')) }}" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        </div>
        <label class="flex items-center gap-2"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $coupon->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-navy focus:ring-gold"><span class="text-sm text-gray-700">{{ __('general.active') }}</span></label>
        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.update') }}</button>
            <a href="{{ route('admin.coupons.index') }}" class="rounded-lg border border-gray-300 px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">{{ __('general.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
