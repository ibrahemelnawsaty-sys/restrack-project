<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Subscription::with(['user', 'coupon']);

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $subscriptions = $query->latest()->paginate(20);

        return view('admin.subscriptions.index', compact('subscriptions'));
    }

    public function show(Subscription $subscription)
    {
        $subscription->load(['user', 'coupon']);
        return view('admin.subscriptions.show', compact('subscription'));
    }

    public function activate(Subscription $subscription)
    {
        $subscription->update([
            'status' => 'active',
            'activated_at' => now(),
        ]);

        return back()->with('success', __('messages.subscription_activated'));
    }

    public function refund(Subscription $subscription)
    {
        $subscription->update([
            'status' => 'refunded',
            'refunded_at' => now(),
        ]);

        return back()->with('success', __('messages.subscription_refunded'));
    }
}
