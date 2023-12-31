<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($this->request()->all(), [
            'name' => 'required|string|between:2,100',
            'username' => 'required|string|between:2,100|unique:users',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $this->request()->name,
            'username' => $this->request()->username,
            'email' => $this->request()->email,
            'password' => bcrypt($this->request()->password),
        ]);

        if (!$token = auth()->attempt($validator->validated())) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($user) {
            return redirect()->route('login_page')->with('success', 'User registration successful');
        } else {
            return redirect()->route('register_page')->with('error', 'User registration failed');
        }
    }

    public function request()
    {
        return request();
    }

    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return redirect()->route('login_page')->with('error', 'Invalid credentials');
        }

        $cookie = Cookie::make('jwt', $token, 72 * 60, null, null, false, true);
        setCookie('jwt', $token, time() + (86400 * 30), "/"); // 86400 = 1 day
        return redirect()->route('home')->withCookie($cookie);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        // log the user out (Invalidate the token)
        auth()->logout();

        Cookie::forget('jwt');
        return redirect()->route('login_page');
    }
}
