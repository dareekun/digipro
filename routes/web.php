<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
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

Route::get('/home', [HomeController::class, 'index']);

Route::get('/',  [InfoController::class, 'welcome']);

Route::get('/welcome', function () {
    return view('home1');
});

Route::get('/test',  [ApiController::class, 'test']);

Route::get('/tabel/{id}', [InfoController::class, 'tabel']);
Route::get('/graph/{id}', [InfoController::class, 'graph']);
Route::get('lotcard0', [InfoController::class, 'lotcard0']);
Route::any('lotstatus', [InfoController::class, 'lotstatus']);
Route::any('/lotscaned', [InfoController::class, 'lotscaned']);
Route::get('/dellot/{id}', [InfoController::class, 'dellot']);
Route::get('/rubahlot/{id}', [InfoController::class, 'rubahlot']);
Route::post('/rubahlots', [InfoController::class, 'rubahlots']);


Route::any('/graphbulan/{id}', [InfoController::class, 'graphbulan']);
Route::post('/lotcard', [InfoController::class, 'lotcard']);
Route::post('/lotcard1', [InfoController::class, 'lotcard1']);
Route::post('/lotcardalpha', [InfoController::class, 'lotcardalpha']);
Route::post('/plusalpha', [InfoController::class, 'plusalpha']);

Route::post('/plusalpha', [InfoController::class, 'plusalpha']);

Route::get('/lotsp/{param0}', [InfoController::class, 'lotsp']);

Route::get('/laksan/{param0}', [InfoController::class, 'lotcardalpha2']);

Route::get('/lotsphps/{id}', [InfoController::class, 'lotsphps']);


Auth::routes();

//user level
Route::get('/home', [HomeController::class, 'index'])->middleware('can:isUser')->name('home');
Route::get('/profile/{id}', [HomeController::class, 'profile'])->middleware('can:isUser');
Route::get('/data/{id}', [UserController::class, 'data'])->middleware('can:isUser');
Route::get('/mesin/{id}', [UserController::class, 'mesin'])->middleware('can:isUser');
Route::post('/mesin2', [UserController::class, 'mesin2'])->middleware('can:isUser');
Route::post('/mesin3', [UserController::class, 'mesin3'])->middleware('can:isUser');
Route::post('/next', [UserController::class, 'next'])->middleware('can:isUser');
Route::post('/next2', [UserController::class, 'next2'])->middleware('can:isUser');
Route::get('/detail/{id}', [AdminController::class, 'detail'])->middleware('can:isUser');
Route::get('/resume/{id}', [UserController::class, 'resume'])->middleware('can:isUser');
Route::get('/resumim/{id}', [UserController::class, 'resumim'])->middleware('can:isUser');
Route::get('/refresh/{id}', [UserController::class, 'refresh'])->middleware('can:isUser');
Route::get('/refreshing/{id}', [UserController::class, 'refreshing'])->middleware('can:isUser');
Route::any('/user/planning', [UserController::class, 'planning'])->middleware('can:isUser');
Route::get('/lotdetail/{id}', [InfoController::class, 'lotdetail'])->middleware('can:isUser');
Route::get('/cetaklot/{id}', [InfoController::class, 'cetaklot'])->middleware('can:isUser');

//admin level
Route::post('/user/update', [HomeController::class, 'profileupdate'])->middleware('can:isUser');
Route::get('admin/tambahakun', function () {return view('auth.register');})->middleware('can:isAdmin');
Route::post('/daftar', [AdminController::class, 'daftar'])->middleware('can:isAdmin');
Route::get('/admin/pengaturan', [AdminController::class, 'urus'])->middleware('can:isAdmin');
Route::post('/admin/delaku', [AdminController::class, 'delaku'])->middleware('can:isAdmin');
Route::post('/admin/changep', [AdminController::class, 'changep'])->middleware('can:isAdmin');
Route::get('/admin/planning', [AdminController::class, 'planning'])->middleware('can:isAdmin');
Route::get('/admin/produk', [AdminController::class, 'produk'])->middleware('can:isAdmin');
Route::get('/admin/tambahproduk', [AdminController::class, 'tambahproduk'])->middleware('can:isAdmin');
Route::post('/admin/tambahplan', [AdminController::class, 'tambahplan'])->middleware('can:isAdmin');

// Pengaturan Produk
Route::get('/admin/produk', [AdminController::class, 'produk'])->middleware('can:isAdmin');
Route::post('/produk/dihapus', [AdminController::class, 'produkdihapus'])->middleware('can:isAdmin');
Route::post('/produk/ditambah', [AdminController::class, 'produkditambah'])->middleware('can:isAdmin');

// Pengaturan Masalah
Route::get('/pengaturan/masalah', [AdminController::class, 'masalah'])->middleware('can:isAdmin');
Route::post('/masalah/dihapus', [AdminController::class, 'masalahdihapus'])->middleware('can:isAdmin');
Route::post('/masalah/ditambah', [AdminController::class, 'masalahditambah'])->middleware('can:isAdmin');
Route::post('/masalah/dirubah', [AdminController::class, 'masalahdirubah'])->middleware('can:isAdmin');

// Pengaturan Shift
Route::get('/pengaturan/shift', [AdminController::class, 'shift'])->middleware('can:isAdmin');
Route::post('/shift/dihapus', [AdminController::class, 'shiftdihapus'])->middleware('can:isAdmin');
Route::post('/shift/diedit', [AdminController::class, 'shiftdiedit'])->middleware('can:isAdmin');
Route::post('/shift/ditambah', [AdminController::class, 'shiftditambah'])->middleware('can:isAdmin');

Route::get('/hapus/{id}', [UserController::class, 'hapusdataproduk'])->middleware('can:isAdmin');

//manager level
Route::get('/manager/Informasi', [ManagerController::class, 'informasi'])->middleware('can:isManager');
Route::post('/manager/Informasi/update', [ManagerController::class, 'informasiupdate'])->middleware('can:isManager');

// JSON 
Route::post('data1-json', [HomeController::class, 'select1'])->name('data1-json.data1');
Route::post('data2-json', [HomeController::class, 'select2'])->name('data2-json.data2');
Route::post('data3-json', [HomeController::class, 'select3'])->name('data3-json.data3');

Route::post('lot1-json', [HomeController::class, 'lot1'])->name('lot1-json.lot1');
Route::post('lot2-json', [HomeController::class, 'lot2'])->name('lot2-json.lot2');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
