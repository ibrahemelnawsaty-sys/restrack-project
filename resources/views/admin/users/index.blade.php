@extends('layouts.admin')

@section('title', __('general.users'))
@section('page-title', __('general.users'))

@section('content')
<div class="mb-4 flex items-center justify-between">
    <div></div>
    <a href="{{ route('admin.users.create') }}" class="rounded-lg bg-gold px-4 py-2 text-sm font-medium text-navy hover:bg-gold-light">
        + {{ __('general.add_new') }}
    </a>
</div>

<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
    <table class="w-full text-sm">
        <thead class="border-b bg-gray-50">
            <tr>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.name') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.email') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.role') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.status') }}</th>
                <th class="px-4 py-3 text-start font-medium text-gray-600">{{ __('general.actions') }}</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($users as $user)
            <tr>
                <td class="px-4 py-3 font-medium text-gray-800">{{ $user->name }}</td>
                <td class="px-4 py-3 text-gray-600">{{ $user->email }}</td>
                <td class="px-4 py-3">
                    @foreach($user->roles as $role)
                        <span class="rounded-full bg-navy/10 px-2 py-0.5 text-xs font-medium text-navy">{{ $role->name }}</span>
                    @endforeach
                </td>
                <td class="px-4 py-3">
                    <span class="rounded-full px-2 py-0.5 text-xs font-medium {{ $user->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $user->is_active ? __('general.active') : __('general.inactive') }}
                    </span>
                </td>
                <td class="px-4 py-3">
                    <div class="flex gap-2">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-xs text-gold hover:text-gold-dark">{{ __('general.edit') }}</a>
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('{{ __('general.confirm_delete') }}')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-500 hover:text-red-700">{{ __('general.delete') }}</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="px-4 py-8 text-center text-gray-400">{{ __('general.no_data') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@if($users->hasPages())
<div class="mt-4">{{ $users->links() }}</div>
@endif
@endsection
