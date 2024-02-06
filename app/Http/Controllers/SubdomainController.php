<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubdomainController extends Controller
{
    public function showSubdomain()
    {
        return view('show');
    }

    public function processQuery(Request $request)
    {
        // Ambil nilai query dari form
        $query = $request->input('query');

        // Ganti spasi dengan tanda hubung
        $subdomain = str_replace(' ', '-', $query);

        // Redirect ke subdomain dengan query
        return redirect($subdomain.url());
    }
}
