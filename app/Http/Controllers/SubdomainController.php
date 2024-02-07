<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubdomainController extends Controller
{
    public function index(Request $request)
    {
        $subdomain = $request->subdomain;
        // Logika untuk subdomain di sini
        return view('subdomain.show', compact('subdomain'));
    }

}
