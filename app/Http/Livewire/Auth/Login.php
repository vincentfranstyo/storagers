<?php

namespace App\Http\Livewire\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
//use http\Env\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Livewire\Component;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class Login extends Component
{
    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var string */
    public $username = '';

    /** @var bool */
    public $remember = false;


    public function authenticate(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        try {
            if (!$token = Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        $cookie = cookie('jwt', $token, 60 * 72, null, null, false, false);
//        dd($cookie);
        return response()->json([
            'user' => Auth::user(),
            'token' => $token
        ], 201)->withCookie($cookie);
//        return redirect()->route('home')->withCookie($cookie);
//        return response()->json([
//            'user' => Auth::user(),
//            'token' => $token
//        ], 201)->withCookie($cookie);
    }

    public function mount()
    {
        $this->user_id = auth()->id();
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken(string $token): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
