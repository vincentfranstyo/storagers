<?php

namespace App\Http\Controllers;

use App\Models\History;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;

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

    /**
     * @throws Exception
     */
    public function purchase(Request $request, $name)
    {
        $response = Http::get('http://localhost:4000/api/barang');
        $cookieHeader = $request->headers->get('cookie');
        $jwtToken = substr($cookieHeader, strpos($cookieHeader, '=') + 1);
//        dd($jwtToken);
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
        $this->reduceAmount($request, $catalog, $amount);

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

    public function reduceAmount($request, $catalog, $amount)
    {
        $token = $request->cookie('jwt');
        $user = JWTAuth::authenticate($token);
        if (!$user) throw new Exception('User not found');
        $response = Http::put('http://localhost:4000/api/barang/' . Auth::user()['username'] . '/' . $catalog['id'], [
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
