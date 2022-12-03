<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobileController;
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

Route::post('/login',  [MobileController::class, 'login']);

Route::post('/lotcard_mobile',  [MobileController::class, 'lotcard_mobile']);
 
Route::get('/show/{id}',  [ApiController::class, 'show']);
Route::get('/index',  [ApiController::class, 'index']);
Route::get('/update/{id}/{jumlah}',  [ApiController::class, 'update']);
Route::get('/reverse/{id}',  [ApiController::class, 'reverse']);

Route::get('/all/products',  [ApiController::class, 'all_products'])->name('all_products');

Route::post('/printlotcard_mobile',  [MobileController::class, 'printlotcard_mobile']);

Route::post('/scaninspection_mobile',  [MobileController::class, 'scaninspection_mobile'])->name('scaninspection_mobile');
Route::post('/processinspection_mobile',  [MobileController::class, 'processinspection_mobile'])->name('processinspection_mobile');
Route::post('/showinspection_mobile',  [MobileController::class, 'showinspection_mobile'])->name('showinspection_mobile');
Route::post('/printinspection_mobile',  [MobileController::class, 'printinspection_mobile'])->name('printinspection_mobile');
Route::post('/closed_transaction',  [MobileController::class, 'closed_transaction'])->name('closed_transaction');

Route::post('/changepassword_mobile',  [MobileController::class, 'changepassword_mobile'])->name('changepassword_mobile');

Route::post('/scantransfers_mobile',  [MobileController::class, 'scantransfers_mobile'])->name('scantransfers_mobile');
Route::post('/processtransfers_mobile',  [MobileController::class, 'processtransfers_mobile'])->name('processtransfers_mobile');
Route::post('/datatransaction_mobile',  [MobileController::class, 'datatransaction_mobile'])->name('datatransaction_mobile');

Route::post('/data/product',  [ApiController::class, 'data_product'])->name('data_product');
Route::post('/data/user',  [ApiController::class, 'data_user'])->name('data_users');
Route::post('/data/parts',  [ApiController::class, 'data_parts'])->name('data_parts');
Route::post('/data/printer',  [ApiController::class, 'data_printer'])->name('data_printer');

Route::post('/delete/parts',  [ApiController::class, 'delete_parts'])->name('delete_parts');

Route::get('/data/finish_production',  [ApiController::class, 'finish_production'])->name('finish_production');