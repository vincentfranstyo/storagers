<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $response = Http::get('http://localhost:4000/api/barang');
        return view('home', ['catalogs' => $response->json()['data']]);
    }
}
