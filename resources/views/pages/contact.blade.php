@extends('layouts.app')

@section('title', __('general.contact') . ' — Restrack')

@section('content')
{{-- Hero --}}
<section class="relative overflow-hidden mesh-bg py-20 text-white lg:py-24">
    <div class="absolute inset-0 bg-grid opacity-30"></div>
    <div class="stars-bg absolute inset-0"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 rounded-full glass px-4 py-1.5 text-xs font-medium text-gold animate-fade-up">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            {{ __('general.get_in_touch') ?? 'تواصل معنا' }}
        </span>
        <h1 class="mt-6 text-4xl font-extrabold lg:text-6xl animate-fade-up delay-100">
            {{ __('general.contact_us') }}
            <span class="block text-gradient-gold">{{ __('general.we_listen') ?? 'نحن هنا للمساعدة' }}</span>
        </h1>
        <p class="mt-5 max-w-2xl mx-auto text-lg text-white/70 animate-fade-up delay-200">{{ __('general.contact_subtitle') }}</p>
    </div>

    <div class="absolute inset-x-0 bottom-0">
        <svg class="w-full h-12" viewBox="0 0 1440 60" preserveAspectRatio="none" fill="none">
            <path d="M0,30 C240,60 480,0 720,30 C960,60 1200,10 1440,40 L1440,60 L0,60 Z" fill="#f9fafb"/>
        </svg>
    </div>
</section>

