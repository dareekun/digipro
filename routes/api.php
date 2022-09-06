<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/show/{id}',  [ApiController::class, 'show']);
Route::get('/index',  [ApiController::class, 'index']);
Route::get('/update/{id}/{jumlah}',  [ApiController::class, 'update']);
Route::get('/reverse/{id}',  [ApiController::class, 'reverse']);


Route::post('/data/product',  [ApiController::class, 'data_product'])->name('data_product');
