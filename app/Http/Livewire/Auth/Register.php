<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Tymon\JWTAuth\Facades\JWTAuth;


class Register extends Component
{
    /** @var string */
    public $name = '';

    /** @var string */
    public $username = '';

    /** @var string */
    public $email = '';

    /** @var string */
    public $password = '';

    /** @var string */
    public $passwordConfirmation = '';

//    public function register()
//    {
//        $this->validate([
//            'name' => ['required'],
//            'username' => ['required', 'string', 'max:255', 'unique:users'],
//            'email' => ['required', 'email', 'unique:users'],
//            'password' => ['required', 'min:8', 'same:passwordConfirmation'],
//        ]);
//
//        $user = User::create([
//            'email' => $this->email,
//            'username' => $this->username,
//            'name' => $this->name,
//            'password' => Hash::make($this->password),
//        ]);
//
//        event(new Registered($user));
//
//        Auth::login($user, true);
//
//        return redirect()->intended(route('home'));
//    }
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(): \Illuminate\Http\JsonResponse
    {
        // with JWT Token
        $this->validate([
            'name' => ['required'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8', 'same:passwordConfirmation'],
        ]);

        $user = User::create([
            'email' => $this->email,
            'username' => $this->username,
            'name' => $this->name,
            'password' => Hash::make($this->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201, (array)Auth::login($user, true));
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
