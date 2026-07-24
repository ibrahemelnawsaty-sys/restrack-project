{{--
    Public site footer — admin-editable via SiteSetting.
    Included INSIDE the <footer> element by the layout. Every editable piece reads
    from the globally-shared $siteSettings (AppServiceProvider) with graceful fallbacks
    to the previous hard-coded copy / lang keys, so nothing is lost if a setting is unset.
--}}
@php
    $isAr = app()->getLocale() === 'ar';

    $tagline        = optional($siteSettings->get('tagline'))->value        ?? ($isAr ? 'تعلّم • تطوّر • احترف' : 'Learn • Grow • Certify');
    $footerAbout    = optional($siteSettings->get('footer_about'))->value    ?? __('general.footer_description');
    $footerEmail    = optional($siteSettings->get('footer_email'))->value    ?? 'info@restrack.sa';
    $footerPhone    = optional($siteSettings->get('footer_phone'))->value;
    $footerAddress  = optional($siteSettings->get('footer_address'))->value  ?? ($isAr ? 'المملكة العربية السعودية' : 'Saudi Arabia');
    $newsletterDesc = optional($siteSettings->get('newsletter_desc'))->value ?? ($isAr ? 'اشترك ليصلك كل جديد من الدورات والشهادات.' : 'Subscribe for the latest courses and certifications.');

    $socials = [
        ['key' => 'social_twitter',   'name' => 'twitter',   'path' => 'M22 4.01c-1 .49-1.98.689-3 .99-1.121-1.265-2.783-1.335-4.38-.737S11.977 6.323 12 8v1c-3.245.083-6.135-1.395-8-4 0 0-4.182 7.433 4 11-1.872 1.247-3.739 2.088-6 2 3.308 1.803 6.913 2.423 10.034 1.517 3.58-1.04 6.522-3.723 7.651-7.742a13.84 13.84 0 0 0 .497 -3.753c0-.249 1.51-2.772 1.818-4.013z'],
        ['key' => 'social_linkedin',  'name' => 'linkedin',  'path' => 'M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2zM4 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z'],
        ['key' => 'social_instagram', 'name' => 'instagram', 'path' => 'M17 2H7a5 5 0 0 0-5 5v10a5 5 0 0 0 5 5h10a5 5 0 0 0 5-5V7a5 5 0 0 0-5-5zm-5 13a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm5-9a1 1 0 1 1 0-2 1 1 0 0 1 0 2z'],
        ['key' => 'social_youtube',   'name' => 'youtube',   'path' => 'M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33zM9.75 15.02V8.48l5.75 3.27z'],
    ];
    $socials = collect($socials)
        ->map(fn ($s) => $s + ['url' => optional($siteSettings->get($s['key']))->value])
        ->filter(fn ($s) => filled($s['url']));
@endphp

{{-- Decorative top wave --}}
<div class="absolute inset-x-0 top-0 -translate-y-px">
    <svg class="w-full h-12" viewBox="0 0 1440 60" preserveAspectRatio="none" fill="none">
        <path d="M0,32 C240,80 480,0 720,32 C960,64 1200,16 1440,40 L1440,0 L0,0 Z" fill="#ffffff"/>
    </svg>
</div>

{{-- Decorative blobs --}}
<div class="floater gradient-gold w-72 h-72 -top-20 -start-20"></div>
<div class="floater bg-navy-light w-96 h-96 bottom-0 end-0"></div>

