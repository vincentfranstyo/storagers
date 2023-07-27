<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
//            return redirect()->route('register')->withErrors($validator)->withInput();
        }

        $user = User::create([
            'email' => request('email'),
            'username' => request('username'),
            'name' => request('name'),
            'password' => Hash::make(request('password')),
        ]);

        $token = Auth::attempt(request(['email', 'password']));
////
//        $cookie = cookie('jwt', $token, 60 * 72, null, null, false, false);

        if ($user){
            return response()->json([
                'user' => $user,
                'token' => $token
            ], 201);
        } else {
            return response()->json([
                'message' => 'Registration failed'
            ], 400);
        }

//        (new Login)->authenticate(request());

//        return redirect()->route('home')->with($cookie);

//        return response()->json([
//            'user' => $user,
//            'token' => $token
//        ], 201);
    }

    public function render()
    {
        return view('livewire.auth.register')->extends('layouts.auth');
    }
}
