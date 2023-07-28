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
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
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

    /**
     * Get a JWT via given credentials.
     *
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return redirect()->route('login_page')->with('error', 'Invalid credentials');
        }

        $cookie = Cookie::make('jwt', $token, 72 * 60, null, null, false, true);
        setCookie('jwt', $token, time() + (86400 * 30), "/"); // 86400 = 1 day
//        dd($cookie);
        return redirect()->route('home')->withCookie($cookie);
//        Cookie::queue('jwt', $token, 60, null, null, false, true); // 60 minutes expiration
//        dd($cookie);

        // Set a HttpOnly cookie named 'jwt' with the token value
//        return response()->json(['token' => $token], 200)
//            ->withCookie(cookie('jwt', $token, 60, null, null, false, true));
//        $response = response('Redirecting...')->withCookie($cookie);
//        return $response->header('Location', route('home')); // 60 minutes expiration
    }

    /**
     * Get the authenticated User.
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return
     */
    public function logout()
    {
        // log the user out (Invalidate the token)
        auth()->logout();

        Cookie::forget('jwt');
        return redirect()->route('login_page');
    }
}
