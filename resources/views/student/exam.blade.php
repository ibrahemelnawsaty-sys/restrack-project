@extends('layouts.student')

@section('title', __('general.exam') . ' — ' . $level->title)
@section('page-title', __('general.exam') . ': ' . $level->title)

@section('content')
<div class="mx-auto max-w-3xl">
    <div class="mb-6 rounded-xl border border-gold/20 bg-gold/5 p-4 text-sm text-navy">
        <strong>{{ __('general.exam_info') }}:</strong>
        {{ $questions->count() }} {{ __('general.questions') }} |
        {{ __('general.pass_score') }}: {{ $level->passing_score }}%
    </div>

    <form method="POST" action="{{ route('student.exams.submit', $level->id) }}" x-data="{ started: Date.now() }">
        @csrf
        <input type="hidden" name="started_at" :value="new Date(started).toISOString()">

        <div class="space-y-6">
            @foreach($questions as $i => $question)
            <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
                <p class="mb-4 font-medium text-navy">
                    <span class="text-gold">{{ $i + 1 }}.</span> {{ $question->question }}
                </p>

                @if($question->type === 'mcq')
                    @foreach($question->options as $key => $option)
                    <label class="mb-2 flex cursor-pointer items-start gap-3 rounded-lg border border-gray-100 p-3 transition hover:bg-gray-50">
                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $key }}" required
                            class="mt-0.5 border-gray-300 text-gold focus:ring-gold">
                        <span class="text-sm text-gray-700">{{ $option }}</span>
                    </label>
                    @endforeach
                @elseif($question->type === 'true_false')
                    <label class="mb-2 flex cursor-pointer items-start gap-3 rounded-lg border border-gray-100 p-3 transition hover:bg-gray-50">
                        <input type="radio" name="answers[{{ $question->id }}]" value="true" required
                            class="mt-0.5 border-gray-300 text-gold focus:ring-gold">
                        <span class="text-sm text-gray-700">{{ __('general.true') }}</span>
                    </label>
                    <label class="mb-2 flex cursor-pointer items-start gap-3 rounded-lg border border-gray-100 p-3 transition hover:bg-gray-50">
                        <input type="radio" name="answers[{{ $question->id }}]" value="false" required
                            class="mt-0.5 border-gray-300 text-gold focus:ring-gold">
                        <span class="text-sm text-gray-700">{{ __('general.false') }}</span>
                    </label>
                @endif
            </div>
            @endforeach
        </div>

        <div class="mt-8 text-center">
            <button type="submit" class="rounded-xl bg-navy px-10 py-3 font-semibold text-white transition hover:bg-navy-light">
                {{ __('general.submit_exam') }}
            </button>
        </div>
    </form>
</div>
@endsection
