<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\HomeController::class, 'getHome']);

Route::get('/login', function () {
    return 'Login usuario';
});

Route::get('/logout', function () {
    return 'logout usuario';
});

Route::get('/catalog', [App\Http\Controllers\CatalogController::class, 'getIndex']);

Route::get('/catalog/show/{id}',[App\Http\Controllers\CatalogController::class, 'getShow']);

Route::get('/catalog/create', [App\Http\Controllers\CatalogController::class, 'getCreate']);

Route::get('/catalog/edit/{id}', [App\Http\Controllers\CatalogController::class, 'getEdit']);

