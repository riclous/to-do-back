<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// use App\http\Controllers\ImageController;
// use APP_URL:8000\Api\get_products;

Route::get('/', function () {
    return view('layouts.app');
});

// route::get('/', [ImageController::class, 'index']);
route::get('/images', [ImageController::class, 'index']);
// route::get('/images/create', [ImageController::class, 'create']);
// route::post('/images/create', [ImageController::class, 'store']);
// route::post('/', [ImageController::class, 'store']);


Auth::routes();

// Route::resource('images', App\Http\Controllers\ImageController::class);
Route::resource('users', App\Http\Controllers\UserController::class);
Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::resource('products', App\Http\Controllers\ProductController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