<div class="relative mx-auto max-w-7xl px-4 pt-20 pb-8 sm:px-6 lg:px-8">
    <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-4">
        {{-- Brand --}}
        <div class="lg:col-span-1">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl gradient-gold shadow-lg">
                    <span class="text-xl font-extrabold text-navy">R</span>
                </div>
                <div>
                    <h3 class="text-2xl font-extrabold text-shimmer">Restrack</h3>
                    <p class="text-[10px] uppercase tracking-[0.2em] text-gold/70">{{ $tagline }}</p>
                </div>
            </div>
            <p class="mt-4 text-sm leading-relaxed">{{ $footerAbout }}</p>

            {{-- Social --}}
            @if($socials->isNotEmpty())
                <div class="mt-5 flex items-center gap-2">
                    @foreach($socials as $s)
                        <a href="{{ $s['url'] }}" target="_blank" rel="noopener" aria-label="{{ $s['name'] }}" class="group flex h-9 w-9 items-center justify-center rounded-lg border border-white/10 transition hover:border-gold hover:bg-gold/10">
                            <svg class="h-4 w-4 text-white/70 transition group-hover:text-gold" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $s['path'] }}"/></svg>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Quick Links --}}
        <div>
            <h4 class="text-sm font-bold uppercase tracking-wider text-white">
                <span class="border-b-2 border-gold pb-1">{{ __('general.quick_links') }}</span>
            </h4>
            <ul class="mt-5 space-y-2.5 text-sm">
                <li><a href="{{ route('home') }}" class="link-underline inline-flex items-center gap-1.5 transition hover:text-gold"><span class="text-gold">›</span> {{ __('general.home') }}</a></li>
                <li><a href="{{ route('speakers') }}" class="link-underline inline-flex items-center gap-1.5 transition hover:text-gold"><span class="text-gold">›</span> {{ __('general.speakers') }}</a></li>
                <li><a href="{{ route('contact') }}" class="link-underline inline-flex items-center gap-1.5 transition hover:text-gold"><span class="text-gold">›</span> {{ __('general.contact') }}</a></li>
                @guest
                    <li><a href="{{ route('register') }}" class="link-underline inline-flex items-center gap-1.5 transition hover:text-gold"><span class="text-gold">›</span> {{ __('general.register') }}</a></li>
                @endguest
            </ul>
        </div>

        {{-- Contact --}}
        <div>
            <h4 class="text-sm font-bold uppercase tracking-wider text-white">
                <span class="border-b-2 border-gold pb-1">{{ __('general.contact_us') }}</span>
            </h4>
            <ul class="mt-5 space-y-3 text-sm">
                {{-- Email --}}
                <li class="flex items-start gap-3">
                    <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gold/10 text-gold">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </span>
                    <div>
                        <p class="text-xs text-white/50">{{ __('general.email') }}</p>
                        <a href="mailto:{{ $footerEmail }}" class="hover:text-gold">{{ $footerEmail }}</a>
                    </div>
                </li>
                {{-- Phone (only when set) --}}
                @if(filled($footerPhone))
                    <li class="flex items-start gap-3">
                        <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gold/10 text-gold">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </span>
                        <div>
                            <p class="text-xs text-white/50">{{ __('general.phone') }}</p>
                            <a href="tel:{{ preg_replace('/[^0-9+]/', '', $footerPhone) }}" class="hover:text-gold" dir="ltr">{{ $footerPhone }}</a>
                        </div>
                    </li>
                @endif
                {{-- Address --}}
                <li class="flex items-start gap-3">
                    <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gold/10 text-gold">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </span>
                    <div>
                        <p class="text-xs text-white/50">{{ __('general.location') ?? 'الموقع' }}</p>
                        <span>{{ $footerAddress }}</span>
                    </div>
                </li>
            </ul>
        </div>

        {{-- Newsletter --}}
        <div>
            <h4 class="text-sm font-bold uppercase tracking-wider text-white">
                <span class="border-b-2 border-gold pb-1">{{ __('general.stay_updated') ?? 'ابقَ على اطلاع' }}</span>
            </h4>
            <p class="mt-5 text-sm leading-relaxed">{{ $newsletterDesc }}</p>
            <form class="mt-4 flex overflow-hidden rounded-xl border border-white/10 bg-white/5 focus-within:border-gold transition">
                <input type="email" placeholder="{{ __('general.email') }}" class="flex-1 bg-transparent px-4 py-2.5 text-sm text-white placeholder-white/40 focus:outline-none">
                <button type="submit" class="gradient-gold px-4 text-navy" aria-label="subscribe">
                    <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </button>
            </form>
        </div>
    </div>

    <div class="mt-12 flex flex-col items-center justify-between gap-3 border-t border-white/10 pt-6 sm:flex-row">
        <p class="text-sm text-center sm:text-start">&copy; {{ date('Y') }} <span class="text-gold font-semibold">Restrack</span>. {{ __('general.all_rights_reserved') }}</p>
        <p class="text-xs text-white/40">
            {{ __('general.made_with') ?? 'صُنع بشغف' }} <span class="text-gold">♥</span> {{ __('general.in_ksa') ?? 'في المملكة' }}
        </p>
    </div>
</div>
