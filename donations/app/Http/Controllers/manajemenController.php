<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManajemenController extends Controller
{
    public function getManajemen()
    {
        $manajemen = Manajemen::all();
        if ($manajemen->isEmpty()) {
            $response['message'] = 'Tidak ada manajemen yang ditemukan.';
            $response['success'] = false;
            return response()->json($response, 404);
        }

        $response['success'] = true;
        $response['message'] = 'manajemen ditemukan.';
        $response['data'] = $manajemen;
        return response()->json($response, 200);
        // atau
        // return response()->json($response, 200);
    }

    public function storeManajemen(Request $request){
        // validasi input
        $input = $request->validate([
            "nama_donatur"=> "required|unique:fakultas",
            "metode_pembayaran"     => "required",
            "status_donasi" => "required"
        ]);
        // simpan
        $hasil = Manajemen::create($input);
        if($hasil){ // jika data berhasil disimpan
            $response['success'] = true;
            $response['message'] = $request->nama." berhasil disimpan";
            return response()->json($response, 201); // 201 Created
        } else {
            $response['success'] = false;
            $response['message'] = $request->nama." gagal disimpan";
            return response()->json($response, 400); // 400 Bad Request
        }
    }
}
