<?php

namespace App\Services;

use App\Models\Subscription;
use App\Models\ActivityLog;

class PaymentService
{
    public function createPayment(array $data): array
    {
        // Moyasar API integration placeholder
        // In production, this would call the Moyasar API
        return [
            'payment_url' => '#',
            'payment_id' => null,
        ];
    }

    public function handleWebhook(Subscription $subscription, string $status, array $payload): void
    {
        $subscription->update(['gateway_response' => $payload]);

        match ($status) {
            'paid' => $this->activateSubscription($subscription),
            'failed' => $subscription->update(['status' => 'cancelled']),
            'refunded' => $subscription->update(['status' => 'refunded', 'refunded_at' => now()]),
            default => null,
        };
    }

    private function activateSubscription(Subscription $subscription): void
    {
        $subscription->update([
            'status' => 'active',
            'activated_at' => now(),
        ]);

        if ($subscription->coupon_id) {
            $subscription->coupon?->increment('used_count');
        }

        ActivityLog::log('subscription_activated', "Subscription #{$subscription->id} activated", $subscription);
    }
}
