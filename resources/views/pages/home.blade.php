@extends('layouts.app')

@section('title', __('general.home') . ' — Restrack')

@section('content')

{{-- =============== HERO =============== --}}
<section class="relative isolate overflow-hidden mesh-bg text-white">
    {{-- decorative grid --}}
    <div class="absolute inset-0 bg-grid opacity-30"></div>
    {{-- stars layer --}}
    <div class="stars-bg absolute inset-0"></div>
    {{-- floating blobs --}}
    <div class="floater gradient-gold w-80 h-80 top-10 -start-20 animate-float"></div>
    <div class="floater bg-navy-light w-96 h-96 bottom-10 -end-20 animate-float-slow"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-24 lg:py-36">
        <div class="grid items-center gap-12 lg:grid-cols-2">
            {{-- Left content --}}
            <div class="text-center lg:text-start">
                {{-- Badge --}}
                <span class="inline-flex items-center gap-2 rounded-full glass px-4 py-1.5 text-xs font-medium text-gold animate-fade-up">
                    <span class="relative flex h-2 w-2">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-gold opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-gold"></span>
                    </span>
                    {{ __('general.live_now') ?? 'منصة معتمدة • تعلم بثقة' }}
                </span>

                <h1 class="mt-6 text-4xl font-extrabold leading-tight tracking-tight sm:text-5xl lg:text-6xl animate-fade-up delay-100">
                    <span class="block">{{ $sections['hero']->title ?? __('general.hero_title') }}</span>
                    <span class="mt-2 block text-gradient-gold">{{ __('general.hero_highlight') ?? 'مع منصة Restrack' }}</span>
                </h1>

                <p class="mt-6 max-w-xl text-lg text-white/75 lg:text-xl animate-fade-up delay-200">
                    {{ $sections['hero']->subtitle ?? __('general.hero_subtitle') }}
                </p>

                <div class="mt-10 flex flex-wrap items-center justify-center gap-4 lg:justify-start animate-fade-up delay-300">
                    <a href="{{ route('register') }}" class="btn-magnetic group inline-flex items-center gap-2 rounded-2xl gradient-gold px-8 py-4 font-bold text-navy shadow-2xl glow-gold-hover">
                        {{ $sections['hero']->cta_text ?? __('general.start_learning') }}
                        <svg class="h-5 w-5 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </a>
                    <a href="#program" class="inline-flex items-center gap-2 rounded-2xl border-2 border-gold/40 px-8 py-4 font-bold text-gold backdrop-blur transition hover:border-gold hover:bg-gold/10">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ __('general.explore_program') }}
                    </a>
                </div>

                {{-- Trust badges --}}
                <div class="mt-10 flex flex-wrap items-center justify-center gap-x-8 gap-y-4 text-sm text-white/60 lg:justify-start animate-fade-up delay-500">
                    @foreach([
                        ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'text' => __('general.accredited')],
                        ['icon' => 'M13 10V3L4 14h7v7l9-11h-7z', 'text' => __('general.self_paced')],
                        ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z', 'text' => __('general.expert_speakers')],
                    ] as $b)
                        <div class="flex items-center gap-2">
                            <svg class="h-5 w-5 text-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $b['icon'] }}"/></svg>
                            <span>{{ $b['text'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right visual --}}
            <div class="relative hidden lg:block">
                <div class="relative mx-auto max-w-md">
                    {{-- Glow behind --}}
                    <div class="absolute inset-0 rounded-[2rem] gradient-gold opacity-20 blur-3xl"></div>

                    {{-- Main card --}}
                    <div class="relative rounded-[2rem] glass-dark p-6 shadow-2xl animate-float tilt">
                        {{-- Mock dashboard preview --}}
                        <div class="rounded-2xl bg-navy-dark p-5 ring-1 ring-gold/20">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="h-2.5 w-2.5 rounded-full bg-red-400"></span>
                                    <span class="h-2.5 w-2.5 rounded-full bg-yellow-400"></span>
                                    <span class="h-2.5 w-2.5 rounded-full bg-green-400"></span>
                                </div>
                                <span class="text-xs text-white/40">restrack.sa</span>
                            </div>

                            <div class="mt-5">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-xl gradient-gold flex items-center justify-center text-navy font-extrabold">R</div>
                                    <div>
                                        <p class="text-sm font-semibold text-white">{{ __('general.your_progress') ?? 'تقدمك في الدورة' }}</p>
                                        <p class="text-xs text-white/50">{{ __('general.level') ?? 'المستوى' }} 2 / 3</p>
                                    </div>
                                </div>

                                {{-- Progress bars --}}
                                <div class="mt-5 space-y-3">
                                    @foreach([['l'=>'Foundation','v'=>100],['l'=>'Intermediate','v'=>68],['l'=>'Advanced','v'=>22]] as $row)
                                        <div>
                                            <div class="flex items-center justify-between text-xs">
                                                <span class="text-white/70">{{ $row['l'] }}</span>
                                                <span class="text-gold font-semibold">{{ $row['v'] }}%</span>
                                            </div>
                                            <div class="mt-1.5 h-2 overflow-hidden rounded-full bg-white/5">
                                                <div class="h-full gradient-gold animate-shimmer" style="width: {{ $row['v'] }}%; background-size: 200% auto;"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-5 grid grid-cols-3 gap-2">
                                    @foreach([['k'=>'12','v'=>__('general.lectures')],['k'=>'85%','v'=>__('general.pass_score')],['k'=>'3','v'=>__('general.certificates')]] as $st)
                                        <div class="rounded-xl bg-white/5 p-3 text-center">
                                            <p class="text-lg font-extrabold text-gold">{{ $st['k'] }}</p>
                                            <p class="text-[10px] text-white/50">{{ $st['v'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Floating accents --}}
                    <div class="absolute -top-6 -end-6 rounded-2xl glass p-3 shadow-xl animate-bounce-soft">
                        <div class="flex items-center gap-2">
                            <div class="h-9 w-9 rounded-full bg-green-500/20 flex items-center justify-center">
                                <svg class="h-4 w-4 text-green-400" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-white/50">{{ __('general.exam_passed') ?? 'تم اجتياز الاختبار' }}</p>
                                <p class="text-xs font-bold text-white">+ 1 Certificate</p>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -bottom-4 -start-6 rounded-2xl glass p-3 shadow-xl animate-pulse-soft">
                        <div class="flex items-center gap-2">
                            <div class="h-9 w-9 rounded-full bg-gold/20 flex items-center justify-center">
                                <svg class="h-4 w-4 text-gold" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.539 1.118L10 13.347l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.363-1.118L3.566 7.819c-.783-.57-.38-1.81.589-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-white/50">{{ __('general.rating') ?? 'تقييم' }}</p>
                                <p class="text-xs font-bold text-white">4.9 / 5</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- bottom wave --}}
    <div class="absolute inset-x-0 bottom-0">
        <svg class="w-full h-16" viewBox="0 0 1440 60" preserveAspectRatio="none" fill="none">
            <path d="M0,30 C240,60 480,0 720,30 C960,60 1200,10 1440,40 L1440,60 L0,60 Z" fill="#ffffff"/>
        </svg>
    </div>
