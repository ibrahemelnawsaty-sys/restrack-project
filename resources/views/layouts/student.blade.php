<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') — Restrack</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Tajawal:wght@300;400;500;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 antialiased" x-data="{ sideOpen: window.innerWidth >= 1024, mobileOpen: false }">

    @include('partials.icons')

    {{-- Mobile backdrop --}}
    <div x-show="mobileOpen" x-transition.opacity x-cloak @click="mobileOpen = false" class="fixed inset-0 z-30 bg-black/50 lg:hidden"></div>

    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside :class="[
                sideOpen ? 'lg:w-72' : 'lg:w-20',
                mobileOpen ? 'translate-x-0' : '-translate-x-full rtl:translate-x-full'
              ]"
               class="fixed inset-y-0 start-0 z-40 flex w-72 flex-col gradient-navy shadow-2xl transition-all duration-300 lg:translate-x-0 lg:rtl:translate-x-0">

            {{-- Decorative top blob --}}
            <div class="floater gradient-gold w-40 h-40 -top-10 -end-10 opacity-30 pointer-events-none"></div>

            {{-- Brand --}}
            <div class="relative flex h-20 items-center gap-3 border-b border-white/10 px-5">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl gradient-gold shadow-lg">
                    <span class="text-lg font-extrabold text-navy">R</span>
                </div>
                <div class="overflow-hidden" x-show="sideOpen" x-transition.opacity>
                    <p class="text-lg font-extrabold text-shimmer leading-none">Restrack</p>
                    <p class="text-[10px] uppercase tracking-[0.2em] text-gold/70 mt-1">Student Area</p>
                </div>
            </div>

            {{-- User card --}}
            <div class="relative border-b border-white/10 px-5 py-4" x-show="sideOpen" x-transition.opacity>
                <div class="rounded-2xl glass-dark p-3">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl gradient-gold text-sm font-bold text-navy">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="truncate text-sm font-semibold text-white">{{ auth()->user()->name }}</p>
                            <p class="truncate text-[10px] text-gold/80">{{ __('general.student') ?? 'متدرب' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <nav class="relative flex-1 space-y-1 overflow-y-auto px-3 py-4 text-sm">
                @php
                    $studentLinks = [
                        ['route' => 'student.dashboard',            'label' => __('general.dashboard'),    'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                        ['route' => 'student.certificates.index',   'label' => __('general.certificates'), 'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z'],
                        ['route' => 'student.profile.edit',         'label' => __('general.profile'),      'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
                    ];
                @endphp

                @foreach($studentLinks as $link)
                    @php $active = request()->routeIs($link['route'].'*'); @endphp
                    <a href="{{ route($link['route']) }}"
                       class="group relative flex items-center gap-3 rounded-xl px-3 py-3 transition
                              {{ $active ? 'gradient-gold text-navy font-bold shadow-lg' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
                        @if($active)
                            <span class="absolute inset-y-2 start-0 w-1 rounded-full bg-navy"></span>
                        @endif
                        <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="{{ $link['icon'] }}"/>
                        </svg>
                        <span x-show="sideOpen" x-transition.opacity class="truncate">{{ $link['label'] }}</span>
                    </a>
                @endforeach
            </nav>

            {{-- Sidebar bottom --}}
            <div class="relative border-t border-white/10 p-3 space-y-2">
                <a href="{{ route('home') }}" class="group flex items-center gap-3 rounded-xl px-3 py-2.5 text-white/60 transition hover:bg-white/10 hover:text-gold">
                    <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3"/></svg>
                    <span x-show="sideOpen" x-transition.opacity class="text-xs">{{ __('general.back_to_site') }}</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="group flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-red-300 transition hover:bg-red-500/10 hover:text-red-200">
                        <svg class="h-5 w-5 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        <span x-show="sideOpen" x-transition.opacity class="text-xs">{{ __('general.logout') }}</span>
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main area --}}
        <div :class="sideOpen ? 'lg:ms-72' : 'lg:ms-20'" class="flex flex-1 flex-col transition-all duration-300">

            {{-- Header --}}
            <header class="sticky top-0 z-30 flex h-20 items-center justify-between border-b border-gray-100 bg-white/80 px-4 backdrop-blur-lg shadow-sm lg:px-8">
                <div class="flex items-center gap-4">
                    {{-- Desktop sidebar toggle --}}
                    <button @click="sideOpen = !sideOpen" class="hidden lg:inline-flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 text-gray-500 transition hover:border-gold hover:text-gold">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    {{-- Mobile sidebar toggle --}}
                    <button @click="mobileOpen = !mobileOpen" class="lg:hidden inline-flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 text-gray-500 transition hover:border-gold hover:text-gold">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>

                    <div>
                        <p class="text-[11px] uppercase tracking-wider text-gray-400">{{ __('general.dashboard') }}</p>
                        <h1 class="text-lg font-extrabold text-navy lg:text-xl">@yield('page-title')</h1>
                    </div>
                </div>

                <div class="flex items-center gap-2 lg:gap-3">
                    {{-- Lang --}}
                    <a href="{{ route('lang.switch', app()->getLocale() === 'ar' ? 'en' : 'ar') }}"
                       class="inline-flex items-center gap-1 rounded-xl border border-gray-200 px-3 py-2 text-xs font-semibold text-gray-600 transition hover:border-gold hover:text-gold">
                        {{ app()->getLocale() === 'ar' ? 'EN' : 'عربي' }}
                    </a>

                    {{-- Notifications dummy --}}
                    <button class="relative inline-flex h-10 w-10 items-center justify-center rounded-xl border border-gray-200 text-gray-500 transition hover:border-gold hover:text-gold">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <span class="absolute -top-1 -end-1 flex h-4 w-4 items-center justify-center rounded-full gradient-gold text-[9px] font-bold text-navy">3</span>
                    </button>

                    {{-- User dropdown --}}
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false">
                        <button @click="open = !open" class="flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-2.5 py-1.5 transition hover:border-gold">
                            <span class="flex h-8 w-8 items-center justify-center rounded-lg gradient-gold text-xs font-bold text-navy">
                                {{ strtoupper(substr(auth()->user()?->name ?? 'U', 0, 1)) }}
                            </span>
                            <span class="hidden text-sm font-semibold text-gray-700 sm:block">{{ Str::limit(auth()->user()?->name, 12) }}</span>
                            <svg :class="open && 'rotate-180'" class="h-4 w-4 text-gray-400 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition x-cloak class="absolute end-0 mt-2 w-56 overflow-hidden rounded-xl border border-gray-100 bg-white shadow-2xl">
                            <a href="{{ route('student.profile.edit') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gold/5 hover:text-gold">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                {{ __('general.profile') }}
                            </a>
                            <a href="{{ route('home') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gold/5 hover:text-gold">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3"/></svg>
                                {{ __('general.back_to_site') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="flex w-full items-center gap-2 border-t border-gray-100 px-4 py-2.5 text-start text-sm text-red-600 hover:bg-red-50">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    {{ __('general.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Page content --}}
            <div class="flex-1 p-4 lg:p-8">
                @if(session('success'))
                    <div class="mb-6 flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm text-green-700 shadow-sm animate-fade-up">
                        <svg class="h-5 w-5 shrink-0 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 flex items-start gap-3 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700 shadow-sm animate-fade-up">
                        <svg class="h-5 w-5 shrink-0 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    {{-- Glass bottom navigation (mobile/tablet app feel) --}}
    @php
        $bottomNav = [
            ['label' => __('general.dashboard'),    'url' => route('student.dashboard'),          'icon' => 'i-grid',  'active' => request()->routeIs('student.dashboard')],
            ['label' => __('general.certificates'), 'url' => route('student.certificates.index'), 'icon' => 'i-award', 'active' => request()->routeIs('student.certificates.*')],
            ['label' => __('general.profile'),      'url' => route('student.profile.edit'),       'icon' => 'i-user',  'active' => request()->routeIs('student.profile.*')],
            ['label' => __('general.back_to_site') ?? 'الموقع', 'url' => route('home'),            'icon' => 'i-home',  'active' => false],
        ];
    @endphp
    <div class="bottom-nav-spacer"></div>
    <div x-show="!mobileOpen">
        @include('partials.bottom-nav', ['items' => $bottomNav])
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')

    <style>[x-cloak]{display:none!important}</style>
</body>
</html>
