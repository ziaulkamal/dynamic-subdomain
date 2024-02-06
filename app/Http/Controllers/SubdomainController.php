<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubdomainController extends Controller
{
    public function showSubdomain()
    {
        // Mengambil subdomain dari request
        $subdomain = $this->getSubdomain();

        // Menampilkan view dengan informasi subdomain
        return view('show', compact('subdomain'));
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

    protected function getSubdomain()
    {
        // Mengambil subdomain dari request
        $subdomain = explode('.', request()->getHost())[0];

        // Jika subdomain kosong, set sebagai 'default'
        return $subdomain ?: 'default';
    }
}
