<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class VerifyJWTToken
{
    public function handle($request, Closure $next)
    {
        $token = $request->cookie('jwt');
//        if (isset($_COOKIE['jwt'])) {
//            $token = $_COOKIE['jwt'];
//            // Now you can use the $token variable
//        } else {
//            return response()->json(['error' => 'token_not_found'], 401);
//        }
//        dd($token);
        try {
            $user = JWTAuth::setToken($token)->authenticate();
        } catch (TokenExpiredException $e) {
            return response()->json(['error' => 'token_expired'], 401);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'token_invalid'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'token_absent'], 401);
        }

        if (!$user) {
            return response()->json(['error' => 'user_not_found'], 404);
        }

        return $next($request);
    }
}
