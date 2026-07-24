@extends('layouts.student')

@section('title', __('general.exam_history'))
@section('page-title', __('general.exam_history') . ': ' . $level->title)

@section('content')
<div class="mx-auto max-w-3xl">
    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="w-full text-sm">
            <thead class="border-b bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-start font-medium text-gray-600">#</th>
                    <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.score') }}</th>
                    <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.correct_answers') }}</th>
                    <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.status') }}</th>
                    <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.date') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($attempts as $i => $attempt)
                <tr>
                    <td class="px-4 py-3 text-gray-500">{{ $i + 1 }}</td>
                    <td class="px-4 py-3 font-medium text-navy">{{ number_format($attempt->score, 1) }}%</td>
                    <td class="px-4 py-3 text-gray-600">{{ $attempt->correct_answers }}/{{ $attempt->total_questions }}</td>
                    <td class="px-4 py-3">
                        @if($attempt->passed)
                            <span class="rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-700">{{ __('general.passed') }}</span>
                        @else
                            <span class="rounded-full bg-red-100 px-2 py-0.5 text-xs font-medium text-red-700">{{ __('general.failed') }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ $attempt->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-4 py-8 text-center text-gray-400">{{ __('general.no_attempts') }}</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('student.dashboard') }}" class="text-sm text-gold hover:text-gold-dark">← {{ __('general.back_to_dashboard') }}</a>
    </div>
</div>
@endsection
