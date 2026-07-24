@extends('layouts.admin')
@section('title', __('general.lectures'))
@section('page-title', __('general.lectures'))
@section('content')
<div class="mb-4 flex items-center justify-between">
    <div></div>
    <a href="{{ route('admin.lectures.create') }}" class="rounded-lg bg-gold px-4 py-2 text-sm font-medium text-navy hover:bg-gold-light">+ {{ __('general.add_new') }}</a>
</div>
<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <table class="w-full text-sm">
        <thead class="border-b bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.title') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.level') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.speaker') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.order') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.duration') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.actions') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($lectures as $lecture)
            <tr>
                <td class="px-4 py-3 font-medium text-gray-800">{{ $lecture->title_en }}<br><span class="text-xs text-gray-400">{{ $lecture->title_ar }}</span></td>
                <td class="px-4 py-3 text-gray-600">{{ $lecture->level->title_en ?? '—' }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $lecture->speaker->name_en ?? '—' }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $lecture->order }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $lecture->duration_minutes ? $lecture->duration_minutes . 'm' : '—' }}</td>
                <td class="px-4 py-3">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.lectures.edit', $lecture) }}" class="text-xs text-gold hover:text-gold-dark">{{ __('general.edit') }}</a>
                        <form method="POST" action="{{ route('admin.lectures.destroy', $lecture) }}" onsubmit="return confirm('{{ __('general.confirm_delete') }}')">@csrf @method('DELETE')<button class="text-xs text-red-500 hover:text-red-700">{{ __('general.delete') }}</button></form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-4 py-8 text-center text-gray-400">{{ __('general.no_data') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@if($lectures->hasPages())<div class="mt-4">{{ $lectures->links() }}</div>@endif
@endsection