</section>

{{-- =============== STATS BAR =============== --}}
<section class="relative -mt-1 bg-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid gap-6 grid-cols-2 lg:grid-cols-4 reveal">
            @foreach([
                ['v' => 1500, 'l' => __('general.students') ?? 'متدرب', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                ['v' => 50,   'l' => __('general.lectures'),                 'icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'],
                ['v' => 12,   'l' => __('general.speakers'),                 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['v' => 98,   'l' => __('general.satisfaction') ?? 'رضا',     'icon' => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'suffix' => '%'],
            ] as $i => $s)
                <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-gradient-to-br from-white to-gray-50 p-6 transition hover:border-gold/40 hover:shadow-xl">
                    <div class="absolute -end-6 -top-6 h-24 w-24 rounded-full bg-gold/5 transition group-hover:scale-150 group-hover:bg-gold/10"></div>
                    <div class="relative flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl gradient-gold shadow-md">
                            <svg class="h-6 w-6 text-navy" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $s['icon'] }}"/></svg>
                        </div>
                        <div>
                            <p class="text-3xl font-extrabold text-navy">
                                <span data-counter="{{ $s['v'] }}" data-suffix="{{ $s['suffix'] ?? '+' }}">0</span>
                            </p>
                            <p class="text-sm text-gray-500">{{ $s['l'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =============== ABOUT / FEATURES =============== --}}
<section class="relative py-20 lg:py-28">
    <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 h-96 bg-dots opacity-50 pointer-events-none"></div>
    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center reveal">
            <span class="text-xs font-bold uppercase tracking-[0.3em] text-gold">{{ __('general.about_us') ?? 'من نحن' }}</span>
            <h2 class="mt-3 section-title text-4xl font-extrabold text-navy lg:text-5xl">
                {{ $sections['about']->title ?? __('general.about_title') }}
            </h2>
            <p class="mt-5 text-lg text-gray-600">{{ $sections['about']->subtitle ?? __('general.about_subtitle') }}</p>
        </div>

        <div class="mt-16 grid gap-6 md:grid-cols-3">
            @foreach([
                ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'title' => __('general.structured_learning'), 'desc' => __('general.structured_learning_desc'), 'num' => '01'],
                ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'title' => __('general.certified_program'), 'desc' => __('general.certified_program_desc'), 'num' => '02'],
                ['icon' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => __('general.bilingual'), 'desc' => __('general.bilingual_desc'), 'num' => '03']
            ] as $i => $feature)
            <div class="group relative overflow-hidden rounded-3xl bg-white p-8 shadow-sm card-lift reveal" style="transition-delay: {{ $i * 100 }}ms">
                {{-- Number watermark --}}
                <span class="absolute -top-4 -end-2 text-[120px] font-black leading-none text-gold/5 transition group-hover:text-gold/10">{{ $feature['num'] }}</span>

                <div class="relative">
                    <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl gradient-gold shadow-lg transition group-hover:scale-110 group-hover:rotate-6">
                        <svg class="h-8 w-8 text-navy" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $feature['icon'] }}"/>
                        </svg>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-navy">{{ $feature['title'] }}</h3>
                    <p class="mt-3 text-sm leading-relaxed text-gray-600">{{ $feature['desc'] }}</p>

                    <div class="mt-6 flex items-center gap-2 text-sm font-semibold text-gold opacity-0 transition group-hover:opacity-100">
                        <span>{{ __('general.learn_more') ?? 'اعرف المزيد' }}</span>
                        <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =============== SPEAKERS =============== --}}
