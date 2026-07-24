@extends('layouts.admin')
@section('title', __('general.message_details'))
@section('page-title', __('general.message_details'))
@section('content')
<div class="mx-auto max-w-2xl space-y-6">
    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <dl class="grid gap-4 text-sm sm:grid-cols-2">
            <div><dt class="text-gray-500">{{ __('general.name') }}</dt><dd class="mt-1 font-medium text-gray-900">{{ $contact->name }}</dd></div>
            <div><dt class="text-gray-500">{{ __('general.email') }}</dt><dd class="mt-1 font-medium text-gray-900">{{ $contact->email }}</dd></div>
            <div><dt class="text-gray-500">{{ __('general.phone') }}</dt><dd class="mt-1 font-medium text-gray-900">{{ $contact->phone ?? '—' }}</dd></div>
            <div><dt class="text-gray-500">{{ __('general.date') }}</dt><dd class="mt-1 font-medium text-gray-900">{{ $contact->created_at->format('Y-m-d H:i') }}</dd></div>
            <div class="sm:col-span-2"><dt class="text-gray-500">{{ __('general.subject') }}</dt><dd class="mt-1 font-medium text-gray-900">{{ $contact->subject }}</dd></div>
            <div class="sm:col-span-2"><dt class="text-gray-500">{{ __('general.message') }}</dt><dd class="mt-1 whitespace-pre-wrap text-gray-700">{{ $contact->message }}</dd></div>
        </dl>
    </div>

    @if($contact->status === 'replied')
    <div class="rounded-xl border border-green-200 bg-green-50 p-6 shadow-sm">
        <h3 class="mb-2 text-sm font-bold text-green-800">{{ __('general.reply') }}</h3>
        <p class="whitespace-pre-wrap text-sm text-green-900">{{ $contact->reply }}</p>
        <p class="mt-2 text-xs text-green-600">{{ $contact->replied_at?->format('Y-m-d H:i') }}</p>
    </div>
    @else
    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <h3 class="mb-3 text-sm font-bold text-navy">{{ __('general.send_reply') }}</h3>
        <form method="POST" action="{{ route('admin.contacts.reply', $contact) }}" class="space-y-4">
            @csrf
            <textarea name="reply" rows="4" required placeholder="{{ __('general.write_reply') }}..." class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('reply') }}</textarea>
            <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.send') }}</button>
        </form>
    </div>
    @endif

    <a href="{{ route('admin.contacts.index') }}" class="inline-block rounded-lg border border-gray-300 px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">{{ __('general.back') }}</a>
</div>
@endsection
