<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogspotApiController extends Controller
{
    public function handleRequest(Request $request)
    {
        // Proses permintaan dari Blogspot
        $data = $request->all();

        // Lakukan logika bisnis atau manipulasi data jika diperlukan

        // Berikan respons
        return response()->json(['message' => $data]);
    }
}
