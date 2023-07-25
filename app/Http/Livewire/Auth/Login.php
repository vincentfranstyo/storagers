<?php

namespace App\Http\Livewire\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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

    public function authenticate()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
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
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
    //    public function authenticate()
//    {
//        $this->validate();
//
//        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
//            $this->addError('email', trans('auth.failed'));
//
//            return;
//        }
//
//        return redirect()->intended(route('home'));
//    }
}
