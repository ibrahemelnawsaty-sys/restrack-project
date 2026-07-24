@extends('layouts.admin')
@section('title', __('general.faqs'))
@section('page-title', __('general.faqs'))
@section('content')
<div class="mb-4 flex justify-end"><a href="{{ route('admin.faqs.create') }}" class="rounded-lg bg-navy px-5 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">+ {{ __('general.add_new') }}</a></div>
<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50"><tr>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">#</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.question') }} (AR)</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.question') }} (EN)</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.order') }}</th>
                <th class="px-4 py-3 text-start font-semibold text-gray-600">{{ __('general.actions') }}</th>
            </tr></thead>
            <tbody class="divide-y divide-gray-100">
            @forelse($faqs as $faq)
                <tr>
                    <td class="px-4 py-3 text-gray-500">{{ $faq->id }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ Str::limit($faq->question_ar, 50) }}</td>
                    <td class="px-4 py-3 text-gray-700">{{ Str::limit($faq->question_en, 50) }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $faq->order }}</td>
                    <td class="px-4 py-3 flex gap-2">
                        <a href="{{ route('admin.faqs.edit', $faq) }}" class="text-navy hover:text-gold">{{ __('general.edit') }}</a>
                        <form method="POST" action="{{ route('admin.faqs.destroy', $faq) }}" onsubmit="return confirm('{{ __('general.confirm_delete') }}')">@csrf @method('DELETE')<button class="text-red-600 hover:text-red-800">{{ __('general.delete') }}</button></form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">{{ __('general.no_data') }}</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($faqs->hasPages())<div class="border-t px-4 py-3">{{ $faqs->links() }}</div>@endif
</div>
@endsection
