<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('seo')
    <title>@yield('title', config('app.name', 'Restrack'))</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <style>
        [data-navbar].is-scrolled {
            background-color: rgba(14, 26, 53, 0.85);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            box-shadow: 0 8px 32px -8px rgba(0,0,0,0.35);
        }
        [data-navbar] {
            transition: background-color .3s ease, box-shadow .3s ease, padding .3s ease;
        }
    </style>
</head>
<body class="min-h-screen bg-white text-gray-800 antialiased">

    @include('partials.icons')

    {{-- Announcement bar (admin-managed; falls back to the CTA strip when none is active) --}}
    @if(($announcementBar ?? null))
        @include('partials.announcement-bar', ['a' => $announcementBar])
    @else
        <div class="gradient-gold text-navy text-center text-xs sm:text-sm py-2 px-4 font-medium">
            <span class="inline-flex items-center gap-2">
                <svg class="h-4 w-4 animate-pulse-soft" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.539 1.118L10 13.347l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.363-1.118L3.566 7.819c-.783-.57-.38-1.81.589-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                <span>{{ __('general.cta_subtitle') }}</span>
                <a href="{{ route('register') }}" class="underline font-bold hover:text-navy-dark">{{ __('general.register_now') }} →</a>
            </span>
        </div>
    @endif

    {{-- Navbar --}}
    <nav data-navbar class="sticky top-0 z-50 bg-navy" x-data="{ open: false }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 lg:h-20 items-center justify-between">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="group flex items-center gap-3">
                    <div class="relative">
                        <div class="absolute inset-0 rounded-xl bg-gold/30 blur-md opacity-0 group-hover:opacity-100 transition"></div>
                        <div class="relative flex h-10 w-10 items-center justify-center rounded-xl gradient-gold shadow-lg">
                            <span class="text-lg font-extrabold text-navy">R</span>
                        </div>
                    </div>
                    <div class="flex flex-col leading-tight">
                        <span class="text-xl font-extrabold text-shimmer">Restrack</span>
                        <span class="text-[10px] uppercase tracking-[0.2em] text-gold/70 hidden sm:block">Learn • Grow • Certify</span>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden items-center gap-1 lg:flex">
                    @php
                        $navLinks = [
                            ['route' => 'home',     'label' => __('general.home')],
                            ['route' => 'speakers', 'label' => __('general.speakers')],
                            ['route' => 'contact',  'label' => __('general.contact')],
                        ];
                    @endphp

                    @foreach($navLinks as $link)
                        @php $active = request()->routeIs($link['route']); @endphp
                        <a href="{{ route($link['route']) }}"
                           class="link-underline relative rounded-lg px-4 py-2 text-sm font-medium transition {{ $active ? 'text-gold' : 'text-white/85 hover:text-gold' }}">
                            {{ $link['label'] }}
                            @if($active)
                                <span class="absolute inset-x-3 -bottom-1 h-0.5 rounded-full bg-gold"></span>
                            @endif
                        </a>
                    @endforeach
                </div>

                {{-- Desktop right side --}}
                <div class="hidden items-center gap-3 lg:flex">
                    {{-- Language switcher --}}
                    <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                       class="group inline-flex items-center gap-1.5 rounded-lg border border-gold/30 px-3 py-1.5 text-xs font-semibold text-gold transition hover:bg-gold/10 hover:border-gold">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/></svg>
                        {{ app()->getLocale() === 'ar' ? 'EN' : 'عربي' }}
                    </a>

                    @guest
                        <a href="{{ route('login') }}" class="rounded-lg px-4 py-2 text-sm font-medium text-white/85 transition hover:text-gold">
                            {{ __('general.login') }}
                        </a>
                        <a href="{{ route('register') }}" class="btn-magnetic gradient-gold inline-flex items-center gap-2 rounded-xl px-5 py-2.5 text-sm font-bold text-navy shadow-lg glow-gold-hover">
                            {{ __('general.register') }}
                            <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </a>
                    @else
                        <div class="relative" x-data="{ menu: false }" @click.outside="menu = false">
                            <button @click="menu = !menu" class="flex items-center gap-2 rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-sm text-white transition hover:border-gold/40 hover:bg-white/10">
                                <span class="flex h-8 w-8 items-center justify-center rounded-lg gradient-gold text-xs font-bold text-navy">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                                <span class="hidden sm:block">{{ Str::limit(auth()->user()->name, 14) }}</span>
                                <svg :class="menu && 'rotate-180'" class="h-4 w-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            <div x-show="menu" x-transition x-cloak
                                 class="absolute end-0 mt-2 w-56 overflow-hidden rounded-xl border border-gray-100 bg-white shadow-2xl">
                                <div class="border-b border-gray-100 bg-gradient-to-br from-navy to-navy-dark px-4 py-3">
                                    <p class="text-xs text-white/60">{{ __('general.welcome_back') }}</p>
                                    <p class="text-sm font-semibold text-gold">{{ auth()->user()->name }}</p>
                                </div>
                                @if(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin'))
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 transition hover:bg-gold/5 hover:text-gold">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6V4m0 16v-2m6-6h2M4 12h2m12.95-6.95l-1.414 1.414M5.464 18.536l1.414-1.414M18.536 18.536l-1.414-1.414M5.464 5.464l1.414 1.414"/></svg>
                                        {{ __('general.admin_panel') }}
                                    </a>
                                @endif
                                <a href="{{ route('student.dashboard') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 transition hover:bg-gold/5 hover:text-gold">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                    {{ __('general.dashboard') }}
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center gap-2 border-t border-gray-100 px-4 py-2.5 text-start text-sm text-red-600 transition hover:bg-red-50">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                        {{ __('general.logout') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>

                {{-- Mobile toggle --}}
                <button @click="open = !open" class="lg:hidden inline-flex h-10 w-10 items-center justify-center rounded-lg border border-white/10 text-white hover:border-gold/40">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Nav --}}
        <div x-show="open" x-transition x-cloak class="lg:hidden border-t border-white/10 bg-navy-dark">
            <div class="space-y-1 px-4 pb-4 pt-3">
                <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2.5 text-sm text-white/85 hover:bg-white/5 hover:text-gold">{{ __('general.home') }}</a>
                <a href="{{ route('speakers') }}" class="block rounded-lg px-3 py-2.5 text-sm text-white/85 hover:bg-white/5 hover:text-gold">{{ __('general.speakers') }}</a>
                <a href="{{ route('contact') }}" class="block rounded-lg px-3 py-2.5 text-sm text-white/85 hover:bg-white/5 hover:text-gold">{{ __('general.contact') }}</a>
                <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}" class="block rounded-lg px-3 py-2.5 text-sm text-gold hover:bg-white/5">
                    {{ app()->getLocale() === 'ar' ? 'English' : 'عربي' }}
                </a>
                @guest
                    <a href="{{ route('login') }}" class="block rounded-lg px-3 py-2.5 text-sm text-white/85 hover:bg-white/5 hover:text-gold">{{ __('general.login') }}</a>
                    <a href="{{ route('register') }}" class="mt-2 block rounded-lg gradient-gold px-3 py-2.5 text-center text-sm font-bold text-navy">{{ __('general.register') }}</a>
                @else
                    <a href="{{ route('student.dashboard') }}" class="block rounded-lg px-3 py-2.5 text-sm text-white/85 hover:bg-white/5 hover:text-gold">{{ __('general.dashboard') }}</a>
                    @if(auth()->user()->hasRole('super_admin') || auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="block rounded-lg px-3 py-2.5 text-sm text-white/85 hover:bg-white/5 hover:text-gold">{{ __('general.admin_panel') }}</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full rounded-lg px-3 py-2.5 text-start text-sm text-red-300 hover:bg-red-500/10">{{ __('general.logout') }}</button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="mx-auto max-w-7xl px-4 pt-4">
            <div class="animate-fade-up flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700 shadow-sm">
                <svg class="h-5 w-5 shrink-0 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif
    @if(session('error'))
        <div class="mx-auto max-w-7xl px-4 pt-4">
            <div class="animate-fade-up flex items-start gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 shadow-sm">
                <svg class="h-5 w-5 shrink-0 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

    {{-- Main content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="relative mt-20 overflow-hidden bg-navy-dark text-white/70">
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
                            <p class="text-[10px] uppercase tracking-[0.2em] text-gold/70">Learn • Grow • Certify</p>
                        </div>
                    </div>
                    <p class="mt-4 text-sm leading-relaxed">{{ __('general.footer_description') }}</p>

                    {{-- Social --}}
                    <div class="mt-5 flex items-center gap-2">
                        @foreach([
                            ['name' => 'twitter',  'path' => 'M22 4.01c-1 .49-1.98.689-3 .99-1.121-1.265-2.783-1.335-4.38-.737S11.977 6.323 12 8v1c-3.245.083-6.135-1.395-8-4 0 0-4.182 7.433 4 11-1.872 1.247-3.739 2.088-6 2 3.308 1.803 6.913 2.423 10.034 1.517 3.58-1.04 6.522-3.723 7.651-7.742a13.84 13.84 0 0 0 .497 -3.753c0-.249 1.51-2.772 1.818-4.013z'],
                            ['name' => 'linkedin', 'path' => 'M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2zM4 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z'],
                            ['name' => 'instagram','path' => 'M17 2H7a5 5 0 0 0-5 5v10a5 5 0 0 0 5 5h10a5 5 0 0 0 5-5V7a5 5 0 0 0-5-5zm-5 13a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm5-9a1 1 0 1 1 0-2 1 1 0 0 1 0 2z'],
                            ['name' => 'youtube',  'path' => 'M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33zM9.75 15.02V8.48l5.75 3.27z'],
                        ] as $s)
                            <a href="#" aria-label="{{ $s['name'] }}" class="group flex h-9 w-9 items-center justify-center rounded-lg border border-white/10 transition hover:border-gold hover:bg-gold/10">
                                <svg class="h-4 w-4 text-white/70 transition group-hover:text-gold" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $s['path'] }}"/></svg>
                            </a>
                        @endforeach
                    </div>
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
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gold/10 text-gold">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </span>
                            <div>
                                <p class="text-xs text-white/50">{{ __('general.email') }}</p>
                                <a href="mailto:info@restrack.sa" class="hover:text-gold">info@restrack.sa</a>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gold/10 text-gold">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </span>
                            <div>
                                <p class="text-xs text-white/50">{{ __('general.location') ?? 'الموقع' }}</p>
                                <span>{{ __('general.saudi_arabia') ?? 'المملكة العربية السعودية' }}</span>
                            </div>
                        </li>
                    </ul>
                </div>

                {{-- Newsletter --}}
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white">
                        <span class="border-b-2 border-gold pb-1">{{ __('general.stay_updated') ?? 'ابقَ على اطلاع' }}</span>
                    </h4>
                    <p class="mt-5 text-sm leading-relaxed">{{ __('general.newsletter_desc') ?? 'اشترك ليصلك كل جديد من الدورات والشهادات.' }}</p>
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
    </footer>

    {{-- Glass bottom navigation (mobile/tablet app feel) --}}
    @php
        $bottomNav = [
            ['label' => __('general.home'),     'url' => route('home'),     'icon' => 'i-home',  'active' => request()->routeIs('home')],
            ['label' => __('general.speakers'), 'url' => route('speakers'), 'icon' => 'i-users', 'active' => request()->routeIs('speakers') || request()->routeIs('speakers.*')],
            ['label' => __('general.contact'),  'url' => route('contact'),  'icon' => 'i-mail',  'active' => request()->routeIs('contact')],
        ];
        if (auth()->check()) {
            $bottomNav[] = ['label' => __('general.dashboard'), 'url' => route('student.dashboard'), 'icon' => 'i-grid', 'active' => false];
        } else {
            $bottomNav[] = ['label' => __('general.login'), 'url' => route('login'), 'icon' => 'i-login', 'active' => request()->routeIs('login')];
        }
    @endphp
    <div class="bottom-nav-spacer"></div>
    @include('partials.bottom-nav', ['items' => $bottomNav])

    {{-- Announcement popup (admin-managed) --}}
    @include('partials.announcement-popup', ['a' => $announcementPopup ?? null])

    {{-- Back to top button --}}
    <button onclick="window.scrollTo({top:0, behavior:'smooth'})"
            class="fixed bottom-24 end-4 lg:bottom-6 lg:end-6 z-40 flex h-12 w-12 items-center justify-center rounded-full gradient-gold text-navy shadow-2xl glow-gold-hover transition-opacity"
            aria-label="back to top">
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"/></svg>
    </button>

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')

    <style>[x-cloak]{display:none!important}</style>
</body>
</html>
