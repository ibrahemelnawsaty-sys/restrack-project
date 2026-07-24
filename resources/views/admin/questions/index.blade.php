@extends('layouts.admin')
@section('title', __('general.questions'))
@section('page-title', __('general.questions'))
@section('content')
<div class="mb-4 flex items-center justify-between">
    <div></div>
    <a href="{{ route('admin.questions.create') }}" class="rounded-lg bg-gold px-4 py-2 text-sm font-medium text-navy hover:bg-gold-light">+ {{ __('general.add_new') }}</a>
</div>
<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <table class="w-full text-sm">
        <thead class="border-b bg-gray-50"><tr>
            <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.question') }}</th>
            <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.level') }}</th>
            <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.type') }}</th>
            <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.difficulty') }}</th>
            <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.actions') }}</th>
        </tr></thead>
        <tbody class="divide-y">
            @forelse($questions as $q)
            <tr>
                <td class="max-w-xs truncate px-4 py-3 text-gray-800">{{ Str::limit($q->question_en, 80) }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $q->level->title_en ?? '—' }}</td>
                <td class="px-4 py-3"><span class="rounded bg-gray-100 px-2 py-0.5 text-xs">{{ strtoupper($q->type) }}</span></td>
                <td class="px-4 py-3"><span class="rounded px-2 py-0.5 text-xs {{ $q->difficulty === 'easy' ? 'bg-green-100 text-green-700' : ($q->difficulty === 'hard' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">{{ $q->difficulty }}</span></td>
                <td class="px-4 py-3">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.questions.edit', $q) }}" class="text-xs text-gold hover:text-gold-dark">{{ __('general.edit') }}</a>
                        <form method="POST" action="{{ route('admin.questions.destroy', $q) }}" onsubmit="return confirm('{{ __('general.confirm_delete') }}')">@csrf @method('DELETE')<button class="text-xs text-red-500 hover:text-red-700">{{ __('general.delete') }}</button></form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">{{ __('general.no_data') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@if($questions->hasPages())<div class="mt-4">{{ $questions->links() }}</div>@endif
@endsection
