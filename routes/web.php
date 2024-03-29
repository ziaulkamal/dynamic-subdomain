<?php

use App\Http\Controllers\BlogspotApiController;
use App\Http\Controllers\SearchController;
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



Route::group(['domain' => '{subdomain}.mindkreativ.com'], function () {
    Route::get('/', [SubdomainController::class, 'showSubdomain'])->name('subdomain.show');
    Route::get('/search', [SubdomainController::class,'search'])->name('subdomain.search');

    // Tambahkan rute-rute lainnya jika diperlukan
});

Route::post('/', [SubdomainController::class, 'processQueryApi'])->name('subdomain.processQuery');
Route::get('/', [SubdomainController::class, 'defaultRoot']);
Route::post('/', [SubdomainController::class, 'processQuery'])->name('process.query.post');

