<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\noLoginController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\DeveloperController;
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

Route::post('/new_lotcard', [UserController::class, 'new_lotcard'])->middleware('can:isUser')->name('new_lotcard');
Route::post('/add_lotcard', [UserController::class, 'add_lotcard'])->middleware('can:isUser')->name('add_lotcard');
Route::post('/del_lotcard', [UserController::class, 'del_lotcard'])->middleware('can:isUser')->name('del_lotcard');

Route::get('/show_lotcard/{id}', [UserController::class, 'show_lotcard'])->middleware('can:isUser')->name('show_lotcard');
Route::get('/show_inspection/{id}', [UserController::class, 'show_inspection'])->middleware('can:isUser')->name('show_inspection');
Route::get('/show_pdf_form/{id}', [UserController::class, 'show_pdf_form'])->middleware('can:isUser')->name('show_pdf_form');

// Admin Control
Route::get('/product_control', [AdminController::class, 'product_control'])->middleware('can:isAdmin')->name('product_control');
Route::get('/users_control', [AdminController::class, 'users_control'])->middleware('can:isAdmin')->name('users_control');
Route::get('/department_control', [AdminController::class, 'department_control'])->middleware('can:isAdmin')->name('department_control');
Route::get('/detail_product/{id}', [AdminController::class, 'detail_product'])->middleware('can:isAdmin')->name('detail_product');


Route::post('/add_product', [AdminController::class, 'add_product'])->middleware('can:isAdmin')->name('add_product');
Route::post('/del_product', [AdminController::class, 'del_product'])->middleware('can:isAdmin')->name('del_product');
Route::post('/edt_product', [AdminController::class, 'edt_product'])->middleware('can:isAdmin')->name('edt_product');

Route::post('/add_users', [AdminController::class, 'add_users'])->middleware('can:isAdmin')->name('add_users');
Route::post('/del_users', [AdminController::class, 'del_users'])->middleware('can:isAdmin')->name('del_users');
Route::post('/edt_users', [AdminController::class, 'edt_users'])->middleware('can:isAdmin')->name('edt_users');
Route::post('/upd_users', [AdminController::class, 'upd_users'])->middleware('can:isAdmin')->name('upd_users');

Route::post('/add_department', [AdminController::class, 'add_department'])->middleware('can:isAdmin')->name('add_department');


// Production Barrier
Route::get('/inspection_detail/{id}', [HomeController::class, 'inspection_detail'])->middleware('can:isUser')->name('inspection_detail');

// Quality Barrier
Route::get('/production_detail/{id}', [HomeController::class, 'production_detail'])->middleware('can:isUser')->name('production_detail');
Route::get('/process_quality/{id}', [HomeController::class, 'process_quality'])->middleware('can:isUser')->name('process_quality');
Route::get('/modify_quality/{id}', [HomeController::class, 'modify_quality'])->middleware('can:isUser')->name('modify_quality');

Route::post('/create_inspection', [UserController::class, 'create_inspection'])->middleware('can:isUser')->name('create_inspection');
Route::post('/modify_inspection', [UserController::class, 'modify_inspection'])->middleware('can:isUser')->name('modify_inspection');

// Warehouse Barrier
Route::get('/transfers_details/{id}', [HomeController::class, 'transfers_details'])->middleware('can:isUser')->name('transfers_details');
Route::get('/generate_data', [UserController::class, 'generate_data'])->middleware('can:isUser')->name('generate_data');

Route::get('/download_data/{id}', [HomeController::class, 'download_data'])->middleware('can:isUser')->name('download_data');

// Developer Control
Route::get('/reroute_list', [DeveloperController::class, 'route_list'])->middleware('can:isDeveloper')->name('route_list');

Route::get('/bypass_data/{id}', [DeveloperController::class, 'bypass_data'])->middleware('can:isDeveloper')->name('bypass_data');
Route::get('/bypass_scan', [DeveloperController::class, 'bypass_scan'])->middleware('can:isDeveloper')->name('bypass_scan');
// JSON 
Route::post('/data1-json', [ApiController::class, 'json_data1'])->name('data1-json.data1');
Route::post('/data2-json', [ApiController::class, 'json_data2'])->name('data2-json.data2');