@if(isset($speakers) && $speakers->count())
<section class="relative overflow-hidden bg-gray-50 py-20 lg:py-28">
    <div class="absolute -top-20 -end-20 h-80 w-80 rounded-full bg-gold/5 blur-3xl"></div>
    <div class="absolute -bottom-20 -start-20 h-80 w-80 rounded-full bg-navy/5 blur-3xl"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center reveal">
            <span class="text-xs font-bold uppercase tracking-[0.3em] text-gold">{{ __('general.meet_team') ?? 'تعرّف على المتحدثين' }}</span>
            <h2 class="mt-3 section-title text-4xl font-extrabold text-navy lg:text-5xl">{{ __('general.our_speakers') }}</h2>
            <p class="mt-5 text-lg text-gray-600">{{ __('general.speakers_subtitle') }}</p>
        </div>

        <div class="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($speakers as $i => $speaker)
            <div class="group relative overflow-hidden rounded-3xl bg-white shadow-sm card-lift reveal" style="transition-delay: {{ $i * 80 }}ms">
                <div class="relative h-64 overflow-hidden bg-gradient-to-br from-navy to-navy-dark">
                    @if($speaker->photo)
                        <img src="{{ Storage::url($speaker->photo) }}" alt="{{ $speaker->name }}" class="h-full w-full object-cover transition duration-700 group-hover:scale-110">
                    @else
                        <div class="flex h-full items-center justify-center">
                            <svg class="h-20 w-20 text-white/20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/></svg>
                        </div>
                    @endif
                    {{-- Gradient overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/40 to-transparent opacity-70"></div>

                    {{-- Gold ribbon --}}
                    <span class="absolute top-4 end-4 rounded-full gradient-gold px-3 py-1 text-xs font-bold text-navy shadow-lg">
                        ★ {{ __('general.expert') ?? 'خبير' }}
                    </span>
                </div>

                <div class="p-6">
                    <h3 class="text-xl font-bold text-navy">{{ $speaker->name }}</h3>
                    <p class="mt-1 text-sm font-semibold text-gold">{{ $speaker->title }}</p>
                    <p class="mt-3 line-clamp-2 text-sm text-gray-600">{{ $speaker->short_bio }}</p>

                    <div class="mt-5 flex items-center justify-between border-t border-gray-100 pt-4">
                        <a href="{{ route('speakers.show', $speaker->slug) }}" class="group/btn inline-flex items-center gap-1.5 text-sm font-bold text-navy transition hover:text-gold">
                            {{ __('general.read_more') }}
                            <svg class="h-4 w-4 transition group-hover/btn:translate-x-1 rtl:rotate-180 rtl:group-hover/btn:-translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                        <div class="flex -space-x-2 rtl:space-x-reverse">
                            <span class="h-2 w-2 rounded-full bg-gold"></span>
                            <span class="h-2 w-2 rounded-full bg-gold/60"></span>
                            <span class="h-2 w-2 rounded-full bg-gold/30"></span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-12 text-center">
            <a href="{{ route('speakers') }}" class="btn-magnetic inline-flex items-center gap-2 rounded-2xl border-2 border-navy px-8 py-3 font-bold text-navy transition hover:bg-navy hover:text-gold">
                {{ __('general.view_all_speakers') }}
                <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
    </div>
</section>
@endif

{{-- =============== GUIDELINES =============== --}}
@if(isset($guidelines) && $guidelines->count())
<section class="border-y border-gray-100 py-12 overflow-hidden">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <p class="mb-8 text-center text-xs font-bold uppercase tracking-[0.3em] text-gray-400 reveal">{{ __('general.international_guidelines') }}</p>
        <div class="flex flex-wrap items-center justify-center gap-10 reveal">
            @foreach($guidelines as $guideline)
                @if($guideline->url)
                    <a href="{{ $guideline->url }}" target="_blank" rel="noopener noreferrer" class="group relative transition hover:scale-110">
                        <img src="{{ Storage::url($guideline->logo) }}" alt="{{ $guideline->name }}" class="h-12 max-w-[150px] object-contain grayscale opacity-50 transition group-hover:grayscale-0 group-hover:opacity-100">
                    </a>
                @else
                    <img src="{{ Storage::url($guideline->logo) }}" alt="{{ $guideline->name }}" class="h-12 max-w-[150px] object-contain grayscale opacity-50 transition hover:grayscale-0 hover:opacity-100">
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- =============== PROGRAM / PRICING =============== --}}
<section id="program" class="relative overflow-hidden py-20 lg:py-28">
    <div class="absolute inset-0 bg-grid opacity-30"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center reveal">
            <span class="text-xs font-bold uppercase tracking-[0.3em] text-gold">{{ __('general.our_pricing') ?? 'الباقات' }}</span>
            <h2 class="mt-3 section-title text-4xl font-extrabold text-navy lg:text-5xl">{{ __('general.program_overview') }}</h2>
            <p class="mt-5 text-lg text-gray-600">{{ __('general.program_subtitle') }}</p>
        </div>

        <div class="mx-auto mt-16 max-w-lg reveal">
            <div class="relative">
                {{-- Floating glow --}}
                <div class="absolute -inset-1 rounded-3xl gradient-gold opacity-30 blur-2xl animate-pulse-soft"></div>

                <div class="relative overflow-hidden rounded-3xl bg-white shadow-2xl">
                    {{-- Most popular badge --}}
                    <div class="absolute top-6 -end-12 rotate-45 gradient-gold px-12 py-1 text-xs font-bold text-navy shadow-lg">
                        {{ __('general.popular') ?? 'الأكثر طلباً' }}
                    </div>

                    <div class="gradient-navy relative px-8 py-10 text-center text-white">
                        <span class="text-sm font-medium uppercase tracking-wider text-gold">{{ __('general.full_access') }}</span>
                        <div class="mt-4 flex items-baseline justify-center gap-2">
                            <span class="text-6xl font-extrabold text-shimmer">899</span>
                            <span class="text-lg text-gold">{{ __('general.sar') }}</span>
                        </div>
                        <p class="mt-2 text-sm text-white/60">{{ __('general.one_time_payment') }}</p>
                    </div>

                    <div class="p-8">
                        <ul class="space-y-4 text-sm text-gray-700">
                            @foreach([
                                __('general.feature_levels'),
                                __('general.feature_videos'),
                                __('general.feature_exams'),
                                __('general.feature_certificates'),
                                __('general.feature_lifetime'),
                                __('general.feature_bilingual'),
                            ] as $i => $feature)
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-full gradient-gold">
                                    <svg class="h-3.5 w-3.5 text-navy" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </span>
                                <span class="font-medium">{{ $feature }}</span>
                            </li>
                            @endforeach
                        </ul>
                        <a href="{{ route('checkout') }}" class="btn-magnetic mt-8 flex items-center justify-center gap-2 rounded-2xl bg-navy py-4 font-bold text-white shadow-xl transition hover:bg-navy-light">
                            <svg class="h-5 w-5 text-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            {{ __('general.enroll_now') }}
                        </a>
                        <p class="mt-4 text-center text-xs text-gray-400">
                            <svg class="inline h-3 w-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            {{ __('general.secure_payment') ?? 'دفع آمن ومضمون' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =============== LEVELS / FRAMEWORK =============== --}}
