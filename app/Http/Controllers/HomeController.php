<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Livewire\WithPagination;
use Tymon\JWTAuth\Facades\JWTAuth;

class HomeController extends Controller
{
    use WithPagination;
    public function index(Request $request)
    {
        $token = $request->cookie('jwt');

        try {
            $user = JWTAuth::authenticate($token);

            if (!$user) throw new Exception('User not found');
        } catch (Exception $e) {
            return redirect()->route('login_page')->with('error', 'Invalid session. Please login again');
        }
//        dd("token:", $token);
        $response = Http::get('http://localhost:4000/api/barang');
        $collection = collect($response->json()['data']);

        $perPage = 12; // Number of items per page
        $currentPage = request()->get('page', 1); // Get the current page from the request query parameters

        $paginatedCollection = new LengthAwarePaginator(
            $collection->forPage($currentPage, $perPage),
            $collection->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url()]
        );

        return view('home', ['catalogs' => $paginatedCollection]);
    }
}
