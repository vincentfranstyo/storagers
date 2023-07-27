<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;

class LogoutController extends Controller
{
//    public function __invoke(): RedirectResponse
//    {
//        Auth::logout();
//
//        return redirect(route('home'));
//    }
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(): RedirectResponse
    {
        // forget the token from login
        auth()->logout();

        // delete the cookie
        Cookie::forget('jwt');

        return redirect('/');
    }
}
