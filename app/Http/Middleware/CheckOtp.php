<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckOtp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // Check if the user needs to verify OTP after login
        if ($user && !$user->email_verified_at) {
            // Redirect to the OTP verification page if OTP hasn't been verified
            return redirect()->route('frontend.index');
        }

        return $next($request);
    }
}
