<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard('api')->check()) {
                return response()->json(['message' => 'Already logged in', 'redirect_url' => route('home')]);
            }
//            if (Auth::guard('web')->check()) {
//                return redirect(RouteServiceProvider::HOME);
//            }
//            if (Auth::guard('api')->check()) {
//                return response()->json(['message' => 'Already logged in', 'redirect_url' => route('home')]);
//            }
//            if (Auth::guard($guard)->check()) {
//                return redirect(RouteServiceProvider::HOME);
//            }
        }

        return $next($request);
    }
}
