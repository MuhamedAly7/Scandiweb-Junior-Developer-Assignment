<?php

use App\Controllers\AddProductController;
use App\Controllers\ProductListController;
use Mali\Http\Route;

Route::get('/', [ProductListController::class, 'index']);
Route::get('/addproduct', [AddProductController::class, 'index']);
Route::post('/addproduct', [AddProductController::class, 'store']);
Route::post('/', [ProductListController::class, 'DeleteProducts']);