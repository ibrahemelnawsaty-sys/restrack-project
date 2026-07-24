@extends('layouts.admin')
@section('title', __('general.contact_messages'))
@section('page-title', __('general.contact_messages'))
@section('content')
<div class="mb-4 flex items-center gap-3">
    <a href="{{ route('admin.contacts.index') }}" class="rounded-lg px-3 py-1.5 text-sm font-medium {{ !request('status') ? 'bg-navy text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">{{ __('general.all') }}</a>
    <a href="{{ route('admin.contacts.index', ['status' => 'new']) }}" class="rounded-lg px-3 py-1.5 text-sm font-medium {{ request('status') === 'new' ? 'bg-navy text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">{{ __('general.new') }}</a>
    <a href="{{ route('admin.contacts.index', ['status' => 'read']) }}" class="rounded-lg px-3 py-1.5 text-sm font-medium {{ request('status') === 'read' ? 'bg-navy text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">{{ __('general.read') }}</a>
    <a href="{{ route('admin.contacts.index', ['status' => 'replied']) }}" class="rounded-lg px-3 py-1.5 text-sm font-medium {{ request('status') === 'replied' ? 'bg-navy text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">{{ __('general.replied') }}</a>
</div>
<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50"><tr>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.name') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.email') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.subject') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.status') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.date') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.actions') }}</th>
            </tr></thead>
            <tbody class="divide-y divide-gray-100">
            @forelse($messages as $msg)
                <tr class="{{ $msg->status === 'new' ? 'bg-blue-50/50' : '' }}">
                    <td class="px-4 py-3 font-medium text-gray-900">{{ $msg->name }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ $msg->email }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ Str::limit($msg->subject, 30) }}</td>
                    <td class="px-4 py-3"><span class="inline-block rounded-full px-2.5 py-0.5 text-xs font-medium {{ $msg->status === 'new' ? 'bg-blue-100 text-blue-700' : ($msg->status === 'replied' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500') }}">{{ ucfirst($msg->status) }}</span></td>
                    <td class="px-4 py-3 text-gray-500">{{ $msg->created_at->format('Y-m-d') }}</td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('admin.contacts.show', $msg) }}" class="text-navy hover:text-gold">{{ __('general.view') }}</a>
                        <form method="POST" action="{{ route('admin.contacts.destroy', $msg) }}" onsubmit="return confirm('{{ __('general.confirm_delete') }}')">@csrf @method('DELETE')<button class="text-red-600 hover:text-red-800">{{ __('general.delete') }}</button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-8 text-center text-gray-400">{{ __('general.no_data') }}</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($messages->hasPages())<div class="border-t px-4 py-3">{{ $messages->links() }}</div>@endif
</div>
@endsection
