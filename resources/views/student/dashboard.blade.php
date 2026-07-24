@extends('layouts.student')

@section('title', __('general.dashboard'))
@section('page-title', __('general.dashboard'))

@php
    $isAr = app()->getLocale() === 'ar';
    // Resume target: first unlocked, not-yet-complete level's first lecture.
    $resume = null;
    foreach ($levels as $lvl) {
        $locked = in_array($lvl->id, $lockedLevels ?? []);
        if (! $locked && ($levelProgress[$lvl->id] ?? 0) < 100) {
            $resume = $lvl->lectures->sortBy('order')->first();
            if ($resume) break;
        }
    }
    if (! $resume) {
        $resume = optional($levels->first())->lectures?->sortBy('order')->first();
    }
    $totalLevels = $levels->count();
@endphp

@section('content')

{{-- ============ WELCOME HERO (dark aurora glass) ============ --}}
<div class="reveal relative mb-8 overflow-hidden rounded-[1.75rem] gradient-navy p-6 text-white shadow-2xl lg:p-9">
    <div class="absolute inset-0 bg-grid opacity-20"></div>
    <div class="floater float-soft" style="width:20rem;height:20rem;background:#7c6cfc;inset-block-start:-7rem;inset-inline-end:-5rem;opacity:.28"></div>
    <div class="floater float-soft" style="width:15rem;height:15rem;background:#10b4a0;inset-block-end:-6rem;inset-inline-start:-3rem;opacity:.22;animation-delay:1.2s"></div>

    <div class="relative grid items-center gap-7 lg:grid-cols-[1.4fr_1fr]">
        {{-- greeting + resume --}}
        <div>
            <span class="inline-flex items-center gap-2 rounded-full glass px-3.5 py-1.5 text-xs font-bold text-gold">
                <span class="h-1.5 w-1.5 rounded-full bg-teal-300" style="box-shadow:0 0 0 3px rgba(45,212,191,.25)"></span>
                {{ __('general.welcome_back') }}
            </span>
            <h2 class="mt-4 text-3xl font-extrabold leading-tight lg:text-4xl">
                {{ $isAr ? 'مرحباً' : 'Hello' }}، <span class="text-gradient-gold">{{ auth()->user()->name }}</span> 👋
            </h2>
            <p class="mt-2 max-w-md text-white/70">
                {{ $isAr ? 'واصل من حيث توقّفت — كل محاضرة تقرّبك من شهادتك.' : 'Pick up where you left off — every lecture brings you closer to your certificate.' }}
            </p>

            <div class="mt-6 flex flex-wrap items-center gap-3">
                @if($resume)
                    <a href="{{ route('student.lectures.show', $resume->id) }}"
                       class="btn-magnetic shine-hover gradient-gold inline-flex items-center gap-2 rounded-2xl px-6 py-3.5 text-sm font-extrabold text-navy shadow-lg glow-gold-hover">
                        <svg class="h-5 w-5"><use href="#i-play"/></svg>
                        {{ $isAr ? 'واصل التعلّم' : 'Continue learning' }}
                    </a>
                @else
                    <a href="{{ route('student.certificates.index') }}"
                       class="btn-magnetic shine-hover gradient-gold inline-flex items-center gap-2 rounded-2xl px-6 py-3.5 text-sm font-extrabold text-navy shadow-lg glow-gold-hover">
                        <svg class="h-5 w-5"><use href="#i-award"/></svg>
                        {{ $isAr ? 'شهاداتي' : 'My certificates' }}
                    </a>
                @endif
                <a href="{{ route('student.certificates.index') }}"
                   class="inline-flex items-center gap-2 rounded-2xl border border-white/15 bg-white/5 px-5 py-3.5 text-sm font-bold text-white/90 transition hover:border-gold/40 hover:text-gold">
                    <svg class="h-5 w-5"><use href="#i-award"/></svg>
                    {{ __('general.certificates') }}
                </a>
            </div>
        </div>

        {{-- overall progress ring --}}
        <div class="relative rounded-3xl glass-dark p-6">
            <p class="text-xs font-bold uppercase tracking-[0.18em] text-gold/80">{{ $isAr ? 'تقدّمك الإجمالي' : 'Overall progress' }}</p>
            <div class="mt-4 flex items-center gap-5">
                <div class="relative h-28 w-28 shrink-0">
                    <svg class="h-28 w-28 -rotate-90" viewBox="0 0 36 36" aria-hidden="true">
                        <defs><linearGradient id="dashRing" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#af9136"/><stop offset="1" stop-color="#f0d48a"/></linearGradient></defs>
                        <circle cx="18" cy="18" r="15.915" fill="none" stroke="rgba(255,255,255,.12)" stroke-width="3.2"/>
                        <circle cx="18" cy="18" r="15.915" fill="none" stroke="url(#dashRing)" stroke-width="3.2" stroke-linecap="round"
                                stroke-dasharray="{{ $overallProgress }}, 100"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-2xl font-extrabold text-gold"><span data-counter="{{ $overallProgress }}" data-suffix="%">0%</span></span>
                    </div>
                </div>
                <div class="space-y-2.5 text-sm">
                    <div class="flex items-center gap-2 text-white/85"><svg class="h-4 w-4 text-teal-300"><use href="#i-video"/></svg><span><b class="font-extrabold" data-counter="{{ $completedLectures }}">0</b> {{ $isAr ? 'محاضرة مكتملة' : 'lectures done' }}</span></div>
                    <div class="flex items-center gap-2 text-white/85"><svg class="h-4 w-4 text-violet-300"><use href="#i-check"/></svg><span><b class="font-extrabold" data-counter="{{ $passedExams }}">0</b>/{{ $totalLevels }} {{ $isAr ? 'اختبار مجتاز' : 'exams passed' }}</span></div>
                    <div class="flex items-center gap-2 text-white/85"><svg class="h-4 w-4 text-gold"><use href="#i-award"/></svg><span><b class="font-extrabold" data-counter="{{ $certificatesCount }}">0</b> {{ __('general.certificates') }}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ============ STAT CARDS ============ --}}
