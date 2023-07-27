<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth:api');
//    }

//    public function login(): JsonResponse|RedirectResponse
//    {
//        $credentials = request(['email', 'password']);
//
//        try {
//            if (! $token = Auth::attempt($credentials)) {
//                return response()->json(['error' => 'Unauthorized'], 401);
//            }
//        } catch (JWTException $e) {
//            return response()->json(['error' => 'Could not create token'], 500);
//        }
//
//        $user = Auth::user();
//        $token = $user->createToken('token')->plainTextToken;
//        $cookie = cookie('jwt', $token, 60 * 72); // 1 day
//
//        return redirect()->route('home')->withCookie($cookie);
//    }

//    public function register(): JsonResponse
//    {
//        $validator = Validator::make(request()->all(), [
//            'name' => 'required|string|max:255',
//            'username' => 'required|string|max:255|unique:users',
//            'email' => 'required|string|email|max:255|unique:users',
//            'password' => 'required|string|min:8',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json($validator->errors(), 422);
//        }
//
//        $user = User::create([
//            'email' => request('email'),
//            'username' => request('username'),
//            'name' => request('name'),
//            'password' => bcrypt(request('password')),
//        ]);
//
//        $token = Auth::fromUser($user);
//
//        return response()->json([
//            'user' => $user,
//            'token' => $token
//        ], 201);
//    }

//    public function logout(): RedirectResponse
//    {
//        // forget the token from login
//        auth()->logout();
//
//        // delete the cookie
//        $cookie = Cookie::forget('jwt');
//
//        return redirect('/');
//    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }
}
