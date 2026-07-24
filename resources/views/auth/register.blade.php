@extends('layouts.app')

@section('title', __('general.register') . ' — Restrack')

@section('content')
<section class="relative min-h-[calc(100vh-10rem)] overflow-hidden bg-gray-50">
    <div class="mx-auto grid min-h-[calc(100vh-10rem)] max-w-7xl lg:grid-cols-2">

        {{-- LEFT FORM PANEL --}}
        <div class="order-2 flex items-center justify-center px-4 py-12 lg:order-1 lg:px-12">
            <div class="w-full max-w-md animate-fade-up">
                {{-- Mobile brand --}}
                <a href="{{ route('home') }}" class="mb-8 inline-flex items-center gap-2 lg:hidden">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl gradient-gold">
                        <span class="font-extrabold text-navy">R</span>
                    </div>
                    <span class="text-xl font-extrabold text-navy">Restrack</span>
                </a>

                <div class="rounded-3xl bg-white p-8 shadow-xl lg:p-10">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-[0.3em] text-gold">{{ __('general.join_us') ?? 'انضم إلينا' }}</span>
                        <h1 class="mt-2 text-3xl font-extrabold text-navy">{{ __('general.register') }}</h1>
                        <p class="mt-2 text-sm text-gray-500">{{ __('general.register_subtitle') }}</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-5">
                        @csrf

                        {{-- Name --}}
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700">{{ __('general.name') }}</label>
                            <div class="relative mt-2">
                                <span class="absolute inset-y-0 start-0 flex items-center ps-3 text-gray-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                </span>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                                    placeholder="{{ __('general.your_name') ?? 'اسمك الكامل' }}"
                                    class="input-elegant block w-full rounded-xl border border-gray-200 bg-gray-50 ps-11 pe-4 py-3 text-sm focus:bg-white">
                            </div>
                            @error('name') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700">{{ __('general.email') }}</label>
                            <div class="relative mt-2">
                                <span class="absolute inset-y-0 start-0 flex items-center ps-3 text-gray-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </span>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                    placeholder="you@example.com"
                                    class="input-elegant block w-full rounded-xl border border-gray-200 bg-gray-50 ps-11 pe-4 py-3 text-sm focus:bg-white">
                            </div>
                            @error('email') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700">{{ __('general.phone') }}</label>
                            <div class="relative mt-2">
                                <span class="absolute inset-y-0 start-0 flex items-center ps-3 text-gray-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                </span>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                    placeholder="+966 5x xxx xxxx" dir="ltr"
                                    class="input-elegant block w-full rounded-xl border border-gray-200 bg-gray-50 ps-11 pe-4 py-3 text-sm focus:bg-white">
                            </div>
                        </div>

                        {{-- Password fields side by side on lg --}}
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div x-data="{ show: false }">
                                <label for="password" class="block text-sm font-semibold text-gray-700">{{ __('general.password') }}</label>
                                <div class="relative mt-2">
                                    <input :type="show ? 'text' : 'password'" id="password" name="password" required
                                        placeholder="••••••••"
                                        class="input-elegant block w-full rounded-xl border border-gray-200 bg-gray-50 ps-4 pe-10 py-3 text-sm focus:bg-white">
                                    <button type="button" @click="show = !show" class="absolute inset-y-0 end-0 flex items-center pe-3 text-gray-400 hover:text-gold">
                                        <svg x-show="!show" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        <svg x-show="show" x-cloak class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M3 3l18 18"/></svg>
                                    </button>
                                </div>
                                @error('password') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">{{ __('general.confirm_password') }}</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                    placeholder="••••••••"
                                    class="input-elegant mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:bg-white">
                            </div>
                        </div>

                        {{-- Locale --}}
                        <div>
                            <label for="locale" class="block text-sm font-semibold text-gray-700">{{ __('general.preferred_language') }}</label>
                            <div class="mt-2 grid grid-cols-2 gap-3">
                                @foreach([['v'=>'ar','l'=>'العربية','flag'=>'🇸🇦'],['v'=>'en','l'=>'English','flag'=>'🇬🇧']] as $l)
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="locale" value="{{ $l['v'] }}" {{ old('locale', app()->getLocale()) === $l['v'] ? 'checked' : '' }} class="peer sr-only">
                                        <div class="flex items-center gap-2 rounded-xl border-2 border-gray-200 bg-gray-50 px-4 py-3 text-sm font-semibold text-gray-600 transition peer-checked:border-gold peer-checked:bg-gold/5 peer-checked:text-navy">
                                            <span class="text-lg">{{ $l['flag'] }}</span>
                                            {{ $l['l'] }}
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <button type="submit" class="btn-magnetic group flex w-full items-center justify-center gap-2 rounded-xl gradient-gold py-3.5 font-bold text-navy shadow-lg glow-gold-hover">
                            <span>{{ __('general.register') }}</span>
                            <svg class="h-5 w-5 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </button>
                    </form>

                    <p class="mt-6 text-center text-sm text-gray-500">
                        {{ __('general.have_account') }}
                        <a href="{{ route('login') }}" class="font-bold text-gold link-underline hover:text-gold-dark">{{ __('general.login') }}</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- RIGHT VISUAL PANEL --}}
        <div class="relative order-1 hidden overflow-hidden lg:order-2 lg:flex mesh-bg">
            <div class="absolute inset-0 bg-grid opacity-30"></div>
            <div class="stars-bg absolute inset-0"></div>
            <div class="floater gradient-gold w-72 h-72 top-0 end-0 animate-float"></div>
            <div class="floater bg-navy-light w-80 h-80 -bottom-10 -start-10 animate-float-slow"></div>

            <div class="relative z-10 flex flex-1 flex-col justify-between p-12 text-white">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 self-start">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl gradient-gold shadow-lg">
                        <span class="text-lg font-extrabold text-navy">R</span>
                    </div>
                    <div>
                        <p class="text-xl font-extrabold text-shimmer">Restrack</p>
                        <p class="text-[10px] uppercase tracking-[0.2em] text-gold/70">Learn • Grow • Certify</p>
                    </div>
                </a>

                <div class="animate-fade-up">
                    <h2 class="text-4xl font-extrabold leading-tight lg:text-5xl">
                        {{ __('general.start_your_journey') ?? 'ابدأ رحلتك المهنية' }}
                        <span class="block text-gradient-gold">{{ __('general.with_us') ?? 'معنا اليوم' }}</span>
                    </h2>
                    <p class="mt-4 max-w-md text-white/70">
                        {{ __('general.register_marketing') ?? 'انضم لآلاف المتدربين واحصل على شهادات معتمدة في مجالك بأعلى جودة وأفضل الخبراء.' }}
                    </p>

                    {{-- Stats --}}
                    <div class="mt-10 grid grid-cols-3 gap-4">
                        @foreach([['k'=>'1500+','v'=>__('general.students')??'متدرب'],['k'=>'50+','v'=>__('general.lectures')],['k'=>'98%','v'=>__('general.satisfaction')??'رضا']] as $s)
                            <div class="rounded-2xl glass p-4 text-center">
                                <p class="text-2xl font-extrabold text-gold">{{ $s['k'] }}</p>
                                <p class="mt-1 text-xs text-white/60">{{ $s['v'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="glass rounded-2xl p-5 animate-fade-up delay-300">
                    <div class="flex items-start gap-4">
                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl gradient-gold">
                            <svg class="h-6 w-6 text-navy" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-white">{{ __('general.certified_program') }}</p>
                            <p class="mt-1 text-xs text-white/60">{{ __('general.certified_program_desc') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
