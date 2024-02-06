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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['web', 'subdomain'])->group(function () {
    // Rute-rute Anda di sini
    Route::get('/', [SubdomainController::class, 'showSubdomain']);
});

