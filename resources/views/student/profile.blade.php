@extends('layouts.student')

@section('title', __('general.profile'))
@section('page-title', __('general.profile'))

@section('content')
<div class="mx-auto max-w-2xl">
    <form method="POST" action="{{ route('student.profile.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-navy">{{ __('general.personal_info') }}</h3>

            <div class="mt-5 space-y-4">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">{{ __('general.name') }}</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                    @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">{{ __('general.email') }}</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">{{ __('general.phone') }}</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                </div>

                <div>
                    <label for="locale" class="block text-sm font-medium text-gray-700">{{ __('general.preferred_language') }}</label>
                    <select id="locale" name="locale"
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                        <option value="ar" {{ $user->locale === 'ar' ? 'selected' : '' }}>العربية</option>
                        <option value="en" {{ $user->locale === 'en' ? 'selected' : '' }}>English</option>
                    </select>
                </div>

                <div>
                    <label for="avatar" class="block text-sm font-medium text-gray-700">{{ __('general.avatar') }}</label>
                    <input type="file" id="avatar" name="avatar" accept="image/*"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:rounded-lg file:border-0 file:bg-gold/10 file:px-4 file:py-2 file:text-sm file:font-medium file:text-gold hover:file:bg-gold/20">
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-navy">{{ __('general.change_password') }}</h3>
            <p class="text-xs text-gray-500">{{ __('general.leave_blank_password') }}</p>

            <div class="mt-5 space-y-4">
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700">{{ __('general.current_password') }}</label>
                    <input type="password" id="current_password" name="current_password"
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                    @error('current_password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">{{ __('general.new_password') }}</label>
                    <input type="password" id="password" name="password"
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                    @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('general.confirm_password') }}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm focus:border-gold focus:ring-gold">
                </div>
            </div>
        </div>

        <button type="submit" class="rounded-lg bg-navy px-6 py-2.5 text-sm font-semibold text-white transition hover:bg-navy-light">
            {{ __('general.save_changes') }}
        </button>
    </form>
</div>
@endsection
