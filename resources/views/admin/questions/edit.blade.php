@extends('layouts.admin')
@section('title', __('general.edit') . ' ' . __('general.question'))
@section('page-title', __('general.edit') . ' ' . __('general.question'))
@section('content')
<div class="mx-auto max-w-2xl">
    <form method="POST" action="{{ route('admin.questions.update', $question) }}" class="space-y-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm" x-data="{ type: '{{ old('type', $question->type) }}' }">
        @csrf @method('PUT')
        <div><label class="block text-sm font-medium text-gray-700">{{ __('general.level') }}</label><select name="level_id" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"><option value="">—</option>@foreach($levels as $level)<option value="{{ $level->id }}" {{ old('level_id', $question->level_id) == $level->id ? 'selected' : '' }}>{{ $level->title_en }}</option>@endforeach</select></div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.question') }} (AR)</label><textarea name="question_ar" rows="3" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('question_ar', $question->question_ar) }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.question') }} (EN)</label><textarea name="question_en" rows="3" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('question_en', $question->question_en) }}</textarea></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.type') }}</label><select name="type" x-model="type" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"><option value="mcq">MCQ</option><option value="true_false">True/False</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.difficulty') }}</label><select name="difficulty" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"><option value="easy" {{ old('difficulty', $question->difficulty) === 'easy' ? 'selected' : '' }}>Easy</option><option value="medium" {{ old('difficulty', $question->difficulty) === 'medium' ? 'selected' : '' }}>Medium</option><option value="hard" {{ old('difficulty', $question->difficulty) === 'hard' ? 'selected' : '' }}>Hard</option></select></div>
        </div>
        @php $opts_ar = old('options_ar', $question->options_ar ?? []); $opts_en = old('options_en', $question->options_en ?? []); @endphp
        <div x-show="type === 'mcq'">
            <p class="mb-2 text-sm font-medium text-gray-700">{{ __('general.options') }} (AR)</p>
            @for($i = 0; $i < 4; $i++)
            <input type="text" name="options_ar[]" value="{{ $opts_ar[$i] ?? '' }}" placeholder="{{ __('general.option') }} {{ $i + 1 }}" class="mb-2 block w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-gold focus:ring-gold">
            @endfor
            <p class="mb-2 mt-4 text-sm font-medium text-gray-700">{{ __('general.options') }} (EN)</p>
            @for($i = 0; $i < 4; $i++)
            <input type="text" name="options_en[]" value="{{ $opts_en[$i] ?? '' }}" placeholder="Option {{ $i + 1 }}" class="mb-2 block w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-gold focus:ring-gold">
            @endfor
        </div>
        <div><label class="block text-sm font-medium text-gray-700">{{ __('general.correct_answer') }}</label><input type="text" name="correct_answer" value="{{ old('correct_answer', $question->correct_answer) }}" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.explanation') }} (AR)</label><textarea name="explanation_ar" rows="2" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('explanation_ar', $question->explanation_ar) }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.explanation') }} (EN)</label><textarea name="explanation_en" rows="2" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('explanation_en', $question->explanation_en) }}</textarea></div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.update') }}</button>
            <a href="{{ route('admin.questions.index') }}" class="rounded-lg border border-gray-300 px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">{{ __('general.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
