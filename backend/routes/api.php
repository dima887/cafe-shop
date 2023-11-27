<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ParserNewsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('category')->group(function () {

    Route::get('/', [CategoryController::class, 'index']);

    Route::get('/{id}', [CategoryController::class, 'show']);

    Route::post('/', [CategoryController::class, 'store']);

    Route::put('/{id}', [CategoryController::class, 'update']);

    Route::delete('/{id}', [CategoryController::class, 'delete']);
});




Route::prefix('product')->group(function () {

    Route::get('/', [ProductController::class, 'index']);

    Route::get('/{id}', [ProductController::class, 'show']);

    Route::post('/', [ProductController::class, 'store']);

    Route::put('/{id}', [ProductController::class, 'update']);

    Route::delete('/{id}', [ProductController::class, 'delete']);
});


Route::prefix('review')->group(function () {

    Route::get('/', [ReviewController::class, 'index']);

    Route::get('/{id}', [ReviewController::class, 'show']);

    Route::get('/product/{id}', [ReviewController::class, 'showByIdProduct']);

    Route::post('/', [ReviewController::class, 'store']);

    Route::post('/{id}', [ReviewController::class, 'update']);

    Route::delete('/{id}', [ReviewController::class, 'delete']);
});

Route::prefix('order')->group(function () {

    Route::get('/', [OrderController::class, 'index']);

    Route::get('/{id}', [OrderController::class, 'show']);

    Route::get('in-progress', [OrderController::class, 'showInProgress']);

    Route::post('/', [OrderController::class, 'store']);

    Route::post('/update-status', [OrderController::class, 'updateStatus']);

    Route::delete('/{id}', [OrderController::class, 'delete']);
});

Route::prefix('news')->group(function () {

    Route::get('/', [NewsController::class, 'index']);

    Route::get('/{id}', [NewsController::class, 'show']);
});

Route::post('/parse-news-sky', [ParserNewsController::class, 'skyParse']);
Route::post('/parse-news-bbc', [ParserNewsController::class, 'bbcParse']);

Route::post('/payment', [PaymentController::class, 'index']);
Route::post('/payment/webhook', [PaymentController::class, 'webhook']);