@if(isset($levels) && $levels->count())
<section class="relative overflow-hidden gradient-navy py-20 text-white lg:py-28">
    <div class="absolute inset-0 stars-bg"></div>
    <div class="absolute inset-0 bg-grid opacity-20"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center reveal">
            <span class="text-xs font-bold uppercase tracking-[0.3em] text-gold">{{ __('general.framework') ?? 'الإطار التعليمي' }}</span>
            <h2 class="mt-3 section-title text-4xl font-extrabold text-gradient-gold lg:text-5xl">{{ __('general.learning_levels') }}</h2>
            <p class="mt-5 text-lg text-white/70">{{ __('general.levels_subtitle') }}</p>
        </div>

        <div class="mt-16 grid gap-6 md:grid-cols-3">
            @foreach($levels as $i => $level)
            <div class="group relative overflow-hidden rounded-3xl glass-dark p-7 transition hover:border-gold/40 reveal" style="transition-delay: {{ $i * 120 }}ms">
                {{-- Connector dots between cards (visual flow) --}}
                @if(!$loop->last)
                    <div class="absolute top-1/2 -end-3 hidden h-1 w-6 -translate-y-1/2 gradient-gold md:block z-10"></div>
                @endif

                <div class="relative flex items-center gap-4">
                    <div class="relative">
                        <div class="absolute inset-0 rounded-2xl gradient-gold blur-md opacity-50 group-hover:opacity-80 transition"></div>
                        <div class="relative flex h-14 w-14 items-center justify-center rounded-2xl gradient-gold text-2xl font-black text-navy shadow-xl">
                            {{ $level->order }}
                        </div>
                    </div>
                    <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-medium text-gold">
                        {{ __('general.level') ?? 'مستوى' }} {{ $level->order }}
                    </span>
                </div>

                <h3 class="mt-6 text-2xl font-bold text-white">{{ $level->title }}</h3>
                <p class="mt-3 text-sm leading-relaxed text-white/60">{{ $level->description }}</p>

                <div class="mt-6 grid grid-cols-2 gap-3 border-t border-white/10 pt-5 text-xs">
                    <div class="flex items-center gap-2 text-white/70">
                        <svg class="h-4 w-4 text-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        {{ $level->lectures_count ?? $level->lectures->count() }} {{ __('general.lectures') }}
                    </div>
                    <div class="flex items-center gap-2 text-white/70">
                        <svg class="h-4 w-4 text-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ __('general.pass_score') }}: {{ $level->passing_score }}%
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- =============== WHY CHOOSE US =============== --}}
<section class="py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center reveal">
            <span class="text-xs font-bold uppercase tracking-[0.3em] text-gold">{{ __('general.our_advantages') ?? 'مزايانا' }}</span>
            <h2 class="mt-3 section-title text-4xl font-extrabold text-navy lg:text-5xl">{{ __('general.why_choose_us') }}</h2>
        </div>

        <div class="mt-16 grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach([
                ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => __('general.self_paced'), 'desc' => __('general.self_paced_desc')],
                ['icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'title' => __('general.accredited'), 'desc' => __('general.accredited_desc')],
                ['icon' => 'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z', 'title' => __('general.video_lectures'), 'desc' => __('general.video_lectures_desc')],
                ['icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'title' => __('general.expert_speakers'), 'desc' => __('general.expert_speakers_desc')],
            ] as $i => $item)
            <div class="group text-center reveal" style="transition-delay: {{ $i * 100 }}ms">
                <div class="mx-auto relative">
                    <div class="absolute inset-0 rounded-full gradient-gold opacity-0 blur-2xl transition group-hover:opacity-50"></div>
                    <div class="relative mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-navy to-navy-light shadow-xl transition group-hover:scale-110 group-hover:rotate-6">
                        <svg class="h-9 w-9 text-gold" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/>
                        </svg>
                    </div>
                </div>
                <h3 class="mt-5 text-lg font-bold text-navy">{{ $item['title'] }}</h3>
                <p class="mt-2 text-sm text-gray-500">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =============== FAQs =============== --}}
