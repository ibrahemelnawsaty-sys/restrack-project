@extends('layouts.admin')
@section('title', __('general.surveys'))
@section('page-title', __('general.surveys'))
@section('content')
<div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
        <p class="text-sm text-gray-500">{{ __('general.total_responses') }}</p>
        <p class="mt-1 text-2xl font-bold text-navy">{{ $stats['total'] }}</p>
    </div>
    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
        <p class="text-sm text-gray-500">{{ __('general.avg_overall') }}</p>
        <p class="mt-1 text-2xl font-bold text-gold">{{ number_format($stats['avg_overall'], 1) }} / 5</p>
    </div>
    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
        <p class="text-sm text-gray-500">{{ __('general.recommend') }} %</p>
        <p class="mt-1 text-2xl font-bold text-green-600">{{ number_format($stats['recommend_pct'], 0) }}%</p>
    </div>
    <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
        <p class="text-sm text-gray-500">{{ __('general.avg_speaker') }}</p>
        <p class="mt-1 text-2xl font-bold text-navy">{{ number_format($stats['avg_speaker'], 1) }} / 5</p>
    </div>
</div>

<div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    <div class="rounded-lg bg-gray-50 p-3 text-center text-sm"><span class="text-gray-500">{{ __('general.content') }}</span><br><span class="font-bold text-navy">{{ number_format($stats['avg_content'], 1) }}</span></div>
    <div class="rounded-lg bg-gray-50 p-3 text-center text-sm"><span class="text-gray-500">{{ __('general.clarity') }}</span><br><span class="font-bold text-navy">{{ number_format($stats['avg_clarity'], 1) }}</span></div>
    <div class="rounded-lg bg-gray-50 p-3 text-center text-sm"><span class="text-gray-500">{{ __('general.technical') }}</span><br><span class="font-bold text-navy">{{ number_format($stats['avg_tech'], 1) }}</span></div>
    <div class="rounded-lg bg-gray-50 p-3 text-center text-sm"><span class="text-gray-500">{{ __('general.ease_of_use') }}</span><br><span class="font-bold text-navy">{{ number_format($stats['avg_ease'], 1) }}</span></div>
</div>

<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50"><tr>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.user') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.content') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.clarity') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.speaker') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.technical') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.ease_of_use') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.recommend') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.date') }}</th>
            </tr></thead>
            <tbody class="divide-y divide-gray-100">
            @forelse($responses as $resp)
                <tr>
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $resp->user->name ?? '—' }}</td>
                    <td class="px-4 py-3 text-center text-gray-700">{{ $resp->rating_content }}/5</td>
                    <td class="px-4 py-3 text-center text-gray-700">{{ $resp->rating_clarity }}/5</td>
                    <td class="px-4 py-3 text-center text-gray-700">{{ $resp->rating_speaker }}/5</td>
                    <td class="px-4 py-3 text-center text-gray-700">{{ $resp->rating_tech }}/5</td>
                    <td class="px-4 py-3 text-center text-gray-700">{{ $resp->rating_ease }}/5</td>
                    <td class="px-4 py-3 text-center">
                        @if($resp->would_recommend)<span class="text-green-600">✓</span>@else<span class="text-red-500">✗</span>@endif
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ $resp->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr><td colspan="8" class="px-4 py-8 text-center text-gray-400">{{ __('general.no_data') }}</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($responses->hasPages())<div class="border-t px-4 py-3">{{ $responses->links() }}</div>@endif
</div>
@endsection
