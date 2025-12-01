<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ThrottleCheckout
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $key = 'checkout_' . auth()->id();
        $maxAttempts = 10; // Max 10 checkout attempts
        $decayMinutes = 60; // Per 60 minutes

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return back()->withErrors([
                'error' => "Terlalu banyak checkout attempt. Coba lagi dalam {$seconds} detik."
            ]);
        }

        RateLimiter::hit($key, $decayMinutes * 60);

        return $next($request);
    }
}