<div class="mb-9 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    @php
        $statsCards = [
            ['label' => $isAr ? 'التقدّم الإجمالي' : 'Overall progress', 'value' => $overallProgress, 'suffix' => '%', 'icon' => 'i-chart',    'grad' => 'linear-gradient(150deg,#7c6cfc,#9d90ff)'],
            ['label' => $isAr ? 'محاضرات مكتملة'   : 'Completed lectures','value' => $completedLectures, 'suffix' => '', 'icon' => 'i-video',   'grad' => 'linear-gradient(150deg,#10b4a0,#37d9c4)'],
            ['label' => $isAr ? 'اختبارات مجتازة'  : 'Passed exams',      'value' => $passedExams,       'suffix' => '', 'icon' => 'i-check',   'grad' => 'linear-gradient(150deg,#af9136,#d4b660)'],
            ['label' => $isAr ? 'شهاداتي'          : 'Certificates',      'value' => $certificatesCount, 'suffix' => '', 'icon' => 'i-award',   'grad' => 'linear-gradient(150deg,#ff7a59,#ff9f45)'],
        ];
    @endphp
    @foreach($statsCards as $i => $stat)
        <div class="reveal shine-hover group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-5 shadow-[0_4px_18px_-8px_rgba(22,38,75,.18)] transition hover:-translate-y-1 hover:shadow-[0_18px_40px_-16px_rgba(22,38,75,.28)]"
             style="transition-delay: {{ $i * 0.07 }}s">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-gray-500">{{ $stat['label'] }}</p>
                    <p class="mt-2 text-3xl font-extrabold text-navy" style="font-variant-numeric:tabular-nums">
                        <span data-counter="{{ $stat['value'] }}" data-suffix="{{ $stat['suffix'] }}">0{{ $stat['suffix'] }}</span>
                    </p>
                </div>
                <span class="grid h-12 w-12 place-items-center rounded-2xl text-white shadow-md transition duration-500 group-hover:scale-110 group-hover:-rotate-6"
                      style="background: {{ $stat['grad'] }}">
                    <svg class="h-6 w-6"><use href="#{{ $stat['icon'] }}"/></svg>
                </span>
            </div>
        </div>
    @endforeach
</div>

{{-- ============ LEARNING PATH ============ --}}
<div class="mb-6 flex items-end justify-between gap-4">
    <div class="reveal">
        <h3 class="text-2xl font-extrabold text-navy">{{ $isAr ? 'مسار التعلّم' : 'Your learning path' }}</h3>
        <p class="mt-1 text-sm text-gray-500">{{ $isAr ? 'تابع تقدّمك في كل مستوى وافتح التالي بالنجاح.' : 'Track each level and unlock the next by passing its exam.' }}</p>
    </div>
    <a href="{{ route('program') }}" class="hidden shrink-0 items-center gap-1 text-sm font-bold text-gold hover:text-gold-dark sm:inline-flex">
        {{ $isAr ? 'تفاصيل البرنامج' : 'Program details' }}
        <svg class="h-4 w-4 rtl:rotate-180"><use href="#i-arrow"/></svg>
    </a>
</div>

