@extends('layouts.student')

@section('title', __('general.dashboard'))
@section('page-title', __('general.dashboard'))

@section('content')

{{-- ============ WELCOME HERO ============ --}}
<div class="relative mb-8 overflow-hidden rounded-3xl gradient-navy p-6 text-white shadow-xl lg:p-10">
    <div class="absolute inset-0 bg-grid opacity-20"></div>
    <div class="floater gradient-gold w-64 h-64 -top-16 -end-16 opacity-30"></div>
    <div class="stars-bg absolute inset-0"></div>

    <div class="relative grid items-center gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 animate-fade-up">
            <span class="inline-flex items-center gap-2 rounded-full glass px-3 py-1 text-xs text-gold">
                <span class="h-1.5 w-1.5 rounded-full bg-gold animate-pulse"></span>
                {{ __('general.welcome_back') }}
            </span>
            <h2 class="mt-3 text-3xl font-extrabold lg:text-4xl">
                {{ __('general.hello') ?? 'مرحباً' }}, <span class="text-gradient-gold">{{ auth()->user()->name }}!</span>
            </h2>
            <p class="mt-2 text-white/70">{{ __('general.dashboard_subtitle') }}</p>
        </div>

        {{-- Quick stats summary --}}
        <div class="relative rounded-2xl glass-dark p-5 animate-fade-up delay-200">
            <p class="text-xs uppercase tracking-wider text-gold/80">{{ __('general.overall_progress') ?? 'التقدم الإجمالي' }}</p>
            <div class="mt-3 flex items-center gap-4">
                <div class="relative h-20 w-20 shrink-0">
                    <svg class="ring-progress h-20 w-20" viewBox="0 0 36 36">
                        <circle cx="18" cy="18" r="15.915" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="3"/>
                        <circle cx="18" cy="18" r="15.915" fill="none" stroke="#d4b660" stroke-width="3"
                                stroke-linecap="round"
                                stroke-dasharray="{{ $overallProgress }}, 100"/>
                    </svg>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <span class="text-lg font-extrabold text-gold">{{ $overallProgress }}%</span>
                    </div>
                </div>
                <div>
                    <p class="text-2xl font-extrabold text-white">{{ $completedLectures }}</p>
                    <p class="text-xs text-white/60">{{ __('general.completed_lectures') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ============ STATS GRID ============ --}}
