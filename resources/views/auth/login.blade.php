@extends('layouts.app')

@section('title', __('general.login') . ' — Restrack')

@section('content')
<section class="relative min-h-[calc(100vh-10rem)] overflow-hidden bg-gray-50">
    <div class="mx-auto grid min-h-[calc(100vh-10rem)] max-w-7xl lg:grid-cols-2">

        {{-- LEFT VISUAL PANEL --}}
        <div class="relative hidden overflow-hidden lg:flex mesh-bg">
            <div class="absolute inset-0 bg-grid opacity-30"></div>
            <div class="stars-bg absolute inset-0"></div>
            <div class="floater gradient-gold w-72 h-72 -top-10 -start-10 animate-float"></div>
            <div class="floater bg-navy-light w-80 h-80 bottom-0 end-0 animate-float-slow"></div>

            <div class="relative z-10 flex flex-1 flex-col justify-between p-12 text-white">
                {{-- Top brand --}}
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 self-start">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl gradient-gold shadow-lg">
                        <span class="text-lg font-extrabold text-navy">R</span>
                    </div>
                    <div>
                        <p class="text-xl font-extrabold text-shimmer">Restrack</p>
                        <p class="text-[10px] uppercase tracking-[0.2em] text-gold/70">Learn • Grow • Certify</p>
                    </div>
                </a>

                {{-- Middle content --}}
                <div class="animate-fade-up">
                    <h2 class="text-4xl font-extrabold leading-tight lg:text-5xl">
                        {{ __('general.welcome_back') }}
                        <span class="block text-gradient-gold">{{ __('general.login_subtitle') }}</span>
                    </h2>
                    <p class="mt-4 max-w-md text-white/70">
                        {{ __('general.login_marketing') ?? 'تابع رحلتك التعليمية، استكمل دروسك المحفوظة، واحصل على شهاداتك المعتمدة.' }}
                    </p>

                    {{-- Feature list --}}
                    <ul class="mt-8 space-y-3">
                        @foreach([
                            __('general.feature_levels'),
                            __('general.feature_certificates'),
                            __('general.feature_bilingual'),
                        ] as $f)
                            <li class="flex items-center gap-3 text-sm">
                                <span class="flex h-6 w-6 items-center justify-center rounded-full gradient-gold">
                                    <svg class="h-3.5 w-3.5 text-navy" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </span>
                                <span class="text-white/80">{{ $f }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                {{-- Bottom testimonial --}}
                <div class="glass rounded-2xl p-5 animate-fade-up delay-300">
                    <div class="flex gap-1 text-gold mb-2">
                        @for($i=0;$i<5;$i++)<svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.539 1.118L10 13.347l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.363-1.118L3.566 7.819c-.783-.57-.38-1.81.589-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                    </div>
                    <p class="text-sm text-white/80 italic">"{{ __('general.testimonial_text') ?? 'منصة احترافية ساعدتني على الحصول على شهادتي بسهولة. تجربة تستحق التجربة!' }}"</p>
                    <p class="mt-3 text-xs text-gold font-semibold">— {{ __('general.testimonial_author') ?? 'أحد المتدربين' }}</p>
                </div>
            </div>
        </div>

        {{-- RIGHT FORM PANEL --}}
        <div class="flex items-center justify-center px-4 py-12 lg:px-12">
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
                        <span class="text-xs font-bold uppercase tracking-[0.3em] text-gold">{{ __('general.account') ?? 'حسابي' }}</span>
                        <h1 class="mt-2 text-3xl font-extrabold text-navy">{{ __('general.login') }}</h1>
                        <p class="mt-2 text-sm text-gray-500">{{ __('general.login_subtitle') }}</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-5">
                        @csrf

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700">{{ __('general.email') }}</label>
                            <div class="relative mt-2">
                                <span class="absolute inset-y-0 start-0 flex items-center ps-3 text-gray-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </span>
                                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                                    placeholder="you@example.com"
                                    class="input-elegant block w-full rounded-xl border border-gray-200 bg-gray-50 ps-11 pe-4 py-3 text-sm focus:bg-white">
                            </div>
                            @error('email') <p class="mt-1.5 flex items-center gap-1 text-xs text-red-500"><svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20"><path d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"/></svg> {{ $message }}</p> @enderror
                        </div>

                        {{-- Password --}}
                        <div x-data="{ show: false }">
                            <label for="password" class="block text-sm font-semibold text-gray-700">{{ __('general.password') }}</label>
                            <div class="relative mt-2">
                                <span class="absolute inset-y-0 start-0 flex items-center ps-3 text-gray-400">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                </span>
                                <input :type="show ? 'text' : 'password'" id="password" name="password" required
                                    placeholder="••••••••"
                                    class="input-elegant block w-full rounded-xl border border-gray-200 bg-gray-50 ps-11 pe-11 py-3 text-sm focus:bg-white">
                                <button type="button" @click="show = !show" class="absolute inset-y-0 end-0 flex items-center pe-3 text-gray-400 hover:text-gold">
                                    <svg x-show="!show" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <svg x-show="show" x-cloak class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                </button>
                            </div>
                            @error('password') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center gap-2 text-sm text-gray-600 cursor-pointer">
                                <input type="checkbox" name="remember" class="rounded border-gray-300 text-gold focus:ring-gold">
                                {{ __('general.remember_me') }}
                            </label>
                            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-gold hover:text-gold-dark">{{ __('general.forgot_password') }}</a>
                        </div>

                        <button type="submit" class="btn-magnetic group flex w-full items-center justify-center gap-2 rounded-xl bg-navy py-3.5 font-bold text-white shadow-lg transition hover:bg-navy-light">
                            <span>{{ __('general.login') }}</span>
                            <svg class="h-5 w-5 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                        </button>
                    </form>

                    <div class="my-6 flex items-center gap-3 text-xs uppercase tracking-wider text-gray-400">
                        <span class="flex-1 border-t border-gray-200"></span>
                        <span>{{ __('general.or') ?? 'أو' }}</span>
                        <span class="flex-1 border-t border-gray-200"></span>
                    </div>

                    <p class="text-center text-sm text-gray-500">
                        {{ __('general.no_account') }}
                        <a href="{{ route('register') }}" class="font-bold text-gold link-underline hover:text-gold-dark">{{ __('general.register') }}</a>
                    </p>
                </div>

                <p class="mt-6 text-center text-xs text-gray-400">
                    <svg class="inline h-3 w-3 text-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    {{ __('general.secure_login') ?? 'بياناتك آمنة ومحمية بتشفير عالي.' }}
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
