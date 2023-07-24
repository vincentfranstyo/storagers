<?php

namespace App\Http\Livewire\Auth;

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

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

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
    public function authenticate()
    {
//        $this->validate();
//
//        $credentials = [
//            'email' => $this->email,
//            'password' => $this->password,
//        ];
//
//        try {
//            if (!$token = auth()->attempt($credentials)) {
//                return response()->json(['error' => 'invalid_credentials'], 401);
//            }
//        } catch (JWTException $e) {
//            return response()->json(['error' => 'could_not_create_token'], 500);
//        }
//
//        // redirect to home page
//        return [$this->respondWithToken($token), redirect('/')];
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
}
