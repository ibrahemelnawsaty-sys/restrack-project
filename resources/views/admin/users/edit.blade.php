@extends('layouts.admin')

@section('title', __('general.edit') . ' ' . __('general.user'))
@section('page-title', __('general.edit') . ': ' . $user->name)

@section('content')
<div class="mx-auto max-w-2xl">
    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-5 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        @csrf @method('PUT')

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('general.name') }}</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
            @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('general.email') }}</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
            @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('general.password') }} <span class="text-xs text-gray-400">({{ __('general.leave_blank_password') }})</span></label>
            <input type="password" name="password" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
            @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">{{ __('general.role') }}</label>
            <select name="role" class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                <option value="student" {{ $user->hasRole('student') ? 'selected' : '' }}>{{ __('general.student') }}</option>
                <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>{{ __('general.admin') }}</option>
                <option value="super_admin" {{ $user->hasRole('super_admin') ? 'selected' : '' }}>{{ __('general.super_admin') }}</option>
            </select>
        </div>

        <div class="flex items-center gap-2">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ $user->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-gold focus:ring-gold">
            <label for="is_active" class="text-sm text-gray-700">{{ __('general.active') }}</label>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white hover:bg-navy-light">{{ __('general.save') }}</button>
            <a href="{{ route('admin.users.index') }}" class="rounded-lg border border-gray-300 px-6 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50">{{ __('general.cancel') }}</a>
        </div>
    </form>
</div>
@endsection
