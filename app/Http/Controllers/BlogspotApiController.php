<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as FacadesRequest;

class BlogspotApiController extends Controller
{
    public function handleRequest(Request $request)
    {

        // code blogspot javascript

        // function submitForm() {
        //     // Ambil nilai dari input pencarian
        //     const query = document.getElementById('queryInput').value;
        //     const queryMin = query.replace(/ /g, '-')
        //     // Setel nilai atribut 'action' formulir dengan URL berdasarkan query
        //     const url = 'https://' + queryMin + '.mindkreativ.com/api/blogspot-endpoint/';
        //     const form = document.getElementById('dynamicForm');
        //     form.action = url;

        //     // Kirim formulir
        //     form.submit();
        // }
        // Proses permintaan dari Blogspot
        $data = $request->all();

        // Simpan query ke penyimpanan sementara (contoh: menggunakan tabel 'queries')
        $refererUrl = FacadesRequest::server('HTTP_REFERER');
        DB::table('queries')->insert([
            'query' => $data['query'],
            'ref'   => $refererUrl
        ]);
        // dd($refererUrl);
        // Lakukan logika bisnis atau manipulasi data jika diperlukan

        // Berikan respons
        // return response()->json(['message' => 'Permintaan berhasil diterima']);
        return redirect('https://pastebin.com/raw/jdafipVi');
    }
}
