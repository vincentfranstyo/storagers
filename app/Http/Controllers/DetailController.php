<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DetailController extends Controller
{
    public function show($name)
    {
        $response = Http::get('http://localhost:4000/api/barang');
        $catalogs = $response->json()['data'];
        $catalog = null;

        foreach ($catalogs as $c) {
            if ($c['nama'] == $name) {
                $catalog = $c;
                break;
            }
        }

        return view('components/detail', ['catalog' => $catalog]);
    }
}
