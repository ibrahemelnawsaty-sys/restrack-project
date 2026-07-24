@extends('layouts.admin')

@section('title', __('general.dashboard'))
@section('page-title', __('general.dashboard'))

@section('content')
{{-- Stats cards --}}
<div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    @foreach([
        ['label' => __('general.total_users'), 'value' => $stats['total_users'], 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z', 'color' => 'text-blue-600 bg-blue-50'],
        ['label' => __('general.active_subscriptions'), 'value' => $stats['active_subscriptions'], 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z', 'color' => 'text-green-600 bg-green-50'],
        ['label' => __('general.total_revenue'), 'value' => number_format($stats['total_revenue']) . ' ' . __('general.sar'), 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'color' => 'text-gold bg-gold/10'],
        ['label' => __('general.certificates_issued'), 'value' => $stats['certificates_issued'], 'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'color' => 'text-purple-600 bg-purple-50'],
    ] as $stat)
    <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">{{ $stat['label'] }}</p>
                <p class="mt-1 text-2xl font-bold text-navy">{{ $stat['value'] }}</p>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-xl {{ $stat['color'] }}">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/>
                </svg>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Recent activity --}}
<div class="grid gap-6 lg:grid-cols-2">
    {{-- Recent users --}}
    <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
        <h3 class="font-semibold text-navy">{{ __('general.recent_users') }}</h3>
        <div class="mt-4 space-y-3">
            @forelse($recentUsers as $user)
            <div class="flex items-center justify-between text-sm">
                <div>
                    <p class="font-medium text-gray-800">{{ $user->name }}</p>
                    <p class="text-xs text-gray-400">{{ $user->email }}</p>
                </div>
                <span class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
            </div>
            @empty
            <p class="text-sm text-gray-400">{{ __('general.no_data') }}</p>
            @endforelse
        </div>
    </div>

    {{-- Recent subscriptions --}}
    <div class="rounded-xl border border-gray-100 bg-white p-5 shadow-sm">
        <h3 class="font-semibold text-navy">{{ __('general.recent_subscriptions') }}</h3>
        <div class="mt-4 space-y-3">
            @forelse($recentPayments as $sub)
            <div class="flex items-center justify-between text-sm">
                <div>
                    <p class="font-medium text-gray-800">{{ $sub->user->name ?? '—' }}</p>
                    <p class="text-xs text-gray-400">{{ $sub->amount }} {{ __('general.sar') }}</p>
                </div>
                <span class="rounded-full px-2 py-0.5 text-xs font-medium
                    {{ $sub->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ $sub->status }}
                </span>
            </div>
            @empty
            <p class="text-sm text-gray-400">{{ __('general.no_data') }}</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
