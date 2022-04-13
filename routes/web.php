<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;


Route::get('/', [HomeController::class, 'getHome']);

Route::get('/catalog', [CatalogController::class, 'getIndex'])->middleware('auth');

Route::get('/catalog/show/{id}',[CatalogController::class, 'getShow'])->middleware('auth');

Route::get('/catalog/create', [CatalogController::class, 'getCreate'])->middleware('auth');

Route::post('/catalog/create', [CatalogController::class, 'postCreate'])->middleware('auth');

Route::get('/catalog/edit/{id}', [CatalogController::class, 'getEdit'])->middleware('auth');

Route::put('/catalog/edit/{id}', [CatalogController::class, 'putEdit'])->middleware('auth');

Route::put('/catalog/rent/{id}', [CatalogController::class, 'putRent'])->middleware('auth');

Route::put('/catalog/return/{id}', [CatalogController::class, 'putReturn'])->middleware('auth');

Route::delete('/catalog/delete/{id}', [CatalogController::class, 'deleteMovie'])->middleware('auth');

Auth::routes();

