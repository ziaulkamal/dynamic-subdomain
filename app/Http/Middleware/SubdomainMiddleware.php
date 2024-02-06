<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SubdomainMiddleware
{
    public function handle($request, Closure $next)
    {
    $subdomain = $request->query('subdomain', 'default');

    // Lakukan sesuatu dengan nilai $subdomain, misalnya set config atau sesuaikan perilaku

    return $next($request);
    }
}
