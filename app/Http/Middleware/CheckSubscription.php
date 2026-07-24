<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isSubscribed()) {
            if ($request->expectsJson()) {
                return response()->json(['message' => __('messages.subscription_required')], 403);
            }
            return redirect()->route('checkout')->with('error', __('messages.subscription_required'));
        }

        return $next($request);
    }
}
