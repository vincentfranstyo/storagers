<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('home');
    }

    public function handle($request, $next, ...$guards)
    {
        if ($request->cookie('jwt')) {
            $request->headers->set('Authorization', 'Bearer ' . $request->cookie('jwt'));
        }

        $this->authenticate($request, $guards);

        return $next($request);
    }
}
