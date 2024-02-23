<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
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

Route::middleware('auth:sanctum')->group(function () {
    //category
    Route::get('/category', [ProductController::class, 'category']);
    
    // products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/product/{id}', [ProductController::class, 'show']);
    Route::get('/random-products', [ProductController::class, 'randomProduct']);
    Route::get('/products/category/{cat_id}', [ProductController::class, 'productCategoryWise']);
    Route::get('/home-products-with-category', [ProductController::class, 'HomeProductsWithCategory']);
    
    //order
    Route::post('/place-order', [OrderController::class, 'placeOrder']);
    Route::get('/get-order/{status}', [OrderController::class, 'getOrder']);
    // return $request->user();
    Route::post('/update-profile', [AuthController::class, 'updateProfile']);
});

// auth
Route::post('/login', [AuthController::class, 'loginProcess']);
Route::post('/registration', [AuthController::class, 'registerProcess']);

