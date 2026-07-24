@extends('layouts.admin')
@section('title', __('general.settings'))
@section('page-title', __('general.settings'))
@section('content')
<div class="mx-auto max-w-3xl">
    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6">
        @csrf @method('PUT')
        @forelse($settings as $group => $items)
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h3 class="mb-4 border-b pb-2 text-sm font-bold uppercase tracking-wide text-navy">{{ ucfirst($group) }}</h3>
            <div class="space-y-4">
                @foreach($items as $setting)
                <div>
                    <label class="block text-sm font-medium text-gray-700">{{ $setting->key }}</label>
                    <input type="hidden" name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][group]" value="{{ $group }}">
                    <input type="hidden" name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][key]" value="{{ $setting->key }}">
                    <div class="mt-1 grid gap-3 sm:grid-cols-2">
                    @if($setting->type === 'textarea')
                        <textarea name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][value_ar]" rows="2" placeholder="AR" class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('settings.'.$loop->parent->index.'_'.$loop->index.'.value_ar', $setting->value_ar) }}</textarea>
                        <textarea name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][value_en]" rows="2" placeholder="EN" class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">{{ old('settings.'.$loop->parent->index.'_'.$loop->index.'.value_en', $setting->value_en) }}</textarea>
                    @elseif($setting->type === 'boolean')
                        <select name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][value_ar]" class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                            <option value="1" {{ $setting->value_ar == '1' ? 'selected' : '' }}>{{ __('general.yes') }}</option>
                            <option value="0" {{ $setting->value_ar == '0' ? 'selected' : '' }}>{{ __('general.no') }}</option>
                        </select>
                        <input type="hidden" name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][value_en]" value="{{ $setting->value_en }}">
                    @else
                        <input type="text" name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][value_ar]" value="{{ old('settings.'.$loop->parent->index.'_'.$loop->index.'.value_ar', $setting->value_ar) }}" placeholder="AR" class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                        <input type="text" name="settings[{{ $loop->parent->index }}_{{ $loop->index }}][value_en]" value="{{ old('settings.'.$loop->parent->index.'_'.$loop->index.'.value_en', $setting->value_en) }}" placeholder="EN" class="block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                    @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @empty
        <div class="rounded-xl border border-gray-200 bg-white p-8 text-center text-gray-400">{{ __('general.no_data') }}</div>
        @endforelse
        <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.save') }}</button>
    </form>
</div>
@endsection
