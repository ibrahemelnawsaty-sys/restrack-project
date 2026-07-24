@extends('layouts.app')

@section('title', __('general.speakers') . ' — Restrack')

@section('content')
{{-- Hero --}}
<section class="relative overflow-hidden mesh-bg py-20 text-white lg:py-28">
    <div class="absolute inset-0 bg-grid opacity-30"></div>
    <div class="stars-bg absolute inset-0"></div>
    <div class="floater gradient-gold w-72 h-72 -top-20 -start-20 animate-float"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 rounded-full glass px-4 py-1.5 text-xs font-medium text-gold animate-fade-up">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.539 1.118L10 13.347l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.363-1.118L3.566 7.819c-.783-.57-.38-1.81.589-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            {{ __('general.meet_team') ?? 'تعرّف على المتحدثين' }}
        </span>
        <h1 class="mt-6 text-4xl font-extrabold lg:text-6xl animate-fade-up delay-100">
            {{ __('general.our_speakers') }}
            <span class="block text-gradient-gold">{{ __('general.experts') ?? 'خبراء معتمدون' }}</span>
        </h1>
        <p class="mt-5 max-w-2xl mx-auto text-lg text-white/70 animate-fade-up delay-200">{{ __('general.speakers_subtitle') }}</p>
    </div>

    {{-- bottom wave --}}
    <div class="absolute inset-x-0 bottom-0">
        <svg class="w-full h-12" viewBox="0 0 1440 60" preserveAspectRatio="none" fill="none">
            <path d="M0,30 C240,60 480,0 720,30 C960,60 1200,10 1440,40 L1440,60 L0,60 Z" fill="#ffffff"/>
        </svg>
    </div>
</section>

{{-- Speakers Grid --}}
<section class="py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($speakers as $i => $speaker)
            <div class="group relative overflow-hidden rounded-3xl bg-white shadow-sm card-lift reveal" style="transition-delay: {{ $i * 80 }}ms">
                {{-- Image --}}
                <div class="relative h-72 overflow-hidden bg-gradient-to-br from-navy to-navy-dark">
                    @if($speaker->photo)
                        <img src="{{ Storage::url($speaker->photo) }}" alt="{{ $speaker->name }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                    @else
                        <div class="flex h-full items-center justify-center">
                            <svg class="h-24 w-24 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                        </div>
                    @endif

                    {{-- Gradient overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/40 to-transparent"></div>

                    {{-- Top badges --}}
                    <span class="absolute top-4 end-4 rounded-full gradient-gold px-3 py-1 text-xs font-bold text-navy shadow-lg">
                        ★ {{ __('general.expert') ?? 'خبير' }}
                    </span>

                    {{-- Name overlay --}}
                    <div class="absolute inset-x-0 bottom-0 p-5">
                        <h2 class="text-xl font-bold text-white">{{ $speaker->name }}</h2>
                        <p class="text-sm font-semibold text-gold">{{ $speaker->title }}</p>
                    </div>
                </div>

                {{-- Body --}}
                <div class="p-6">
                    @if($speaker->specialization)
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-gold/10 px-3 py-1 text-xs font-medium text-gold-dark">
                            <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            {{ $speaker->specialization }}
                        </span>
                    @endif

                    <p class="mt-4 line-clamp-3 text-sm text-gray-600 leading-relaxed">{{ $speaker->short_bio }}</p>

                    <a href="{{ route('speakers.show', $speaker->slug) }}" class="mt-5 flex items-center justify-between border-t border-gray-100 pt-4 text-sm font-bold text-navy transition group-hover:text-gold">
                        <span class="inline-flex items-center gap-1.5">
                            {{ __('general.view_profile') }}
                            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </span>
                        <svg class="h-5 w-5 text-gold opacity-50 transition group-hover:opacity-100" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.539 1.118L10 13.347l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.363-1.118L3.566 7.819c-.783-.57-.38-1.81.589-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-gold/10">
                    <svg class="h-10 w-10 text-gold" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <p class="mt-4 text-gray-400">{{ __('general.no_speakers') }}</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
