@extends('layouts.student')

@section('title', __('general.survey'))
@section('page-title', __('general.quality_survey'))

@section('content')
<div class="mx-auto max-w-2xl">
    <div class="mb-6 rounded-xl border border-gold/20 bg-gold/5 p-4 text-sm text-navy">
        {{ __('general.survey_description') }}
    </div>

    <form method="POST" action="{{ route('student.survey.store') }}" class="space-y-6">
        @csrf

        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            @foreach([
                'content_quality' => __('general.content_quality'),
                'clarity' => __('general.clarity'),
                'speaker_quality' => __('general.speaker_quality'),
                'tech_quality' => __('general.tech_quality'),
                'ease_of_use' => __('general.ease_of_use'),
            ] as $field => $label)
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                <div class="mt-2 flex gap-2">
                    @for($s = 1; $s <= 5; $s++)
                    <label class="cursor-pointer">
                        <input type="radio" name="{{ $field }}" value="{{ $s }}" class="peer hidden" {{ old($field) == $s ? 'checked' : '' }} required>
                        <span class="flex h-10 w-10 items-center justify-center rounded-lg border border-gray-200 text-sm font-medium text-gray-500 transition peer-checked:border-gold peer-checked:bg-gold peer-checked:text-navy hover:border-gold/50">
                            {{ $s }}
                        </span>
                    </label>
                    @endfor
                </div>
                <p class="mt-1 text-xs text-gray-400">1 = {{ __('general.poor') }}, 5 = {{ __('general.excellent') }}</p>
                @error($field) <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>
            @endforeach

            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700">{{ __('general.would_recommend') }}</label>
                <div class="mt-2 flex gap-4">
                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input type="radio" name="would_recommend" value="1" {{ old('would_recommend') == '1' ? 'checked' : '' }} required
                            class="border-gray-300 text-gold focus:ring-gold">
                        {{ __('general.yes') }}
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-600">
                        <input type="radio" name="would_recommend" value="0" {{ old('would_recommend') == '0' ? 'checked' : '' }}
                            class="border-gray-300 text-gold focus:ring-gold">
                        {{ __('general.no') }}
                    </label>
                </div>
            </div>

            <div>
                <label for="suggestions" class="block text-sm font-medium text-gray-700">{{ __('general.suggestions') }}</label>
                <textarea id="suggestions" name="suggestions" rows="4"
                    class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('suggestions') }}</textarea>
            </div>
        </div>

        <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-navy-light">
            {{ __('general.submit_survey') }}
        </button>
    </form>
</div>
@endsection