<section class="bg-gray-50 py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-5">

            {{-- LEFT: Info cards --}}
            <aside class="lg:col-span-2 space-y-5">
                <div class="reveal">
                    <h2 class="section-title text-2xl font-extrabold text-navy">{{ __('general.contact_info') ?? 'معلومات التواصل' }}</h2>
                    <p class="mt-3 text-sm text-gray-600">{{ __('general.contact_info_desc') ?? 'يسعدنا الإجابة عن استفساراتك في أقرب وقت ممكن.' }}</p>
                </div>

                @foreach([
                    [
                        'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                        'title' => __('general.email'),
                        'value' => 'info@restrack.sa',
                        'href'  => 'mailto:info@restrack.sa',
                    ],
                    [
                        'icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z',
                        'title' => __('general.phone'),
                        'value' => '+966 5x xxx xxxx',
                        'href'  => '#',
                    ],
                    [
                        'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z',
                        'title' => __('general.location') ?? 'الموقع',
                        'value' => __('general.saudi_arabia') ?? 'المملكة العربية السعودية',
                        'href'  => '#',
                    ],
                ] as $i => $item)
                <a href="{{ $item['href'] }}" class="group flex items-start gap-4 rounded-2xl bg-white p-5 shadow-sm card-lift reveal" style="transition-delay: {{ $i * 80 }}ms">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl gradient-gold shadow-md transition group-hover:scale-110 group-hover:rotate-6">
                        <svg class="h-6 w-6 text-navy" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $item['icon'] }}"/></svg>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-gray-400">{{ $item['title'] }}</p>
                        <p class="mt-1 font-bold text-navy">{{ $item['value'] }}</p>
                    </div>
                </a>
                @endforeach

                {{-- Social --}}
                <div class="rounded-2xl gradient-navy p-6 text-white shadow-lg reveal">
                    <h3 class="font-bold text-gold">{{ __('general.follow_us') ?? 'تابعنا' }}</h3>
                    <p class="mt-2 text-sm text-white/70">{{ __('general.follow_desc') ?? 'تابع آخر التحديثات والدورات الجديدة.' }}</p>
                    <div class="mt-4 flex gap-2">
                        @foreach([
                            ['name' => 'twitter',   'path' => 'M22 4.01c-1 .49-1.98.689-3 .99-1.121-1.265-2.783-1.335-4.38-.737S11.977 6.323 12 8v1c-3.245.083-6.135-1.395-8-4 0 0-4.182 7.433 4 11-1.872 1.247-3.739 2.088-6 2 3.308 1.803 6.913 2.423 10.034 1.517 3.58-1.04 6.522-3.723 7.651-7.742a13.84 13.84 0 0 0 .497 -3.753c0-.249 1.51-2.772 1.818-4.013z'],
                            ['name' => 'linkedin',  'path' => 'M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6zM2 9h4v12H2zM4 2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z'],
                            ['name' => 'instagram', 'path' => 'M17 2H7a5 5 0 0 0-5 5v10a5 5 0 0 0 5 5h10a5 5 0 0 0 5-5V7a5 5 0 0 0-5-5zm-5 13a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm5-9a1 1 0 1 1 0-2 1 1 0 0 1 0 2z'],
                            ['name' => 'whatsapp',  'path' => 'M20.52 3.449C12.831-3.984.106 1.407.101 11.893c0 2.096.549 4.14 1.595 5.945L0 24l6.335-1.652a11.882 11.882 0 005.677 1.448h.005c9.847 0 16.02-10.665 11.108-19.243a11.79 11.79 0 00-2.605-3.104zm-8.5 18.297h-.004a9.86 9.86 0 01-5.031-1.378l-.361-.214-3.741.975 1.003-3.643-.235-.374a9.861 9.861 0 01-1.51-5.234c.002-8.737 10.654-13.108 16.81-6.951 6.165 6.144 1.795 16.819-6.93 16.819z'],
                        ] as $s)
                            <a href="#" aria-label="{{ $s['name'] }}" class="group flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 transition hover:border-gold hover:bg-gold/10">
                                <svg class="h-4 w-4 text-white/70 transition group-hover:text-gold" fill="currentColor" viewBox="0 0 24 24"><path d="{{ $s['path'] }}"/></svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            </aside>

            {{-- RIGHT: Form --}}
            <div class="lg:col-span-3 reveal">
                <div class="relative">
                    <div class="absolute -inset-1 rounded-3xl gradient-gold opacity-10 blur-2xl"></div>
                    <div class="relative rounded-3xl bg-white p-8 shadow-xl lg:p-10">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-[0.3em] text-gold">{{ __('general.send_message') }}</span>
                            <h2 class="mt-2 text-3xl font-extrabold text-navy">{{ __('general.write_to_us') ?? 'اكتب لنا رسالتك' }}</h2>
                            <p class="mt-2 text-sm text-gray-500">{{ __('general.response_time') ?? 'سنرد عليك خلال 24 ساعة' }}</p>
                        </div>

                        <form method="POST" action="{{ route('contact.store') }}" class="mt-8 space-y-5">
                            @csrf

                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-gray-700">{{ __('general.name') }}</label>
                                    <div class="relative mt-2">
                                        <span class="absolute inset-y-0 start-0 flex items-center ps-3 text-gray-400">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </span>
                                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                            class="input-elegant block w-full rounded-xl border border-gray-200 bg-gray-50 ps-11 pe-4 py-3 text-sm focus:bg-white">
                                    </div>
                                    @error('name') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-semibold text-gray-700">{{ __('general.email') }}</label>
                                    <div class="relative mt-2">
                                        <span class="absolute inset-y-0 start-0 flex items-center ps-3 text-gray-400">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        </span>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                            class="input-elegant block w-full rounded-xl border border-gray-200 bg-gray-50 ps-11 pe-4 py-3 text-sm focus:bg-white">
                                    </div>
                                    @error('email') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                                </div>
                            </div>

                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="phone" class="block text-sm font-semibold text-gray-700">{{ __('general.phone') }}</label>
                                    <div class="relative mt-2">
                                        <span class="absolute inset-y-0 start-0 flex items-center ps-3 text-gray-400">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                        </span>
                                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" dir="ltr"
                                            class="input-elegant block w-full rounded-xl border border-gray-200 bg-gray-50 ps-11 pe-4 py-3 text-sm focus:bg-white">
                                    </div>
                                </div>

                                <div>
                                    <label for="subject" class="block text-sm font-semibold text-gray-700">{{ __('general.subject') }}</label>
                                    <div class="relative mt-2">
                                        <span class="absolute inset-y-0 start-0 flex items-center ps-3 text-gray-400">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        </span>
                                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                                            class="input-elegant block w-full rounded-xl border border-gray-200 bg-gray-50 ps-11 pe-4 py-3 text-sm focus:bg-white">
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-semibold text-gray-700">{{ __('general.message') }}</label>
                                <textarea id="message" name="message" rows="6" required
                                    placeholder="{{ __('general.message_placeholder') ?? 'اكتب رسالتك هنا...' }}"
                                    class="input-elegant mt-2 block w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm focus:bg-white">{{ old('message') }}</textarea>
                                @error('message') <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <button type="submit" class="btn-magnetic group flex w-full items-center justify-center gap-2 rounded-xl bg-navy py-4 font-bold text-white shadow-xl transition hover:bg-navy-light">
                                <svg class="h-5 w-5 text-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                {{ __('general.send_message') }}
                                <svg class="h-4 w-4 transition-transform group-hover:translate-x-1 rtl:rotate-180 rtl:group-hover:-translate-x-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
