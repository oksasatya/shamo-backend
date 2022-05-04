<?php

use App\Http\Controllers\API\ProductCategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::get('/products', [ProductController::class, 'all']);
Route::get('/categories', [ProductCategoryController::class, 'all']);

// auth

Route::post('/register', [\App\Http\Controllers\API\UserController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\API\UserController::class, 'login']);


// group user
Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'editProfile']);
    Route::post('logout', [UserController::class, 'logout']);

    Route::get('transactions', [\App\Http\Controllers\API\TransactionController::class, 'all']);
});
