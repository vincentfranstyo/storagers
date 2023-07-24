<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class PurchaseController extends Controller
{
    public function purchase($name)
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

        return view('components/purchase', ['catalog' => $catalog]);
    }
}
