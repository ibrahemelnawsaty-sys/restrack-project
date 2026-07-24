@extends('layouts.student')

@section('title', __('general.certificates'))
@section('page-title', __('general.my_certificates'))

@section('content')
<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    @forelse($certificates as $cert)
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="bg-gradient-to-r from-navy to-navy-dark p-5 text-center text-white">
            <svg class="mx-auto h-10 w-10 text-gold" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="mt-2 font-semibold">
                @if($cert->type === 'final')
                    {{ __('general.final_certificate') }}
                @else
                    {{ $cert->level->title ?? __('general.level') . ' ' . __('general.certificate') }}
                @endif
            </h3>
        </div>
        <div class="p-5 text-sm">
            <div class="space-y-2 text-gray-600">
                <p><strong>{{ __('general.certificate_number') }}:</strong> {{ $cert->certificate_number }}</p>
                <p><strong>{{ __('general.score') }}:</strong> {{ $cert->score }}%</p>
                <p><strong>{{ __('general.issued_at') }}:</strong> {{ $cert->issued_at->format('Y-m-d') }}</p>
            </div>
            <div class="mt-4 flex gap-2">
                <a href="{{ route('student.certificates.download', $cert->id) }}" class="flex-1 rounded-lg bg-gold py-2 text-center text-xs font-medium text-navy hover:bg-gold-light">
                    {{ __('general.download') }}
                </a>
                <a href="{{ route('certificate.verify', $cert->certificate_number) }}" target="_blank" class="flex-1 rounded-lg border border-gray-200 py-2 text-center text-xs font-medium text-gray-600 hover:bg-gray-50">
                    {{ __('general.verify') }}
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full py-12 text-center text-gray-400">
        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" stroke-width="1" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <p class="mt-3">{{ __('general.no_certificates') }}</p>
    </div>
    @endforelse
</div>
@endsection
