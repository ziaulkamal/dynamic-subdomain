<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubdomainController extends Controller
{
    public function showSubdomain(Request $request, $subdomain = null)
    {
        // Jika ada subdomain, tampilkan view subdomain
        if ($subdomain) {
            return view('show', compact('subdomain'));
        }

        // Jika tidak ada subdomain, tampilkan posisi sekarang
        $currentSubdomain = $request->subdomain;
        return view('show', compact('currentSubdomain'));
    }

    public function processQuery(Request $request)
    {
        // Ambil nilai query dari form
        $query = $request->input('query');

        // Ganti spasi dengan tanda hubung
        $subdomain = Str::slug($query);

        // Jika tidak ada subdomain dari root domain, atur sebagai default
        $currentSubdomain = $request->subdomain ?: 'default';
        // dd($currentSubdomain);
        // Redirect ke subdomain dengan query
        return redirect()->route('subdomain.show', ['subdomain' => $subdomain ?: $currentSubdomain]);
    }

    function defaultRoot() {
        return "Maintenance";
    }


}
