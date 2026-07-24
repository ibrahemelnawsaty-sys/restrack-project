@extends('layouts.admin')
@section('title', __('general.announcements'))
@section('page-title', __('general.announcements'))
@section('content')
<div class="mb-4 flex justify-end"><a href="{{ route('admin.announcements.create') }}" class="rounded-lg bg-navy px-5 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">+ {{ __('general.add_new') }}</a></div>
<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50"><tr>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.type') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.title') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.status') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.order') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.actions') }}</th>
            </tr></thead>
            <tbody class="divide-y divide-gray-100">
            @forelse($announcements as $announcement)
                <tr>
                    <td class="px-4 py-3">
                        <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-medium {{ $announcement->type === 'popup' ? 'bg-navy/10 text-navy' : 'bg-gold/15 text-gold' }}">{{ __('general.announcement_type_' . $announcement->type) }}</span>
                    </td>
                    <td class="px-4 py-3 text-gray-700">{{ $announcement->title ?: '—' }}</td>
                    <td class="px-4 py-3">
                        @if($announcement->is_active)
                            <span class="inline-flex rounded-full bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-700">{{ __('general.active') }}</span>
                        @else
                            <span class="inline-flex rounded-full bg-gray-100 px-2.5 py-0.5 text-xs font-medium text-gray-500">{{ __('general.inactive') }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ $announcement->display_order }}</td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('admin.announcements.edit', $announcement) }}" class="text-navy hover:text-gold">{{ __('general.edit') }}</a>
                        <form method="POST" action="{{ route('admin.announcements.destroy', $announcement) }}" onsubmit="return confirm('{{ __('general.confirm_delete') }}')">@csrf @method('DELETE')<button class="text-red-600 hover:text-red-800">{{ __('general.delete') }}</button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">{{ __('general.no_data') }}</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($announcements->hasPages())<div class="border-t px-4 py-3">{{ $announcements->links() }}</div>@endif
</div>
@endsection