@if(isset($faqs) && $faqs->count())
<section class="bg-gray-50 py-20 lg:py-28">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="text-center reveal">
            <span class="text-xs font-bold uppercase tracking-[0.3em] text-gold">FAQ</span>
            <h2 class="mt-3 section-title text-4xl font-extrabold text-navy lg:text-5xl">{{ __('general.faqs') }}</h2>
            <p class="mt-4 text-gray-600">{{ __('general.faqs_subtitle') ?? 'إجابات عن الأسئلة الشائعة' }}</p>
        </div>

        <div class="mt-12 space-y-3" x-data="{ open: 0 }">
            @foreach($faqs as $i => $faq)
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white transition hover:border-gold/40 hover:shadow-lg reveal" style="transition-delay: {{ $i * 60 }}ms">
                <button @click="open === {{ $i }} ? open = null : open = {{ $i }}" class="flex w-full items-center justify-between gap-4 px-6 py-5 text-start transition">
                    <span class="flex items-center gap-3">
                        <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full gradient-gold text-xs font-bold text-navy">
                            {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <span class="font-semibold text-navy">{{ $faq->question }}</span>
                    </span>
                    <span :class="open === {{ $i }} && 'rotate-45'" class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-gold/10 text-gold transition-transform">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    </span>
                </button>
                <div x-show="open === {{ $i }}" x-collapse class="border-t border-gray-100 bg-gradient-to-br from-gray-50 to-white px-6 py-5 text-sm leading-relaxed text-gray-600">
                    <div class="ps-11">
                        {{ $faq->answer }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- =============== CTA =============== --}}
