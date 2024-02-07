<?php

use App\Http\Controllers\SubdomainController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::group(['domain' => '{subdomain}.yourdomain.com'], function () {
    Route::get('/', 'SubdomainController@index');
    // tambahkan rute-rute khusus subdomain di sini
});
