<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class BlogspotApiController extends Controller
{
    public function handleRequest(Request $request)
    {
        // Proses permintaan dari Blogspot
        $data = $request->all();

        // Simpan query ke penyimpanan sementara (contoh: menggunakan tabel 'queries')
        DB::table('queries')->insert(['query' => $data['query']]);
        $refererUrl = FacadesRequest::server('HTTP_REFERER');
        dd($refererUrl);
        // Lakukan logika bisnis atau manipulasi data jika diperlukan

        // Berikan respons
        return response()->json(['message' => 'Permintaan berhasil diterima']);
    }
}