<div class="mb-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
    @php
        $statsCards = [
            ['label' => __('general.total_progress'),     'value' => $overallProgress . '%', 'icon' => 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6', 'g1' => 'from-blue-500',   'g2' => 'to-indigo-600'],
            ['label' => __('general.completed_lectures'), 'value' => $completedLectures,    'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'g1' => 'from-emerald-500','g2' => 'to-green-600'],
            ['label' => __('general.passed_exams'),       'value' => $passedExams,           'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'g1' => 'from-purple-500', 'g2' => 'to-pink-600'],
            ['label' => __('general.certificates'),       'value' => $certificatesCount,     'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',  'g1' => 'from-amber-500',  'g2' => 'to-orange-600'],
        ];
    @endphp

    @foreach($statsCards as $i => $stat)
    <div class="group relative overflow-hidden rounded-2xl border border-gray-100 bg-white p-5 shadow-sm card-lift">
        <div class="absolute -end-6 -top-6 h-28 w-28 rounded-full bg-gradient-to-br {{ $stat['g1'] }} {{ $stat['g2'] }} opacity-10 blur-xl transition group-hover:scale-150"></div>
        <div class="relative flex items-start justify-between">
            <div>
                <p class="text-sm text-gray-500">{{ $stat['label'] }}</p>
                <p class="mt-2 text-3xl font-extrabold text-navy">{{ $stat['value'] }}</p>
            </div>
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br {{ $stat['g1'] }} {{ $stat['g2'] }} text-white shadow-md transition group-hover:scale-110 group-hover:rotate-6">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $stat['icon'] }}"/></svg>
            </div>
        </div>
        <div class="mt-4 flex items-center gap-1 text-xs text-gray-400">
            <svg class="h-3 w-3 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z"/></svg>
            <span>{{ __('general.keep_going') ?? 'استمر في التقدم' }}</span>
        </div>
    </div>
    @endforeach
</div>

{{-- ============ LEVELS ============ --}}
<div class="mb-6 flex items-center justify-between">
    <div>
        <h3 class="text-2xl font-extrabold text-navy">{{ __('general.your_levels') }}</h3>
        <p class="mt-1 text-sm text-gray-500">{{ __('general.your_levels_subtitle') ?? 'تابع تقدمك في كل مستوى' }}</p>
    </div>
    <a href="#" class="hidden text-sm font-semibold text-gold hover:text-gold-dark sm:inline-flex items-center gap-1">
        {{ __('general.view_all') ?? 'عرض الكل' }}
        <svg class="h-4 w-4 rtl:rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
    </a>
</div>

<div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    @foreach($levels as $level)
    @php
        $progress = $levelProgress[$level->id] ?? 0;
        $isLocked = isset($lockedLevels) && in_array($level->id, $lockedLevels);
        $passed = $passedLevelIds->contains($level->id);
    @endphp
    <div class="group relative overflow-hidden rounded-2xl bg-white shadow-sm card-lift {{ $isLocked ? 'opacity-70' : '' }}">
        {{-- Top color band --}}
        <div class="absolute inset-x-0 top-0 h-1 {{ $passed ? 'bg-green-500' : ($isLocked ? 'bg-gray-300' : 'gradient-gold') }}"></div>

        <div class="p-6">
            <div class="flex items-start justify-between">
                <div class="relative">
                    <div class="absolute inset-0 rounded-2xl gradient-gold opacity-0 blur-md transition group-hover:opacity-60"></div>
                    <span class="relative flex h-14 w-14 items-center justify-center rounded-2xl
                                 {{ $passed ? 'bg-green-100 text-green-700' : ($isLocked ? 'bg-gray-100 text-gray-400' : 'gradient-gold text-navy') }}
                                 text-xl font-black shadow-lg">
                        {{ $level->order }}
                    </span>
                </div>

                @if($passed)
                    <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        {{ __('general.passed') }}
                    </span>
                @elseif($isLocked)
                    <span class="inline-flex items-center gap-1 rounded-full bg-gray-100 px-3 py-1 text-xs font-bold text-gray-500">
                        <svg class="h-3 w-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        {{ __('general.locked') }}
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 rounded-full bg-gold/10 px-3 py-1 text-xs font-bold text-gold-dark">
                        <span class="h-1.5 w-1.5 rounded-full bg-gold animate-pulse"></span>
                        {{ __('general.in_progress') ?? 'قيد التقدم' }}
                    </span>
                @endif
            </div>

            <h4 class="mt-5 text-lg font-bold text-navy">{{ $level->title }}</h4>
            <p class="mt-1 flex items-center gap-1.5 text-xs text-gray-500">
                <svg class="h-3.5 w-3.5 text-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                {{ $level->lectures->count() }} {{ __('general.lectures') }}
            </p>

            {{-- Progress bar --}}
            <div class="mt-5">
                <div class="flex items-center justify-between text-xs font-semibold">
                    <span class="text-gray-600">{{ __('general.progress') }}</span>
                    <span class="text-navy">{{ $progress }}%</span>
                </div>
                <div class="mt-2 h-2.5 overflow-hidden rounded-full bg-gray-100">
                    <div class="h-full rounded-full {{ $passed ? 'bg-green-500' : 'gradient-gold' }} transition-all duration-700"
                         style="width: {{ $progress }}%; background-size: 200% auto;"></div>
                </div>
            </div>

            @if(!$isLocked)
                <div class="mt-5 flex gap-2">
                    @php $firstLecture = $level->lectures->sortBy('order')->first(); @endphp
                    @if($firstLecture)
                    <a href="{{ route('student.lectures.show', $firstLecture->id) }}"
                       class="btn-magnetic flex-1 inline-flex items-center justify-center gap-1.5 rounded-xl bg-navy py-2.5 text-xs font-bold text-white transition hover:bg-navy-light">
                        <svg class="h-4 w-4 text-gold" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        {{ __('general.continue_learning') }}
                    </a>
                    @endif
                    @if($progress >= 100)
                        <a href="{{ route('student.exams.show', $level->id) }}"
                           class="btn-magnetic inline-flex items-center gap-1.5 rounded-xl gradient-gold px-4 py-2.5 text-xs font-bold text-navy glow-gold-hover">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            {{ __('general.take_exam') }}
                        </a>
                    @endif
                </div>
            @else
                <div class="mt-5 flex items-center gap-2 rounded-xl bg-gray-50 px-4 py-3 text-xs text-gray-500">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ __('general.complete_previous_level') ?? 'أكمل المستوى السابق للوصول إلى هذا المستوى' }}
                </div>
            @endif
        </div>
    </div>
    @endforeach
</div>

@endsection
