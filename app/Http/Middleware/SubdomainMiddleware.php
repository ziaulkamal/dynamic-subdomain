<?php

namespace App\Http\Middleware;

use Closure;

class SubdomainMiddleware
{
    public function handle($request, Closure $next)
    {
        $subdomain = explode('.', $request->getHost())[0];
        $request->attributes->add(['subdomain' => $subdomain]);

        return $next($request);
    }
}
