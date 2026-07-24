@extends('layouts.admin')
@section('title', __('general.guidelines'))
@section('page-title', __('general.guidelines'))
@section('content')
<div class="mb-4 flex justify-end"><a href="{{ route('admin.guidelines.create') }}" class="rounded-lg bg-navy px-5 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">+ {{ __('general.add_new') }}</a></div>
<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50"><tr>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.logo') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.name') }} (AR)</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.name') }} (EN)</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.type') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.order') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.actions') }}</th>
            </tr></thead>
            <tbody class="divide-y divide-gray-100">
            @forelse($guidelines as $guide)
                <tr>
                    <td class="px-4 py-3">@if($guide->logo)<img src="{{ asset('storage/' . $guide->logo) }}" alt="" class="h-10 w-10 rounded object-contain">@else <span class="text-gray-300">—</span> @endif</td>
                    <td class="px-4 py-3 text-gray-700">{{ $guide->name_ar }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $guide->name_en }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $guide->type ?? '—' }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $guide->order }}</td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('admin.guidelines.edit', $guide) }}" class="text-navy hover:text-gold">{{ __('general.edit') }}</a>
                        <form method="POST" action="{{ route('admin.guidelines.destroy', $guide) }}" onsubmit="return confirm('{{ __('general.confirm_delete') }}')">@csrf @method('DELETE')<button class="text-red-600 hover:text-red-800">{{ __('general.delete') }}</button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-8 text-center text-gray-400">{{ __('general.no_data') }}</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($guidelines->hasPages())<div class="border-t px-4 py-3">{{ $guidelines->links() }}</div>@endif
</div>
@endsection
