<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VerifySessionFingerprint
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $fingerprint = hash('sha256', $request->userAgent() ?? '');

            if (! $request->session()->has('fingerprint')) {
                $request->session()->put('fingerprint', $fingerprint);
            } elseif (! hash_equals($request->session()->get('fingerprint'), $fingerprint)) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('login');
            }
        }

        return $next($request);
    }
}