@extends('layouts.student')

@section('title', __('general.exam_result'))
@section('page-title', __('general.exam_result'))

@section('content')
<div class="mx-auto max-w-2xl">
    <div class="rounded-2xl border {{ $attempt->passed ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50' }} p-8 text-center">
        @if($attempt->passed)
            <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h2 class="mt-4 text-2xl font-bold text-green-700">{{ __('general.congratulations') }}!</h2>
            <p class="mt-2 text-green-600">{{ __('general.exam_passed_msg') }}</p>
        @else
            <svg class="mx-auto h-16 w-16 text-red-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h2 class="mt-4 text-2xl font-bold text-red-600">{{ __('general.not_passed') }}</h2>
            <p class="mt-2 text-red-500">{{ __('general.exam_failed_msg') }}</p>
        @endif

        <div class="mt-6 grid grid-cols-3 gap-4 text-sm">
            <div class="rounded-lg bg-white p-3">
                <p class="text-gray-500">{{ __('general.score') }}</p>
                <p class="text-xl font-bold text-navy">{{ number_format($attempt->score, 1) }}%</p>
            </div>
            <div class="rounded-lg bg-white p-3">
                <p class="text-gray-500">{{ __('general.correct_answers') }}</p>
                <p class="text-xl font-bold text-navy">{{ $attempt->correct_answers }}/{{ $attempt->total_questions }}</p>
            </div>
            <div class="rounded-lg bg-white p-3">
                <p class="text-gray-500">{{ __('general.pass_score') }}</p>
                <p class="text-xl font-bold text-navy">{{ $level->passing_score }}%</p>
            </div>
        </div>
    </div>

    <div class="mt-6 flex justify-center gap-4">
        @if(!$attempt->passed)
            <a href="{{ route('student.exams.show', $level->id) }}" class="rounded-lg bg-navy px-6 py-2 text-sm font-medium text-white hover:bg-navy-light">
                {{ __('general.retry_exam') }}
            </a>
        @endif
        <a href="{{ route('student.exams.history', $level->id) }}" class="rounded-lg border border-gray-300 px-6 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            {{ __('general.exam_history') }}
        </a>
        <a href="{{ route('student.dashboard') }}" class="rounded-lg border border-gray-300 px-6 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            {{ __('general.back_to_dashboard') }}
        </a>
    </div>
</div>
@endsection
