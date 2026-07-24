<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Level;
use App\Models\PageSection;
use App\Models\SiteSetting;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $levels = Level::published()->ordered()->get();
        $sections = PageSection::forPage('checkout')->get()->keyBy('section_key');

        $price = (float) SiteSetting::get('payment', 'price', '899');
        $discount = 0;
        $couponCode = session('coupon_code');

        if ($couponCode && session('coupon_id')) {
            $coupon = Coupon::find(session('coupon_id'));
            if ($coupon && $coupon->isValid()) {
                $discount = $coupon->calculateDiscount($price);
            } else {
                session()->forget(['coupon_id', 'coupon_code', 'discount_amount']);
                $couponCode = null;
            }
        }

        $total = $price - $discount;

        return view('pages.checkout', compact('levels', 'sections', 'price', 'discount', 'total'));
    }

    public function applyCoupon(Request $request)
    {
        $request->validate(['coupon_code' => ['required', 'string']]);

        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (!$coupon || !$coupon->isValid()) {
            return back()->with('coupon_error', __('messages.invalid_coupon'));
        }

        $originalPrice = (float) SiteSetting::get('payment', 'price', '899');
        $discount = $coupon->calculateDiscount($originalPrice);

        session([
            'coupon_id' => $coupon->id,
            'coupon_code' => $coupon->code,
            'discount_amount' => $discount,
        ]);

        return back()->with('coupon_success', __('messages.coupon_applied'));
    }

    public function process(Request $request)
    {
        $user = $request->user();

        // Prevent duplicate active subscriptions
        if ($user->subscriptions()->where('status', 'active')->exists()) {
            return redirect()->route('student.dashboard')->with('info', __('messages.already_subscribed'));
        }

        $price = (float) SiteSetting::get('payment', 'price', '899');
        $discount = 0;
        $couponId = session('coupon_id');
        $coupon = null;

        if ($couponId) {
            $coupon = Coupon::find($couponId);
            if ($coupon && $coupon->isValid()) {
                $discount = $coupon->calculateDiscount($price);
            }
        }

        $total = $price - $discount;

        // Free checkout (100% coupon discount)
        if ($total <= 0) {
            return DB::transaction(function () use ($user, $price, $discount, $coupon) {
                $subscription = Subscription::create([
                    'user_id' => $user->id,
                    'status' => 'active',
                    'payment_method' => 'coupon',
                    'payment_gateway' => 'manual',
                    'amount' => $price,
                    'currency' => 'SAR',
                    'coupon_id' => $coupon?->id,
                    'discount_amount' => $discount,
                    'activated_at' => now(),
                    'expires_at' => now()->addYear(),
                ]);

                if ($coupon) {
                    $coupon->increment('used_count');
                }

                session()->forget(['coupon_id', 'coupon_code', 'discount_amount']);

                return redirect()->route('student.dashboard')->with('success', __('messages.subscription_activated'));
            });
        }

        // TODO: Paid checkout — redirect to payment gateway (Moyasar)
        return back()->with('coupon_error', __('messages.payment_gateway_not_configured'));
    }
}
