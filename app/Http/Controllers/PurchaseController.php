<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

class PurchaseController extends Controller
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

        return view('components/purchase', ['catalog' => $catalog]);
    }

    public function purchase(Request $request, $name)
    {
        $response = Http::get('http://localhost:4000/api/barang');
        $catalogs = $response->json()['data'];
        $catalog = null;
        $amount = $request->input('amount');

        foreach ($catalogs as $c) {
            if ($c['nama'] == $name) {
                $catalog = $c;
                break;
            }
        }
        if (!$this->checkStock($amount, $catalog['stok'])) {
            return [redirect()->route('purchase.show', ['name' => $name]), with('alert', 'Stok tidak cukup')];
        }
        $this->createHistory($catalog, $amount);
        $this->reduceAmount($catalog, $amount);

        return redirect()->route('home');
    }

    public function checkStock($amount, $stock): bool
    {
        if ($amount > $stock) {
            return false;
        }
        return true;
    }

    public function createHistory($catalog, $amount)
    {
        History::create(
            [
                'user_id' => Auth::user()['id'],
                'barang_id' => $catalog['id'],
                'nama_barang' => $catalog['nama'],
                'jumlah' => $amount,
                'total_harga' => $catalog['harga'] * $amount,
            ]
        );
    }

    public function reduceAmount($catalog, $amount)
    {
        $response = Http::put('http://localhost:4000/api/barang/' . $catalog['id'], [
            'id' => $catalog['id'],
            'nama' => $catalog['nama'],
            'kode' => $catalog['kode'],
            'harga' => $catalog['harga'],
            'stok' => $catalog['stok'] - $amount,
            'perusahaan_id' => $catalog['perusahaan_id'],
        ]);

        return $response->json();
    }
}
