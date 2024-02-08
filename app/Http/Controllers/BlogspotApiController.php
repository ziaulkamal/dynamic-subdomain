<?php

namespace App\Http\Controllers;

use App\Models\Query;
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
        dd($data);
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

    function xhrFetch(Request $request) {
        // Menetapkan izin CORS
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
        header("Access-Control-Allow-Headers: DNT,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control,Content-Type,Range");

        // Menetapkan header tambahan jika diperlukan
        header("Custom-Header: Nilai Header");
        // Mengambil data dari request
        $data = $request->all();

        // Mengganti karakter '-' dengan spasi
        $query = str_replace('-', ' ', $data['query']);

        // Mendapatkan URL referer
        $refererUrl = $request->server('HTTP_REFERER');

        // Memeriksa apakah query sudah ada di tabel
        $existingQuery = Query::where('query', $query)->first();

        // Jika query belum ada, maka simpan ke dalam database
        if (!$existingQuery) {
            // Menyimpan data ke database
            DB::table('queries')->insert([
                'query' => $query,
                'ref'   => $refererUrl
            ]);
        }

        // Mengambil semua data dari tabel queries
        $waiting = Query::all();

        // Mengembalikan semua data sebagai respons JSON
        return response()->json(['data' => $waiting]);
    }
}
