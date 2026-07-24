@extends('layouts.app')

@section('title', __('general.checkout') . ' — Restrack')

@section('content')
<section class="bg-navy py-12 text-white">
    <div class="mx-auto max-w-7xl px-4 text-center">
        <h1 class="text-3xl font-bold">{{ __('general.checkout') }}</h1>
    </div>
</section>

<section class="py-16">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-5">
            {{-- Order Summary --}}
            <div class="lg:col-span-3">
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h2 class="text-xl font-semibold text-navy">{{ __('general.order_summary') }}</h2>
                    <div class="mt-4 space-y-3">
                        <div class="flex items-center justify-between border-b pb-3 text-sm">
                            <span class="text-gray-600">{{ __('general.program_name') }}</span>
                            <span class="font-medium text-navy">Restrack Medical Training</span>
                        </div>
                        <div class="flex items-center justify-between border-b pb-3 text-sm">
                            <span class="text-gray-600">{{ __('general.price') }}</span>
                            <span class="font-medium text-navy">{{ $price }} {{ __('general.sar') }}</span>
                        </div>
                        @if(isset($discount) && $discount > 0)
                        <div class="flex items-center justify-between border-b pb-3 text-sm text-green-600">
                            <span>{{ __('general.discount') }}</span>
                            <span>-{{ $discount }} {{ __('general.sar') }}</span>
                        </div>
                        @endif
                        <div class="flex items-center justify-between pt-2 text-lg font-bold">
                            <span class="text-navy">{{ __('general.total') }}</span>
                            <span class="text-gold">{{ $total ?? 899 }} {{ __('general.sar') }}</span>
                        </div>
                    </div>

                    {{-- Coupon --}}
                    <form method="POST" action="{{ route('checkout.coupon') }}" class="mt-6 flex gap-2" x-data>
                        @csrf
                        <input type="text" name="coupon_code" placeholder="{{ __('general.coupon_code') }}" value="{{ old('coupon_code', session('coupon_code')) }}"
                            class="flex-1 rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-gold focus:ring-gold">
                        <button type="submit" class="rounded-lg bg-navy px-4 py-2 text-sm font-medium text-white hover:bg-navy-light">
                            {{ __('general.apply') }}
                        </button>
                    </form>
                    @if(session('coupon_error'))
                        <p class="mt-2 text-xs text-red-500">{{ session('coupon_error') }}</p>
                    @endif
                    @if(session('coupon_success'))
                        <p class="mt-2 text-xs text-green-600">{{ session('coupon_success') }}</p>
                    @endif
                </div>
            </div>

            {{-- Payment --}}
            <div class="lg:col-span-2">
                <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
                    <h2 class="text-lg font-semibold text-navy">{{ __('general.payment_methods') }}</h2>
                    <p class="mt-2 text-sm text-gray-500">{{ __('general.payment_methods_desc') }}</p>

                    <div class="mt-6 space-y-3">
                        <div class="flex items-center gap-3 rounded-lg border border-gray-200 p-3 text-sm">
                            <span class="font-medium text-navy">Mada</span>
                        </div>
                        <div class="flex items-center gap-3 rounded-lg border border-gray-200 p-3 text-sm">
                            <span class="font-medium text-navy">Visa / MasterCard</span>
                        </div>
                        <div class="flex items-center gap-3 rounded-lg border border-gray-200 p-3 text-sm">
                            <span class="font-medium text-navy">Apple Pay</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('checkout.process') }}">
                        @csrf
                        <button type="submit" class="mt-6 w-full rounded-xl bg-gold py-3 text-sm font-semibold text-navy transition hover:bg-gold-light">
                            @if(isset($total) && $total <= 0)
                                {{ __('general.activate_subscription') }}
                            @else
                                {{ __('general.proceed_payment') }}
                            @endif
                        </button>
                    </form>
                    <p class="mt-3 text-center text-xs text-gray-400">{{ __('general.payment_secure') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
