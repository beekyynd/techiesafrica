<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use \App\Http\Controllers\NumberController;

Route::middleware("guest")->group(function () {

    Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

    Route::get('/countries', [NumberController::class, 'listCountries'])
    ->name('countries');

    Route::get('/countries/get', [NumberController::class, 'getCountryData'])
    ->name('countries.data');

});

Route::middleware(['auth:sanctum'])->group(function () {
    
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/countries/generate', [NumberController::class, 'generateNumber']);

});