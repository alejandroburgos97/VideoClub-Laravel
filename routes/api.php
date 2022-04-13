<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APICatalogController;


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

Route::put('/v1/catalog/{id}/return', [APICatalogController::class, 'putReturn']);

Route::put('/v1/catalog/{id}/rent', [APICatalogController::class, 'putRent']);

Route::resource('/v1/catalog', APICatalogController::class, ['except' => ['create', 'edit']]);

