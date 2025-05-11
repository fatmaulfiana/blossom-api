<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductCategoriesController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\BookedController;
use App\Http\Controllers\AddressController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('users', UserController::class);
Route::apiResource('wishlist', WishlistController::class);
Route::apiResource('products', ProductsController::class);
Route::apiResource('categories', ProductCategoriesController::class);
Route::apiResource('cart', CartsController::class);
Route::apiResource('booked', BookedController::class);
Route::apiResource('address', AddressController::class);
