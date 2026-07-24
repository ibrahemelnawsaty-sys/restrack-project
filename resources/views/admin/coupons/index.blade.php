@extends('layouts.admin')
@section('title', __('general.coupons'))
@section('page-title', __('general.coupons'))
@section('content')
<div class="mb-4 flex justify-end"><a href="{{ route('admin.coupons.create') }}" class="rounded-lg bg-navy px-5 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">+ {{ __('general.add_new') }}</a></div>
<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50"><tr>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.code') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.type') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.value') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.usage') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.valid_until') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.status') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.actions') }}</th>
            </tr></thead>
            <tbody class="divide-y divide-gray-100">
            @forelse($coupons as $coupon)
                <tr>
                    <td class="px-4 py-3 font-mono font-medium text-navy">{{ $coupon->code }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $coupon->type === 'percentage' ? '%' : 'SAR' }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $coupon->value }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $coupon->used_count }} / {{ $coupon->max_uses ?? '∞' }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $coupon->valid_until ? $coupon->valid_until->format('Y-m-d') : '—' }}</td>
                    <td class="px-4 py-3"><span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-medium {{ $coupon->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">{{ $coupon->is_active ? __('general.active') : __('general.inactive') }}</span></td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('admin.coupons.edit', $coupon) }}" class="text-navy hover:text-gold">{{ __('general.edit') }}</a>
                        <form method="POST" action="{{ route('admin.coupons.destroy', $coupon) }}" onsubmit="return confirm('{{ __('general.confirm_delete') }}')">@csrf @method('DELETE')<button class="text-red-600 hover:text-red-800">{{ __('general.delete') }}</button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-4 py-8 text-center text-gray-400">{{ __('general.no_data') }}</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($coupons->hasPages())<div class="border-t px-4 py-3">{{ $coupons->links() }}</div>@endif
</div>
@endsection
