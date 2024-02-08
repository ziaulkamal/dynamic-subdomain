<?php

use App\Http\Controllers\BlogspotApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['domain' => '{subdomain}.mindkreativ.com'], function () {
    Route::post('/blogspot-endpoint', [BlogspotApiController::class, 'handleRequest']);
    Route::post('/blogspot-endpoint/xhr', [BlogspotApiController::class, 'xhrFetch']);

});
