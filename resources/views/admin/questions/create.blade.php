@extends('layouts.admin')
@section('title', __('general.add_new') . ' ' . __('general.question'))
@section('page-title', __('general.add_new') . ' ' . __('general.question'))
@section('content')
<div class="mx-auto max-w-2xl">
    <form method="POST" action="{{ route('admin.questions.store') }}" class="space-y-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm" x-data="{ type: '{{ old('type', 'mcq') }}' }">
        @csrf
        <div><label class="block text-sm font-medium text-gray-700">{{ __('general.level') }}</label><select name="level_id" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"><option value="">—</option>@foreach($levels as $level)<option value="{{ $level->id }}" {{ old('level_id') == $level->id ? 'selected' : '' }}>{{ $level->title_en }}</option>@endforeach</select></div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.question') }} (AR)</label><textarea name="question_ar" rows="3" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('question_ar') }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.question') }} (EN)</label><textarea name="question_en" rows="3" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('question_en') }}</textarea></div>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.type') }}</label><select name="type" x-model="type" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"><option value="mcq">MCQ</option><option value="true_false">True/False</option></select></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.difficulty') }}</label><select name="difficulty" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"><option value="easy">Easy</option><option value="medium" selected>Medium</option><option value="hard">Hard</option></select></div>
        </div>
        <div x-show="type === 'mcq'">
            <p class="mb-2 text-sm font-medium text-gray-700">{{ __('general.options') }} (AR)</p>
            @for($i = 0; $i < 4; $i++)
            <input type="text" name="options_ar[]" value="{{ old('options_ar.'.$i) }}" placeholder="{{ __('general.option') }} {{ $i + 1 }}" class="mb-2 block w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-gold focus:ring-gold">
            @endfor
            <p class="mb-2 mt-4 text-sm font-medium text-gray-700">{{ __('general.options') }} (EN)</p>
            @for($i = 0; $i < 4; $i++)
            <input type="text" name="options_en[]" value="{{ old('options_en.'.$i) }}" placeholder="Option {{ $i + 1 }}" class="mb-2 block w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-gold focus:ring-gold">
            @endfor
        </div>
        <div><label class="block text-sm font-medium text-gray-700">{{ __('general.correct_answer') }}</label><input type="text" name="correct_answer" value="{{ old('correct_answer') }}" required placeholder="0, 1, 2, 3 or true/false" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold"></div>
        <div class="grid gap-4 sm:grid-cols-2">
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.explanation') }} (AR)</label><textarea name="explanation_ar" rows="2" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('explanation_ar') }}</textarea></div>
            <div><label class="block text-sm font-medium text-gray-700">{{ __('general.explanation') }} (EN)</label><textarea name="explanation_en" rows="2" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('explanation_en') }}</textarea></div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.save') }}</button>
            <a href="{{ route('admin.questions.index') }}" class="rounded-lg border border-gray-300 px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">{{ __('general.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
