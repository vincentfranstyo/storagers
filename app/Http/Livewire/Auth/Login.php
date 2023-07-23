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
        $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                $this->addError('email', trans('auth.failed'));
                return;
            }
        } catch (JWTException $e) {
            $this->addError('email', trans('auth.failed'));
            return;
        }

        return response()->json(['token' => $token], 200, (array)redirect()->intended(route('home')));
        //         Store the token in the session or local storage as needed
//         Redirect to the desired page or emit an event to handle the successful login
    }

    public function render()
    {
        return view('livewire.auth.login')->extends('layouts.auth');
    }
}
