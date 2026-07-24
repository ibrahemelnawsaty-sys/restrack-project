@extends('layouts.app')

@section('title', $speaker->name . ' — Restrack')

@section('content')
{{-- Header --}}
<section class="relative bg-navy py-16 text-white">
    @if($speaker->cover_photo)
        <div class="absolute inset-0 opacity-20">
            <img src="{{ Storage::url($speaker->cover_photo) }}" alt="" class="h-full w-full object-cover">
        </div>
    @endif
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col items-center gap-6 md:flex-row">
            @if($speaker->photo)
                <img src="{{ Storage::url($speaker->photo) }}" alt="{{ $speaker->name }}" class="h-32 w-32 rounded-full border-4 border-gold object-cover shadow-lg">
            @else
                <div class="flex h-32 w-32 items-center justify-center rounded-full border-4 border-gold bg-navy-light">
                    <span class="text-3xl font-bold text-gold">{{ mb_substr($speaker->name, 0, 1) }}</span>
                </div>
            @endif
            <div>
                <h1 class="text-3xl font-bold">{{ $speaker->name }}</h1>
                <p class="mt-1 text-lg text-gold">{{ $speaker->title }}</p>
                @if($speaker->specialization)
                    <p class="mt-1 text-white/60">{{ $speaker->specialization }}</p>
                @endif
                @if($speaker->years_of_experience)
                    <p class="mt-2 text-sm text-white/50">{{ $speaker->years_of_experience }} {{ __('general.years_experience') }}</p>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-3">
            {{-- Bio --}}
            <div class="lg:col-span-2 space-y-8">
                @if($speaker->bio)
                <div>
                    <h2 class="text-xl font-semibold text-navy">{{ __('general.biography') }}</h2>
                    <div class="mt-3 prose max-w-none text-gray-600">{!! nl2br(e($speaker->bio)) !!}</div>
                </div>
                @endif

                @if($speaker->achievements && count($speaker->achievements))
                <div>
                    <h2 class="text-xl font-semibold text-navy">{{ __('general.achievements') }}</h2>
                    <ul class="mt-3 space-y-2">
                        @foreach($speaker->achievements as $achievement)
                        <li class="flex items-start gap-2 text-sm text-gray-600">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            {{ $achievement }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @if($speaker->qualifications && count($speaker->qualifications))
                <div>
                    <h2 class="text-xl font-semibold text-navy">{{ __('general.qualifications') }}</h2>
                    <ul class="mt-3 space-y-2">
                        @foreach($speaker->qualifications as $qual)
                        <li class="flex items-start gap-2 text-sm text-gray-600">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.636 50.636 0 00-2.658-.813A59.906 59.906 0 0112 3.493a59.903 59.903 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0112 13.489a50.702 50.702 0 017.74-3.342"/></svg>
                            {{ $qual }}
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Social Links --}}
                @if($speaker->social_links)
                <div class="rounded-xl border border-gray-100 p-5">
                    <h3 class="font-semibold text-navy">{{ __('general.social_links') }}</h3>
                    <div class="mt-3 flex flex-wrap gap-3">
                        @foreach($speaker->social_links as $platform => $url)
                            @if($url)
                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" class="rounded-lg bg-navy/5 px-3 py-2 text-xs font-medium text-navy hover:bg-gold/10 hover:text-gold">
                                {{ ucfirst($platform) }}
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif

                @if($speaker->affiliated_institutions && count($speaker->affiliated_institutions))
                <div class="rounded-xl border border-gray-100 p-5">
                    <h3 class="font-semibold text-navy">{{ __('general.institutions') }}</h3>
                    <ul class="mt-3 space-y-1 text-sm text-gray-600">
                        @foreach($speaker->affiliated_institutions as $inst)
                        <li>{{ $inst }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Related lectures --}}
                @if($speaker->lectures->count())
                <div class="rounded-xl border border-gray-100 p-5">
                    <h3 class="font-semibold text-navy">{{ __('general.lectures') }}</h3>
                    <ul class="mt-3 space-y-2">
                        @foreach($speaker->lectures as $lecture)
                        <li class="text-sm text-gray-600">{{ $lecture->title }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
