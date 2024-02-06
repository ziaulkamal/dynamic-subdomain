<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubdomainController extends Controller
{
    public function showSubdomain()
    {
        $subdomain = config('app.subdomain');

        return view('subdomain.show', compact('subdomain'));
    }
}
