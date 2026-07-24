@extends('layouts.app')

@section('title', app()->getLocale() === 'ar' ? 'تفاصيل البرنامج — ريستراك' : 'Program Details — Restrack')

@php $isAr = app()->getLocale() === 'ar'; @endphp

@section('content')

{{-- ============ HERO ============ --}}
<section class="relative isolate overflow-hidden mesh-bg text-white">
    <div class="absolute inset-0 bg-grid opacity-30"></div>
    <div class="floater gradient-gold w-80 h-80 -top-24 -start-24 animate-float"></div>
    <div class="floater bg-navy-light w-96 h-96 -bottom-24 -end-24 animate-float-slow"></div>

    <div class="relative mx-auto max-w-5xl px-4 sm:px-6 lg:px-8 py-20 lg:py-28 text-center">
        <span class="inline-flex items-center gap-2 rounded-full glass px-4 py-1.5 text-xs font-bold text-gold reveal">
            <svg class="h-4 w-4"><use href="#i-sparkle"/></svg>
            Research Track Programs (1)
        </span>
        <h1 class="mt-6 text-4xl font-extrabold leading-tight sm:text-5xl lg:text-6xl reveal">
            <span class="block text-gradient-gold">From Beginner to Expert</span>
            <span class="mt-1 block">in Medical Research</span>
        </h1>
        <p class="mx-auto mt-6 max-w-2xl text-lg text-white/75 reveal">
            {{ $isAr
                ? 'مسار واحد متكامل يأخذك خطوة بخطوة من أساسيات البحث الطبي حتى نشر ورقة علمية — بمحاضرات مسجّلة تُعاد متى شئت، واختبارات بمحاولات لا محدودة، وشهادة إكمال موثّقة.'
                : 'One complete track that takes you step by step from the fundamentals of medical research to publishing a paper — recorded lectures you can rewatch anytime, exams with unlimited attempts, and a verified certificate of completion.' }}
        </p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3 reveal">
            <span class="inline-flex items-center gap-2 rounded-full bg-white/5 border border-gold/25 px-4 py-2 text-sm font-semibold text-white/85"><svg class="h-4 w-4 text-teal"><use href="#i-video"/></svg>{{ $isAr ? 'محاضرات مسجّلة' : 'Recorded lectures' }}</span>
            <span class="inline-flex items-center gap-2 rounded-full bg-white/5 border border-gold/25 px-4 py-2 text-sm font-semibold text-white/85"><svg class="h-4 w-4 text-gold"><use href="#i-infinity"/></svg>{{ $isAr ? 'محاولات اختبار لا محدودة' : 'Unlimited exam attempts' }}</span>
            <span class="inline-flex items-center gap-2 rounded-full bg-white/5 border border-gold/25 px-4 py-2 text-sm font-semibold text-white/85"><svg class="h-4 w-4 text-violet"><use href="#i-award"/></svg>{{ $isAr ? 'شهادة إكمال موثّقة' : 'Verified certificate' }}</span>
        </div>
    </div>
</section>

