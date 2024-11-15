<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ExpirePassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->last_password_reset_at && $user->last_password_reset_at->addDays(30)->isPast()) {
            abort(402,'Sorry! Your password has expire, kindly reset your password in order to login.');
        }

        return $next($request);
    }
}
