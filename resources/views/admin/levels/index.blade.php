@extends('layouts.admin')
@section('title', __('general.levels'))
@section('page-title', __('general.levels'))

@section('content')
<div class="mb-4 flex items-center justify-between">
    <div></div>
    <a href="{{ route('admin.levels.create') }}" class="rounded-lg bg-gold px-4 py-2 text-sm font-medium text-navy hover:bg-gold-light">+ {{ __('general.add_new') }}</a>
</div>

<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <table class="w-full text-sm">
        <thead class="border-b bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.order') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.title') }} (AR)</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.title') }} (EN)</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.lectures') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.pass_score') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.status') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.actions') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($levels as $level)
            <tr>
                <td class="px-4 py-3 font-bold text-navy">{{ $level->order }}</td>
                <td class="px-4 py-3 text-gray-800">{{ $level->title_ar }}</td>
                <td class="px-4 py-3 text-gray-800">{{ $level->title_en }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $level->lectures_count }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $level->passing_score }}%</td>
                <td class="px-4 py-3">
                    <span class="rounded-full px-2 py-0.5 text-xs font-medium {{ $level->is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                        {{ $level->is_published ? __('general.published') : __('general.draft') }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.levels.edit', $level) }}" class="text-xs text-gold hover:text-gold-dark">{{ __('general.edit') }}</a>
                        <form method="POST" action="{{ route('admin.levels.destroy', $level) }}" onsubmit="return confirm('{{ __('general.confirm_delete') }}')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-500 hover:text-red-700">{{ __('general.delete') }}</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="px-4 py-8 text-center text-gray-400">{{ __('general.no_data') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
