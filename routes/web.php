<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', [App\Http\Controllers\HomeController::class, 'getHome']);

/* Route::get('/login', function () {
    return 'Login usuario';
});

Route::get('/logout', function () {
    return 'logout usuario';
}); */

Route::get('/catalog', [App\Http\Controllers\CatalogController::class, 'getIndex'])->middleware('auth');

Route::get('/catalog/show/{id}',[App\Http\Controllers\CatalogController::class, 'getShow'])->middleware('auth');

Route::get('/catalog/create', [App\Http\Controllers\CatalogController::class, 'getCreate'])->middleware('auth');

Route::post('/catalog/create', [App\Http\Controllers\CatalogController::class, 'postCreate'])->middleware('auth');

Route::get('/catalog/edit/{id}', [App\Http\Controllers\CatalogController::class, 'getEdit'])->middleware('auth');

Route::put('/catalog/edit/{id}', [App\Http\Controllers\CatalogController::class, 'putEdit'])->middleware('auth');


Auth::routes();

/* Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); */
