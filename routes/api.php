<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportingController;

Route::middleware("guest")->group(function () {

    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('products', ProductController::class);
    Route::post('products/import-excel', [ProductController::class,'importExcel']);
    Route::post('products/{product}/upload-image', [ProductController::class,'uploadImage']); // optional

    Route::post('orders', [OrderController::class,'store']);
    Route::get('orders', [OrderController::class,'index']);
    Route::get('orders/{order}', [OrderController::class,'show']);

    Route::get('reports/low-stock', [ReportingController::class,'lowStock']);
    Route::get('reports/sales-summary', [ReportingController::class,'salesSummary']);

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
});