<section class="relative overflow-hidden mesh-bg py-20 lg:py-28">
    <div class="absolute inset-0 bg-grid opacity-20"></div>
    <div class="floater gradient-gold w-72 h-72 -top-20 start-1/2 -translate-x-1/2 opacity-30"></div>

    <div class="relative mx-auto max-w-4xl px-4 text-center reveal">
        <span class="inline-flex items-center gap-2 rounded-full glass px-4 py-1.5 text-xs font-medium text-gold">
            <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"/></svg>
            {{ __('general.ready_to_start') ?? 'جاهز للبداية؟' }}
        </span>
        <h2 class="mt-6 text-4xl font-extrabold text-white lg:text-5xl">{{ __('general.cta_title') }}</h2>
        <p class="mt-4 text-lg text-white/70">{{ __('general.cta_subtitle') }}</p>
        <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
            <a href="{{ route('register') }}" class="btn-magnetic group inline-flex items-center gap-2 rounded-2xl gradient-gold px-10 py-4 font-bold text-navy shadow-2xl glow-gold-hover">
                {{ __('general.register_now') }}
                <svg class="h-5 w-5 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-2xl border-2 border-white/30 px-10 py-4 font-bold text-white transition hover:border-gold hover:text-gold">
                {{ __('general.contact_us') }}
            </a>
        </div>
    </div>
</section>

@endsection
