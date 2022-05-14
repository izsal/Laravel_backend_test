<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// AUTH
Route::group(['prefix' => 'v1'], function () {
    // register
    Route::post('/register', 'ApiController@register');
    // login
    Route::post('/login', 'ApiController@login');
});

Route::get('/provinces', [App\Http\Controllers\RajaOngkirController::class, 'getProvinces']);
Route::get('/cities/{id}', [App\Http\Controllers\RajaOngkirController::class, 'getCities']);
Route::get('/provincies/{id}', [App\Http\Controllers\RajaOngkirController::class, 'getProvincies']);
