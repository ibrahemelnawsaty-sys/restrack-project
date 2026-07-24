@extends('layouts.admin')
@section('title', __('general.subscriptions'))
@section('page-title', __('general.subscriptions'))
@section('content')
<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50"><tr>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">#</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.user') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.status') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.amount') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.payment_method') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.date') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.actions') }}</th>
            </tr></thead>
            <tbody class="divide-y divide-gray-100">
            @forelse($subscriptions as $sub)
                <tr>
                    <td class="px-4 py-3 text-gray-500">{{ $sub->id }}</td>
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $sub->user->name ?? '—' }}</td>
                    <td class="px-4 py-3"><span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-medium {{ $sub->status === 'active' ? 'bg-green-100 text-green-700' : ($sub->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">{{ ucfirst($sub->status) }}</span></td>
                    <td class="px-4 py-3 text-gray-700">{{ number_format($sub->amount, 2) }} SAR</td>
                    <td class="px-4 py-3 text-gray-500">{{ $sub->payment_method ?? '—' }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $sub->created_at->format('Y-m-d') }}</td>
                    <td class="px-4 py-3"><a href="{{ route('admin.subscriptions.show', $sub) }}" class="text-navy hover:text-gold">{{ __('general.view') }}</a></td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-4 py-8 text-center text-gray-400">{{ __('general.no_data') }}</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($subscriptions->hasPages())<div class="border-t px-4 py-3">{{ $subscriptions->links() }}</div>@endif
</div>
@endsection
