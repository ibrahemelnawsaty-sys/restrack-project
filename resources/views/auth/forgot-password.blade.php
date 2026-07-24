@extends('layouts.app')

@section('title', __('general.forgot_password') . ' — Restrack')

@section('content')
<section class="flex min-h-[calc(100vh-10rem)] items-center justify-center bg-gray-50 py-12">
    <div class="w-full max-w-md px-4">
        <div class="rounded-2xl bg-white p-8 shadow-sm">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-navy">{{ __('general.forgot_password') }}</h1>
                <p class="mt-1 text-sm text-gray-500">{{ __('general.forgot_password_subtitle') }}</p>
            </div>

            @if(session('status'))
                <div class="mt-4 rounded-lg bg-green-50 p-3 text-center text-sm text-green-600">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="mt-8 space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">{{ __('general.email') }}</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                        class="mt-1 block w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm shadow-sm focus:border-gold focus:ring-gold">
                    @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="w-full rounded-lg bg-navy py-3 text-sm font-semibold text-white transition hover:bg-navy-light">
                    {{ __('general.send_reset_link') }}
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-500">
                <a href="{{ route('login') }}" class="font-medium text-gold hover:text-gold-dark">← {{ __('general.back_to_login') }}</a>
            </p>
        </div>
    </div>
</section>
@endsection