<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    @foreach($levels as $i => $level)
        @php
            $progress = $levelProgress[$level->id] ?? 0;
            $isLocked = in_array($level->id, $lockedLevels ?? []);
            $passed   = $passedLevelIds->contains($level->id);
            $ringColor = $passed ? '#12b39b' : ($isLocked ? '#cbd5e1' : '#af9136');
            $firstLecture = $level->lectures->sortBy('order')->first();
        @endphp
        <div class="reveal shine-hover group relative overflow-hidden rounded-3xl bg-white p-6 shadow-[0_4px_18px_-8px_rgba(22,38,75,.16)] transition duration-500 hover:-translate-y-1.5 hover:shadow-[0_22px_50px_-18px_rgba(22,38,75,.30)] {{ $isLocked ? 'opacity-80' : '' }}"
             style="transition-delay: {{ $i * 0.08 }}s">
            <div class="absolute inset-x-0 top-0 h-1.5" style="background: {{ $passed ? '#12b39b' : ($isLocked ? '#e5e7eb' : 'linear-gradient(90deg,#af9136,#d4b660)') }}"></div>

            <div class="flex items-start justify-between">
                {{-- progress ring with level number --}}
                <div class="relative h-16 w-16 shrink-0">
                    <svg class="h-16 w-16 -rotate-90" viewBox="0 0 36 36" aria-hidden="true">
                        <circle cx="18" cy="18" r="15.915" fill="none" stroke="#eef1f6" stroke-width="3.4"/>
                        <circle cx="18" cy="18" r="15.915" fill="none" stroke="{{ $ringColor }}" stroke-width="3.4" stroke-linecap="round"
                                stroke-dasharray="{{ max($progress, $passed ? 100 : $progress) }}, 100"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        @if($isLocked)
                            <svg class="h-6 w-6 text-gray-400"><use href="#i-lock"/></svg>
                        @elseif($passed)
                            <svg class="h-7 w-7 text-teal-500"><use href="#i-award"/></svg>
                        @else
                            <span class="text-lg font-black text-navy" style="font-variant-numeric:tabular-nums">{{ $level->order }}</span>
                        @endif
                    </div>
                </div>

                @if($passed)
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-teal-50 px-3 py-1 text-xs font-bold text-teal-700"><svg class="h-3.5 w-3.5"><use href="#i-check"/></svg>{{ __('general.passed') }}</span>
                @elseif($isLocked)
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-500"><svg class="h-3.5 w-3.5"><use href="#i-lock"/></svg>{{ __('general.locked') }}</span>
                @else
                    <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-bold text-gold-dark" style="background:rgba(175,145,54,.12)"><span class="h-1.5 w-1.5 rounded-full bg-gold animate-pulse"></span>{{ $isAr ? 'قيد التقدّم' : 'In progress' }}</span>
                @endif
            </div>

            <h4 class="mt-5 text-lg font-extrabold text-navy">{{ $level->title }}</h4>
            <p class="mt-1.5 flex items-center gap-1.5 text-xs text-gray-500">
                <svg class="h-4 w-4 text-violet-500"><use href="#i-video"/></svg>
                {{ $level->lectures->count() }} {{ $isAr ? 'محاضرة مسجّلة' : 'recorded lectures' }}
                <span class="mx-1 text-gray-300">·</span>
                <svg class="h-4 w-4 text-teal-500"><use href="#i-infinity"/></svg>
                {{ $level->passing_score ?? 70 }}% {{ $isAr ? '(محاولات لا محدودة)' : '(unlimited)' }}
            </p>

            {{-- progress bar --}}
            <div class="mt-5">
                <div class="mb-1.5 flex items-center justify-between text-xs font-semibold">
                    <span class="text-gray-500">{{ __('general.progress') }}</span>
                    <span class="text-navy" style="font-variant-numeric:tabular-nums">{{ $progress }}%</span>
                </div>
                <div class="h-2.5 overflow-hidden rounded-full bg-gray-100">
                    <div class="h-full rounded-full transition-all duration-1000" style="width: {{ $progress }}%; background: {{ $passed ? '#12b39b' : 'linear-gradient(90deg,#af9136,#d4b660)' }}"></div>
                </div>
            </div>

            {{-- actions --}}
            @if(! $isLocked)
                <div class="mt-5 flex gap-2">
                    @if($firstLecture)
                        <a href="{{ route('student.lectures.show', $firstLecture->id) }}"
                           class="btn-magnetic inline-flex flex-1 items-center justify-center gap-1.5 rounded-xl bg-navy py-2.5 text-xs font-bold text-white transition hover:bg-navy-light">
                            <svg class="h-4 w-4 text-gold"><use href="#i-play"/></svg>
                            {{ $isAr ? 'المحاضرات' : 'Lectures' }}
                        </a>
                    @endif
                    <a href="{{ route('student.exams.show', $level->id) }}"
                       class="btn-magnetic inline-flex items-center gap-1.5 rounded-xl px-4 py-2.5 text-xs font-extrabold text-navy glow-gold-hover {{ $progress >= 100 ? 'gradient-gold' : 'bg-gray-100 text-gray-500' }}">
                        <svg class="h-4 w-4"><use href="#i-check"/></svg>
                        {{ __('general.take_exam') }}
                    </a>
                </div>
            @else
                <div class="mt-5 flex items-center gap-2 rounded-xl bg-gray-50 px-4 py-3 text-xs text-gray-500">
                    <svg class="h-4 w-4 shrink-0"><use href="#i-lock"/></svg>
                    {{ $isAr ? 'أكمل واجتَز المستوى السابق لفتح هذا المستوى.' : 'Pass the previous level to unlock this one.' }}
                </div>
            @endif
        </div>
    @endforeach
</div>

@endsection
