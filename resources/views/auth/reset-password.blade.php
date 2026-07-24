@extends('layouts.app')

@section('title', __('general.reset_password') . ' — Restrack')

@section('content')
<section class="flex min-h-[calc(100vh-10rem)] items-center justify-center bg-gray-50 py-12">
    <div class="w-full max-w-md px-4">
        <div class="rounded-2xl bg-white p-8 shadow-sm">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-navy">{{ __('general.reset_password') }}</h1>
            </div>

            <form method="POST" action="{{ route('password.update') }}" class="mt-8 space-y-5">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">{{ __('general.email') }}</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $email ?? '') }}" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-gold focus:ring-gold">
                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">{{ __('general.new_password') }}</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-gold focus:ring-gold">
                    @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">{{ __('general.confirm_password') }}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-gold focus:ring-gold">
                </div>

                <button type="submit" class="w-full rounded-lg bg-navy py-3 text-sm font-semibold text-white transition hover:bg-navy-light">
                    {{ __('general.reset_password') }}
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
