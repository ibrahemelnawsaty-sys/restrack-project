@extends('layouts.admin')
@section('title', __('general.speakers'))
@section('page-title', __('general.speakers'))
@section('content')
<div class="mb-4 flex items-center justify-between">
    <div></div>
    <a href="{{ route('admin.speakers.create') }}" class="rounded-lg bg-gold px-4 py-2 text-sm font-medium text-navy hover:bg-gold-light">+ {{ __('general.add_new') }}</a>
</div>
<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <table class="w-full text-sm">
        <thead class="border-b bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.photo') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.name') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.specialization') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.featured') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.order') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.actions') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($speakers as $speaker)
            <tr>
                <td class="px-4 py-3">
                    @if($speaker->photo)
                        <img src="{{ Storage::url($speaker->photo) }}" class="h-10 w-10 rounded-full object-cover">
                    @else
                        <span class="flex h-10 w-10 items-center justify-center rounded-full bg-navy/10 text-xs font-bold text-navy">{{ mb_substr($speaker->name_en, 0, 1) }}</span>
                    @endif
                </td>
                <td class="px-4 py-3 font-medium text-gray-800">{{ $speaker->name_en }}<br><span class="text-xs text-gray-400">{{ $speaker->name_ar }}</span></td>
                <td class="px-4 py-3 text-gray-600">{{ $speaker->specialization_en }}</td>
                <td class="px-4 py-3"><span class="text-xs {{ $speaker->is_featured ? 'text-gold' : 'text-gray-400' }}">{{ $speaker->is_featured ? '★' : '—' }}</span></td>
                <td class="px-4 py-3 text-gray-600">{{ $speaker->display_order }}</td>
                <td class="px-4 py-3">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.speakers.edit', $speaker) }}" class="text-xs text-gold hover:text-gold-dark">{{ __('general.edit') }}</a>
                        <form method="POST" action="{{ route('admin.speakers.destroy', $speaker) }}" onsubmit="return confirm('{{ __('general.confirm_delete') }}')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-500 hover:text-red-700">{{ __('general.delete') }}</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-8 text-center text-gray-400">{{ __('general.no_data') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
