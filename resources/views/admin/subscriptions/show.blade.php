@extends('layouts.admin')
@section('title', __('general.subscription_details'))
@section('page-title', __('general.subscription_details'))
@section('content')
<div class="mx-auto max-w-2xl space-y-6">
    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <h3 class="mb-4 text-lg font-bold text-navy">{{ __('general.user_info') }}</h3>
        <dl class="grid gap-4 sm:grid-cols-2 text-sm">
            <div><dt class="text-gray-500">{{ __('general.name') }}</dt><dd class="font-medium text-gray-900">{{ $subscription->user->name ?? '—' }}</dd></div>
            <div><dt class="text-gray-500">{{ __('general.email') }}</dt><dd class="font-medium text-gray-900">{{ $subscription->user->email ?? '—' }}</dd></div>
            <div><dt class="text-gray-500">{{ __('general.phone') }}</dt><dd class="font-medium text-gray-900">{{ $subscription->user->phone ?? '—' }}</dd></div>
        </dl>
    </div>
    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <h3 class="mb-4 text-lg font-bold text-navy">{{ __('general.payment_info') }}</h3>
        <dl class="grid gap-4 sm:grid-cols-2 text-sm">
            <div><dt class="text-gray-500">{{ __('general.status') }}</dt><dd><span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-medium {{ $subscription->status === 'active' ? 'bg-green-100 text-green-700' : ($subscription->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">{{ ucfirst($subscription->status) }}</span></dd></div>
            <div><dt class="text-gray-500">{{ __('general.amount') }}</dt><dd class="font-medium text-gray-900">{{ number_format($subscription->amount, 2) }} SAR</dd></div>
            <div><dt class="text-gray-500">{{ __('general.payment_method') }}</dt><dd class="font-medium text-gray-900">{{ $subscription->payment_method ?? '—' }}</dd></div>
            <div><dt class="text-gray-500">{{ __('general.transaction_id') }}</dt><dd class="font-medium text-gray-900">{{ $subscription->transaction_id ?? '—' }}</dd></div>
            <div><dt class="text-gray-500">{{ __('general.coupon') }}</dt><dd class="font-medium text-gray-900">{{ $subscription->coupon->code ?? '—' }}</dd></div>
            <div><dt class="text-gray-500">{{ __('general.discount') }}</dt><dd class="font-medium text-gray-900">{{ $subscription->discount_amount ? number_format($subscription->discount_amount, 2) . ' SAR' : '—' }}</dd></div>
            <div><dt class="text-gray-500">{{ __('general.date') }}</dt><dd class="font-medium text-gray-900">{{ $subscription->created_at->format('Y-m-d H:i') }}</dd></div>
        </dl>
    </div>
    <a href="{{ route('admin.subscriptions.index') }}" class="inline-block rounded-lg border border-gray-300 px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">{{ __('general.back') }}</a>
</div>
@endsection
