@extends('layouts.app')

@section('title', __('general.verify_certificate') . ' — Restrack')

@section('content')
<section class="bg-navy py-12 text-white">
    <div class="mx-auto max-w-7xl px-4 text-center">
        <h1 class="text-3xl font-bold">{{ __('general.verify_certificate') }}</h1>
    </div>
</section>

<section class="py-16">
    <div class="mx-auto max-w-xl px-4">
        @if(isset($certificate))
            <div class="rounded-2xl border-2 border-green-200 bg-green-50 p-8 text-center">
                <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="mt-4 text-xl font-bold text-green-700">{{ __('general.certificate_valid') }}</h2>
                <div class="mt-4 space-y-2 text-sm text-green-600">
                    <p><strong>{{ __('general.name') }}:</strong> {{ $certificate->user->name }}</p>
                    <p><strong>{{ __('general.certificate_number') }}:</strong> {{ $certificate->certificate_number }}</p>
                    <p><strong>{{ __('general.score') }}:</strong> {{ $certificate->score }}%</p>
                    <p><strong>{{ __('general.issued_at') }}:</strong> {{ $certificate->issued_at->format('Y-m-d') }}</p>
                    @if($certificate->level)
                        <p><strong>{{ __('general.level') }}:</strong> {{ $certificate->level->title }}</p>
                    @else
                        <p><strong>{{ __('general.type') }}:</strong> {{ __('general.final_certificate') }}</p>
                    @endif
                </div>
            </div>
        @else
            <div class="rounded-2xl border-2 border-red-200 bg-red-50 p-8 text-center">
                <svg class="mx-auto h-16 w-16 text-red-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h2 class="mt-4 text-xl font-bold text-red-600">{{ __('general.certificate_invalid') }}</h2>
                <p class="mt-2 text-sm text-red-500">{{ __('general.certificate_not_found') }}</p>
            </div>
        @endif
    </div>
</section>
@endsection
