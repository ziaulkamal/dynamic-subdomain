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

        // Jika tidak ada subdomain, tampilkan posisi sekarang
        $currentSubdomain = $this->getSubdomain();
        return view('show', compact('currentSubdomain'));
    }

    protected function getSubdomain()
    {
        // Mendapatkan subdomain dari request
        $subdomain = explode('.', $request->getHost())[0];

        // Jika subdomain kosong, set sebagai 'default'
        return $subdomain ?: 'default';
    }
}
