@extends('layouts.admin')
@section('title', __('general.appearance'))
@section('page-title', __('general.appearance'))
@section('content')
<div class="mx-auto max-w-3xl">
    <form method="POST" action="{{ route('admin.appearance.update') }}" class="space-y-6">
        @csrf @method('PUT')

        @foreach($schema as $group => $fields)
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h3 class="mb-4 border-b pb-2 text-sm font-bold uppercase tracking-wide text-navy">
                {{ __('general.'.$group) !== 'general.'.$group ? __('general.'.$group) : ucfirst($group) }}
            </h3>
            <div class="space-y-4">
                @foreach($fields as $key => $meta)
                    @php
                        $model = $settings->get($key);
                        $labelKey = 'general.'.$key;
                        $label = __($labelKey) !== $labelKey ? __($labelKey) : $key;
                        $curAr = $model?->value_ar ?? ($meta['bilingual'] ? ($meta['ar'] ?? '') : ($meta['default'] ?? ''));
                        $curEn = $model?->value_en ?? ($meta['bilingual'] ? ($meta['en'] ?? '') : ($meta['default'] ?? ''));
                        $curSingle = $model?->value_ar ?? ($meta['default'] ?? '');
                    @endphp
                    <div>
                        <label class="block text-sm font-medium text-gray-700">{{ $label }}</label>

                        @if($meta['bilingual'])
                            <div class="mt-1 grid gap-3 sm:grid-cols-2">
                                @if($meta['type'] === 'textarea')
                                    <textarea name="{{ $key }}_ar" rows="2" placeholder="AR" class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old($key.'_ar', $curAr) }}</textarea>
                                    <textarea name="{{ $key }}_en" rows="2" placeholder="EN" class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old($key.'_en', $curEn) }}</textarea>
                                @else
                                    <input type="text" name="{{ $key }}_ar" value="{{ old($key.'_ar', $curAr) }}" placeholder="AR" class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                                    <input type="text" name="{{ $key }}_en" value="{{ old($key.'_en', $curEn) }}" placeholder="EN" class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                                @endif
                            </div>
                        @else
                            <div class="mt-1">
                                <input type="text" name="{{ $key }}" value="{{ old($key, $curSingle) }}" class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                            </div>
                        @endif

                        @error($key)
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
            </div>
        </div>
        @endforeach

        <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.save') }}</button>
    </form>
</div>
@endsection
