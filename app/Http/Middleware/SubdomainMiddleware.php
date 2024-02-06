<?php

namespace App\Http\Middleware;

use Closure;

class SubdomainMiddleware
{
    public function handle($request, Closure $next)
    {
        // Jika terdapat query 'query' pada request, redirect ke subdomain tersebut
        if ($request->has('query')) {
            $query = $request->input('query');
            $subdomain = str_replace(' ', '-', $query);

            return redirect()->route('subdomain.show', ['subdomain' => $subdomain]);
        }

        // Jika tidak ada query, tetap lanjutkan ke controller
        return $next($request);
    }
}