{{-- ============ HOW IT WORKS ============ --}}
<section class="bg-surface py-16 lg:py-20">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-6 md:grid-cols-3">
            @foreach([
                ['icon'=>'i-video','t'=>$isAr?'شاهد المحاضرات المسجّلة':'Watch recorded lectures','d'=>$isAr?'محاضرات قصيرة ومركّزة، تُشاهدها وتعيدها في أي وقت ومن أي جهاز.':'Short, focused lectures you can watch and rewatch anytime, on any device.'],
                ['icon'=>'i-infinity','t'=>$isAr?'اجتَز الاختبار — بلا خوف':'Pass the exam — no fear','d'=>$isAr?'بعد كل مستوى اختبار، والنجاح 70٪، والمحاولات لا محدودة حتى تتقن.':'Each level ends with an exam (70% to pass) and unlimited attempts until you master it.'],
                ['icon'=>'i-award','t'=>$isAr?'احصل على شهادتك':'Earn your certificate','d'=>$isAr?'عند إكمال المسار تصلك شهادة إكمال موثّقة على بريدك، قابلة للتحقق.':'Complete the track and receive a verified certificate of completion by email.'],
            ] as $i => $step)
            <div class="glass-panel glass-sheen theme-t p-6 reveal" style="transition-delay: {{ $i * 100 }}ms">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl" style="background:linear-gradient(150deg,rgba(124,108,252,.20),rgba(47,214,190,.14))">
                    <svg class="h-6 w-6 text-gold"><use href="#{{ $step['icon'] }}"/></svg>
                </div>
                <h3 class="mt-4 text-lg font-extrabold text-ink">{{ $step['t'] }}</h3>
                <p class="mt-2 text-sm text-ink-soft">{{ $step['d'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ============ THE LEVELS ============ --}}
<section class="bg-canvas py-16 lg:py-24">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="text-center reveal">
            <span class="text-xs font-bold uppercase tracking-[0.3em] text-gold">{{ $isAr ? 'محتوى المسار' : 'Track content' }}</span>
            <h2 class="mt-3 text-3xl font-extrabold text-ink lg:text-4xl">{{ $isAr ? 'ثلاثة مستويات متدرّجة' : 'Three progressive levels' }}</h2>
        </div>

        <div class="mt-12 space-y-6">
            @forelse($levels as $level)
            <div class="glass-panel theme-t overflow-hidden reveal">
                <div class="grid gap-0 md:grid-cols-[220px_1fr]">
                    {{-- Level side --}}
                    <div class="gradient-navy relative p-7 text-white">
                        <div class="flex h-14 w-14 items-center justify-center rounded-2xl gradient-gold text-2xl font-black text-navy shadow-lg">{{ $level->order }}</div>
                        <h3 class="mt-4 text-xl font-extrabold text-white">{{ $level->title }}</h3>
                        <div class="mt-4 flex flex-wrap gap-2 text-xs">
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-white/10 px-3 py-1 font-semibold text-gold"><svg class="h-3.5 w-3.5"><use href="#i-video"/></svg>{{ $level->lectures_count }} {{ $isAr ? 'محاضرة' : 'lectures' }}</span>
                        </div>
                    </div>

                    {{-- Content side --}}
                    <div class="p-7 bg-surface">
                        @if($level->description)
                            <p class="text-sm text-ink-soft">{{ $level->description }}</p>
                        @endif

                        @if($level->lectures->count())
                        <ul class="mt-4 grid gap-2 sm:grid-cols-2">
                            @foreach($level->lectures as $lecture)
                            <li class="flex items-center gap-2.5 rounded-xl border border-hair bg-surface-2 px-3 py-2.5">
                                <span class="flex h-7 w-7 shrink-0 items-center justify-center rounded-lg" style="background:rgba(47,214,190,.14)"><svg class="h-4 w-4 text-teal"><use href="#i-video"/></svg></span>
                                <span class="min-w-0 flex-1">
                                    <span class="block truncate text-sm font-semibold text-ink">{{ $lecture->title }}</span>
                                    <span class="text-[11px] text-ink-soft">
                                        {{ $isAr ? 'مسجّلة' : 'Recorded' }}@if($lecture->duration_minutes) · {{ $lecture->duration_minutes }} {{ $isAr ? 'دقيقة' : 'min' }}@endif
                                    </span>
                                </span>
                                @if($lecture->is_free_preview)
                                    <span class="shrink-0 rounded-full bg-gold/15 px-2 py-0.5 text-[10px] font-bold text-gold">{{ $isAr ? 'مجاني' : 'Free' }}</span>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                        @endif

                        {{-- Exam + certificate note --}}
                        <div class="mt-5 flex flex-wrap items-center gap-3 border-t border-hair pt-4 text-sm">
                            <span class="inline-flex items-center gap-2 font-semibold text-ink">
                                <svg class="h-4 w-4 text-gold"><use href="#i-check"/></svg>
                                {{ $isAr ? 'اختبار المستوى' : 'Level exam' }}: {{ $level->passing_score ?? 70 }}%
                                <span class="text-teal">({{ $isAr ? 'محاولات لا محدودة' : 'unlimited attempts' }})</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-center text-ink-soft">{{ $isAr ? 'سيتم إضافة محتوى المستويات قريباً.' : 'Level content will be added soon.' }}</p>
            @endforelse
        </div>

        {{-- Final certificate --}}
        <div class="mt-8 glass-panel theme-t p-7 text-center reveal">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full" style="background:radial-gradient(circle at 50% 35%,rgba(217,180,88,.28),transparent 70%)">
                <svg class="h-9 w-9 text-gold"><use href="#i-award"/></svg>
            </div>
            <h3 class="mt-3 text-xl font-extrabold text-ink">{{ $isAr ? 'أكمل المسار → شهادة إكمال موثّقة' : 'Finish the track → a verified Certificate of Completion' }}</h3>
            <p class="mt-2 text-sm text-ink-soft">{{ $isAr ? 'ثنائية اللغة، بتحقّق عام عبر QR، وتصلك على بريدك — تفخر بمشاركتها.' : 'Bilingual, publicly verifiable via QR, delivered to your email — proud to share.' }}</p>
        </div>
    </div>
</section>

{{-- ============ FINAL CTA (pay / start) ============ --}}
<section class="relative overflow-hidden mesh-bg py-16 lg:py-24 text-white">
    <div class="absolute inset-0 bg-grid opacity-20"></div>
    <div class="relative mx-auto max-w-3xl px-4 text-center reveal">
        <h2 class="text-3xl font-extrabold lg:text-4xl">{{ $isAr ? 'جاهز تبدأ رحلتك البحثية؟' : 'Ready to start your research journey?' }}</h2>
        <p class="mt-4 text-lg text-white/75">{{ $isAr ? 'اشتراك واحد يفتح المسار كاملاً — بلا خوف من الاختبارات، ومحاولات لا محدودة.' : 'One subscription unlocks the whole track — no exam fear, unlimited attempts.' }}</p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
            @auth
                @if(auth()->user()->isSubscribed())
                    <a href="{{ route('student.dashboard') }}" class="btn-magnetic inline-flex items-center gap-2 rounded-2xl gradient-gold px-10 py-4 font-bold text-navy shadow-2xl glow-gold-hover">
                        {{ $isAr ? 'ابدأ التعلّم — لوحتي' : 'Start learning — my dashboard' }}
                        <svg class="h-5 w-5 rtl:rotate-180"><use href="#i-arrow"/></svg>
                    </a>
                @else
                    <a href="{{ route('checkout') }}" class="btn-magnetic inline-flex items-center gap-2 rounded-2xl gradient-gold px-10 py-4 font-bold text-navy shadow-2xl glow-gold-hover">
                        {{ $isAr ? 'ادفع وابدأ الآن' : 'Pay & start now' }}
                        <svg class="h-5 w-5 rtl:rotate-180"><use href="#i-arrow"/></svg>
                    </a>
                @endif
            @else
                <a href="{{ route('register') }}" class="btn-magnetic inline-flex items-center gap-2 rounded-2xl gradient-gold px-10 py-4 font-bold text-navy shadow-2xl glow-gold-hover">
                    {{ $isAr ? 'سجّل وابدأ' : 'Register & start' }}
                    <svg class="h-5 w-5 rtl:rotate-180"><use href="#i-arrow"/></svg>
                </a>
            @endauth
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 rounded-2xl border-2 border-white/30 px-10 py-4 font-bold text-white transition hover:border-gold hover:text-gold">
                {{ $isAr ? 'عندك سؤال؟ تواصل معنا' : 'Have a question? Contact us' }}
            </a>
        </div>
    </div>
</section>

@endsection
