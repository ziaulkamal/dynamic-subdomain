<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogspotApiController extends Controller
{
    public function handleRequest(Request $request)
    {
        // Proses permintaan dari Blogspot
        $data = $request->all();

        // Simpan query ke penyimpanan sementara (contoh: menggunakan tabel 'queries')
        DB::table('queries')->insert(['query' => $data['query']]);

        // Lakukan logika bisnis atau manipulasi data jika diperlukan

        // Berikan respons
        return response()->json(['message' => 'Permintaan berhasil diterima']);
    }
}
