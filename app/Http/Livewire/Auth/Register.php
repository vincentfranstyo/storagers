<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;


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
//    public function __construct()
//    {
//        $this->middleware('auth:api', ['except' => ['login', 'register']]);
//    }

    public function register(): JsonResponse
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'email' => request('email'),
            'username' => request('username'),
            'name' => request('name'),
            'password' => Hash::make(request('password')),
        ]);



        if ($user){
            Auth::login($user, true);
            return response()->json([
                'message' => 'User successfully registered',
                'user' => $user
            ], 201);
        } else {
            return response()->json([
                'message' => 'User registration failed',
            ], 400);
        }
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
