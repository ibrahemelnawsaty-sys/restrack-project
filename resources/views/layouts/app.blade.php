<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('seo')
    <title>@yield('title', config('app.name', 'Restrack'))</title>
    @include('partials.seo-head')

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <style>
        /* Premium glass navbar (matches restrack-project/design/mockups/03-premium-glass.html) */
        [data-navbar] {
            background: rgba(11, 20, 40, 0.55);
            -webkit-backdrop-filter: blur(18px) saturate(165%);
            backdrop-filter: blur(18px) saturate(165%);
            border-bottom: 1px solid rgba(212, 180, 90, 0.14);
            transition: background-color .35s ease, box-shadow .35s ease, border-color .35s ease;
        }
        [data-navbar].is-scrolled {
            background: rgba(9, 16, 33, 0.82);
            border-bottom-color: rgba(212, 180, 90, 0.24);
            box-shadow: 0 12px 34px -14px rgba(0, 0, 0, 0.5);
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
    <nav data-navbar class="sticky top-0 z-50" x-data="{ open: false }">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 lg:h-20 items-center justify-between">
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="group flex items-center gap-3">
                    <span class="relative grid h-11 w-11 place-items-center rounded-2xl bg-white/5 shadow-lg ring-1 ring-gold/25 transition duration-500 group-hover:-rotate-3 group-hover:ring-gold/60">
                        <span class="absolute inset-0 rounded-2xl bg-gold/25 opacity-0 blur-md transition group-hover:opacity-100"></span>
                        <svg class="relative h-6 w-6" viewBox="0 0 40 40" aria-hidden="true">
                            <defs><linearGradient id="rt-navlogo" x1="0" y1="1" x2="1" y2="0"><stop offset="0" stop-color="#B9932F"/><stop offset="1" stop-color="#8B7CFF"/></linearGradient></defs>
                            <rect x="6" y="22" width="6" height="12" rx="3" fill="url(#rt-navlogo)"/>
                            <rect x="17" y="13" width="6" height="21" rx="3" fill="url(#rt-navlogo)"/>
                            <rect x="28" y="5" width="6" height="29" rx="3" fill="url(#rt-navlogo)"/>
                        </svg>
                    </span>
                    <div class="flex flex-col leading-tight">
                        <span class="text-xl font-extrabold text-shimmer">Restrack</span>
                        <span class="hidden text-[10px] font-semibold tracking-wide text-gold/70 sm:block">{{ optional($siteSettings->get('tagline'))->value ?? (app()->getLocale() === 'ar' ? 'مؤسسة ريستراك للتدريب' : 'Research Track Platform') }}</span>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden items-center gap-1 lg:flex">
                    @php
                        $navLinks = [
                            ['route' => 'home',     'label' => __('general.home')],
                            ['route' => 'program',  'label' => __('general.program')],
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
                        <a href="{{ route('register') }}" class="btn-magnetic shine-hover gradient-gold inline-flex items-center gap-2 rounded-xl px-5 py-2.5 text-sm font-bold text-navy shadow-lg glow-gold-hover">
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
                <a href="{{ route('program') }}" class="block rounded-lg px-3 py-2.5 text-sm text-white/85 hover:bg-white/5 hover:text-gold">{{ __('general.program') }}</a>
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
        @include('partials.site-footer')
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
