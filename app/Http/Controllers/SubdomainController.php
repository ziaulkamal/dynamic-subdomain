<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubdomainController extends Controller
{
    public function showSubdomain(Request $request, $subdomain = null)
    {
        // Jika ada subdomain, tampilkan view subdomain
        if ($subdomain) {
            return view('show', compact('subdomain'));
        }

        // Jika tidak ada subdomain, coba ambil dari parameter query
        $subdomainFromQuery = $request->query('subdomain');
        if ($subdomainFromQuery) {
            return view('show', compact('subdomainFromQuery'));
        }

        // Jika tidak ada subdomain dari query, tampilkan posisi sekarang
        $currentSubdomain = $this->getSubdomain($request);
        return view('show', compact('currentSubdomain'));
    }

    public function processQuery(Request $request)
    {
        // Ambil nilai query dari form
        $query = $request->input('query');

        // Ganti spasi dengan tanda hubung
        $subdomain = str_replace(' ', '-', $query);

        // Redirect ke subdomain dengan query
        return redirect()->route('subdomain.show', ['subdomain' => $subdomain]);
    }

    protected function getSubdomain(Request $request)
    {
        // Mendapatkan subdomain dari request
        $subdomain = explode('.', $request->getHost())[0];

        // Jika subdomain kosong, set sebagai 'default'
        return $subdomain ?: 'default';
    }
}
