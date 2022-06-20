<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CitiesGroupController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProductsDiscountController;

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

Route::prefix('city')->group(function () {
    Route::get('/all', [CityController::class, 'all']);
    Route::post('/insert', [CityController::class, 'insert']);
    Route::post('/update/{id}', [CityController::class, 'update']);
    Route::get('/delete/{id}', [CityController::class, 'delete']);
});

Route::prefix('groups')->group(function () {
    Route::get('/all', [GroupController::class, 'all']);
    Route::post('/insert', [GroupController::class, 'insert']);
    Route::post('/update/{id}', [GroupController::class, 'update']);
    Route::get('/delete/{id}', [GroupController::class, 'delete']);
});

Route::prefix('cities-group')->group(function () {
    Route::get('/all', [CitiesGroupController::class, 'all']);
    Route::post('/insert', [CitiesGroupController::class, 'insert']);
    Route::get('/delete/{id}', [CitiesGroupController::class, 'delete']);
});

Route::prefix('product')->group(function () {
    Route::get('/all', [ProductController::class, 'all']);
    Route::post('/insert', [ProductController::class, 'insert']);
    Route::post('/update/{id}', [ProductController::class, 'update']);
    Route::get('/delete/{id}', [ProductController::class, 'delete']);
});

Route::prefix('products-discount')->group(function () {
    Route::get('/all', [ProductsDiscountController::class, 'all']);
    Route::post('/insert', [ProductsDiscountController::class, 'insert']);
    Route::post('/update/{id}', [ProductsDiscountController::class, 'update']);
    Route::get('/delete/{id}', [ProductsDiscountController::class, 'delete']);
});