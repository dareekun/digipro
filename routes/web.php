<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\noLoginController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index']);


Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/lotcard_status', [HomeController::class, 'lotcard_status'])->name('lotcard_status');
Route::get('/production_data', [HomeController::class, 'production_data'])->name('production_data');
Route::get('/in_production', [HomeController::class, 'in_production'])->name('in_production');
Route::get('/finish_data', [HomeController::class, 'finish_data'])->name('finish_data');
Route::get('/transaction_data', [HomeController::class, 'transaction_data'])->name('transaction_data');
Route::get('/transfers_records', [HomeController::class, 'transfers_records'])->name('transfers_records');

// User Control
Route::get('/change_password', [HomeController::class, 'change_password'])->middleware('can:isUser')->name('change_password');
Route::post('/add_lotcard', [UserController::class, 'add_lotcard'])->middleware('can:isUser')->name('add_lotcard');

// Admin Control
Route::get('/users_control', [AdminController::class, 'users_control'])->middleware('can:isAdmin')->name('users_control');
Route::get('/product_control', [AdminController::class, 'product_control'])->middleware('can:isAdmin')->name('product_control');
Route::get('/department_control', [AdminController::class, 'department_control'])->middleware('can:isAdmin')->name('department_control');
Route::post('/add_department', [AdminController::class, 'add_department'])->middleware('can:isAdmin')->name('add_department');

Route::post('/edit_product', [AdminController::class, 'edit_product'])->middleware('can:isAdmin')->name('edit_product');

// Developer Control
Route::get('/reroute_list', [DeveloperController::class, 'route_list'])->middleware('can:isDeveloper')->name('route_list');

// JSON 
Route::post('/data1-json', [ApiController::class, 'json_data1'])->name('data1-json.data1');
Route::post('/data2-json', [ApiController::class, 'json_data2'])->name('data2-json.data2');