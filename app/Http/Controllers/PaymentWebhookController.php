<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Services\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentWebhookController extends Controller
{
    public function moyasar(Request $request, PaymentService $paymentService)
    {
        $payload = $request->all();

        Log::info('Moyasar webhook received', ['payload' => $payload]);

        $paymentId = $payload['id'] ?? null;
        $status = $payload['status'] ?? null;

        if (!$paymentId) {
            return response()->json(['message' => 'Invalid payload'], 400);
        }

        $subscription = Subscription::where('payment_id', $paymentId)->first();

        if (!$subscription) {
            return response()->json(['message' => 'Subscription not found'], 404);
        }

        $paymentService->handleWebhook($subscription, $status, $payload);

        return response()->json(['message' => 'OK']);
    }
}
