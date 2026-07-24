{{-- ============================================================
     PREMIUM GLASS HERO — cinematic navy aurora, gold headline,
     mission-control glass card. Self-contained fragment.
     Inherits: $sections (keyed by section_key), $levels …
     ============================================================ --}}
@php
    $hero      = $sections['hero'] ?? null;
    $isAr      = app()->getLocale() === 'ar';
    $heroTitle = $hero?->title    ?: 'Research Track Platform';
    $heroSub   = $hero?->subtitle ?: 'From Beginner to Expert in Medical Research';
    $heroLead  = $isAr
        ? 'منصة عربية فاخرة لإتقان البحث الطبي — اشتراك واحد يفتح المسار كاملاً، بمحاضرات مسجّلة ومحتوى محميّ.'
        : 'A premium Arabic platform to master medical research — one subscription unlocks the whole track, with recorded lectures and protected content.';
    $ctaText   = $hero?->cta_text ?: ($isAr ? 'ابدأ رحلتك الآن' : 'Start your journey');
@endphp

<style>
    /* scoped to the premium hero — self-contained, no global edits */
    .rt-hero { position: relative; isolation: isolate; overflow: hidden; }
    .rt-hero__aurora { position: absolute; inset: 0; z-index: -2; overflow: hidden;
        background: radial-gradient(130% 100% at 78% -8%, #14224a, #0e1a35 46%, #070d1c 100%); }
    .rt-hero__orb { position: absolute; border-radius: 50%; filter: blur(90px); opacity: .5; will-change: transform; }
    .rt-hero__orb.v { width: 520px; height: 520px; background: #6f5cf6; inset-block-start: -140px; inset-inline-end: -90px; animation: rt-drift1 26s ease-in-out infinite; }
    .rt-hero__orb.t { width: 440px; height: 440px; background: #10b4a0; inset-block-end: -160px; inset-inline-start: -110px; animation: rt-drift2 32s ease-in-out infinite; }
    .rt-hero__orb.g { width: 340px; height: 340px; background: #caa23a; inset-block-start: 34%; inset-inline-start: 42%; opacity: .34; animation: rt-drift3 38s ease-in-out infinite; }
    .rt-hero__grain { position: absolute; inset: 0; z-index: -1; pointer-events: none; opacity: .04;
        background-image: radial-gradient(rgba(255,255,255,.9) .5px, transparent .5px); background-size: 3px 3px; }
    @keyframes rt-drift1 { 50% { transform: translate3d(-60px,50px,0) scale(1.08); } }
    @keyframes rt-drift2 { 50% { transform: translate3d(70px,-40px,0) scale(1.1); } }
    @keyframes rt-drift3 { 50% { transform: translate3d(-40px,-50px,0) scale(1.12); } }

    .rt-livedot { width: 7px; height: 7px; border-radius: 50%; background: #37d9c4;
        box-shadow: 0 0 0 0 rgba(55,217,196,.5); animation: rt-pulse 2.6s infinite; }
    @keyframes rt-pulse { 70% { box-shadow: 0 0 0 8px rgba(55,217,196,0); } 100% { box-shadow: 0 0 0 0 rgba(55,217,196,0); } }

    /* mission-control progress ring */
    .rt-ring__track { fill: none; stroke: rgba(255,255,255,.12); stroke-width: 9; }
    .rt-ring__prog  { fill: none; stroke: url(#rt-ring-grad); stroke-width: 9; stroke-linecap: round;
        stroke-dasharray: 264; stroke-dashoffset: 264; transform: rotate(-90deg); transform-origin: 50% 50%;
        animation: rt-ring 1.6s cubic-bezier(.2,.7,.2,1) .3s forwards; }
    @keyframes rt-ring { to { stroke-dashoffset: 79; } }

    @media (prefers-reduced-motion: reduce) {
        .rt-hero__orb { animation: none !important; }
        .rt-ring__prog { animation: none !important; stroke-dashoffset: 79; }
        .rt-livedot { animation: none !important; }
    }
</style>

<section class="rt-hero theme-t">
    <div class="rt-hero__aurora">
        <span class="rt-hero__orb v"></span>
        <span class="rt-hero__orb t"></span>
        <span class="rt-hero__orb g"></span>
    </div>
    <div class="rt-hero__grain"></div>

    <div class="mx-auto w-full max-w-6xl px-6 py-20 lg:py-28">
        <div class="grid items-center gap-10 lg:grid-cols-[1.12fr_.88fr] lg:gap-12">

            {{-- ---------- copy column ---------- --}}
            <div class="reveal">
                {{-- live badge --}}
                <span class="glass-dark flex w-fit max-w-full items-center gap-2 rounded-2xl px-3.5 py-2 text-[11px] font-extrabold leading-snug text-white sm:text-xs">
                    <span class="rt-livedot flex-none"></span>
                    <svg class="h-4 w-4 flex-none text-gold" aria-hidden="true"><use href="#i-sparkle"/></svg>
                    {{ $isAr ? 'محاضرات مسجّلة · محتوى محميّ · محاولات لا محدودة' : 'Recorded lectures · Protected content · Unlimited attempts' }}
                </span>

                <h1 class="mt-5 text-4xl font-extrabold leading-[1.08] tracking-tight sm:text-5xl lg:text-6xl">
                    <span class="text-gradient-gold lg:whitespace-nowrap">{{ $heroTitle }}</span>
                </h1>

                <p class="mt-3 text-xl font-bold text-white sm:text-2xl">{{ $heroSub }}</p>

                <p class="mt-5 max-w-xl text-base leading-relaxed text-white/70">{{ $heroLead }}</p>

                {{-- CTAs --}}
                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="{{ route('register') }}"
                       class="btn-magnetic gradient-gold inline-flex items-center gap-2 rounded-2xl px-7 py-3.5 text-sm font-extrabold text-navy-dark shadow-lg glow-gold-hover">
                        {{ $ctaText }}
                        <svg class="h-[18px] w-[18px] rtl:rotate-180" aria-hidden="true"><use href="#i-arrow"/></svg>
                    </a>
                    <a href="{{ route('program') }}"
                       class="glass-dark inline-flex items-center gap-2 rounded-2xl px-7 py-3.5 text-sm font-extrabold text-white transition hover:text-gold">
                        {{ $isAr ? 'استعرض البرنامج' : 'Explore the program' }}
                        <svg class="h-[18px] w-[18px] rtl:rotate-180" aria-hidden="true"><use href="#i-arrow"/></svg>
                    </a>
                </div>

                {{-- trust chips --}}
                <div class="mt-9 flex flex-wrap gap-2.5">
                    <span class="glass-dark inline-flex items-center gap-2 rounded-full px-3.5 py-2 text-xs font-bold text-white/80">
                        <svg class="h-4 w-4 text-teal" aria-hidden="true"><use href="#i-video"/></svg>
                        {{ $isAr ? 'محاضرات مسجّلة تُعاد متى شئت' : 'Recorded lectures, rewatch anytime' }}
                    </span>
                    <span class="glass-dark inline-flex items-center gap-2 rounded-full px-3.5 py-2 text-xs font-bold text-white/80">
                        <svg class="h-4 w-4 text-teal" aria-hidden="true"><use href="#i-infinity"/></svg>
                        {{ $isAr ? 'محاولات اختبار لا محدودة' : 'Unlimited exam attempts' }}
                    </span>
                    <span class="glass-dark inline-flex items-center gap-2 rounded-full px-3.5 py-2 text-xs font-bold text-white/80">
                        <svg class="h-4 w-4 text-teal" aria-hidden="true"><use href="#i-award"/></svg>
                        {{ $isAr ? 'شهادة إكمال موثّقة' : 'Verified certificate of completion' }}
                    </span>
                </div>
            </div>

            {{-- ---------- mission-control card (lg+ only) ---------- --}}
            <div class="reveal hidden lg:block">
                <div class="glass-dark glass-sheen tilt card-lift rounded-3xl p-6">
                    <div class="flex items-center justify-between">
                        <b class="text-base font-extrabold text-white">{{ $isAr ? 'لوحتي' : 'My dashboard' }}</b>
                        <span class="text-xs font-semibold text-white/50">{{ $isAr ? 'اليوم' : 'Today' }}</span>
                    </div>

                    {{-- progress ring --}}
                    <div class="mt-4 flex items-center gap-4">
                        <svg class="h-24 w-24 flex-none" viewBox="0 0 100 100" aria-hidden="true">
                            <defs>
                                <linearGradient id="rt-ring-grad" x1="0" y1="0" x2="1" y2="1">
                                    <stop offset="0" stop-color="#B9932F"/><stop offset="1" stop-color="#F0D48A"/>
                                </linearGradient>
                            </defs>
                            <circle class="rt-ring__track" cx="50" cy="50" r="42"/>
                            <circle class="rt-ring__prog"  cx="50" cy="50" r="42"/>
                        </svg>
                        <div>
                            <b class="text-3xl font-extrabold text-white" data-counter="70" data-suffix="%" style="font-variant-numeric:tabular-nums">0%</b>
                            <span class="block text-sm text-white/50">{{ $isAr ? 'تقدّم المستوى الأول' : 'Level 1 progress' }}</span>
                        </div>
                    </div>

                    {{-- stat chips --}}
                    <div class="mt-4 grid grid-cols-2 gap-2.5">
                        <div class="glass-dark flex items-center gap-2.5 rounded-2xl px-3 py-2.5">
                            <svg class="h-5 w-5 flex-none text-gold" aria-hidden="true"><use href="#i-flame"/></svg>
                            <div>
                                <b class="block text-lg font-extrabold leading-tight text-white" data-counter="12" style="font-variant-numeric:tabular-nums">0</b>
                                <span class="text-[11px] text-white/50">{{ $isAr ? 'يوم متتالٍ' : 'day streak' }}</span>
                            </div>
                        </div>
                        <div class="glass-dark flex items-center gap-2.5 rounded-2xl px-3 py-2.5">
                            <svg class="h-5 w-5 flex-none text-violet" aria-hidden="true"><use href="#i-chart"/></svg>
                            <div>
                                <b class="block text-lg font-extrabold leading-tight text-white" data-counter="86" data-suffix="%" style="font-variant-numeric:tabular-nums">0%</b>
                                <span class="text-[11px] text-white/50">{{ $isAr ? 'متوسط الاختبارات' : 'avg score' }}</span>
                            </div>
                        </div>
                        <div class="glass-dark flex items-center gap-2.5 rounded-2xl px-3 py-2.5">
                            <svg class="h-5 w-5 flex-none text-teal" aria-hidden="true"><use href="#i-video"/></svg>
                            <div>
                                <b class="block text-lg font-extrabold leading-tight text-white" data-counter="24" style="font-variant-numeric:tabular-nums">0</b>
                                <span class="text-[11px] text-white/50">{{ $isAr ? 'محاضرة مكتملة' : 'lectures done' }}</span>
                            </div>
                        </div>
                        <div class="glass-dark flex items-center gap-2.5 rounded-2xl px-3 py-2.5">
                            <svg class="h-5 w-5 flex-none text-gold" aria-hidden="true"><use href="#i-award"/></svg>
                            <div>
                                <b class="block text-sm font-extrabold leading-tight text-white">{{ $isAr ? 'شهادتي' : 'Certificate' }}</b>
                                <span class="text-[11px] text-white/50">{{ $isAr ? 'عند الإكمال' : 'on completion' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
