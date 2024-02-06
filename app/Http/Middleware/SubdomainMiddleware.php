<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SubdomainMiddleware
{
    public function handle($request, Closure $next)
    {
        $subdomain = $request->query('subdomain');

        if ($subdomain) {
            // Lakukan sesuatu dengan subdomain, misalnya simpan ke database
            // atau terapkan konfigurasi berdasarkan subdomain
            // Pastikan untuk memvalidasi subdomain dengan baik

            // Contoh: Set subdomain ke environment agar dapat diakses di aplikasi
            config(['app.subdomain' => $subdomain]);
        }

        return $next($request);
    }
}
