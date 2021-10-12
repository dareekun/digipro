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

Route::get('/',  [InfoController::class, 'welcome']);

Route::get('/tabel/{id}', [InfoController::class, 'tabel']);
Route::get('/graph/{id}', [InfoController::class, 'graph']);
Route::get('lotcard0', [InfoController::class, 'lotcard0']);
Route::any('lotstatus', [InfoController::class, 'lotstatus']);
Route::any('/lotscaned', [InfoController::class, 'lotscaned']);
Route::get('/dellot/{id}', [InfoController::class, 'dellot']);
Route::any('/graphbulan/{id}', [InfoController::class, 'graphbulan']);
Route::post('/lotcard', [InfoController::class, 'lotcard']);
Route::post('/lotcardalpha', [InfoController::class, 'lotcardalpha']);
Route::post('/plusalpha', [InfoController::class, 'plusalpha']);
Route::get('/laksan/{param0}', [InfoController::class, 'lotcardalpha2']);
Route::get('/delparts/{id}', [InfoController::class, 'delparts']);

Auth::routes();

//user level
Route::get('/home', [HomeController::class, 'index'])->middleware('can:isUser')->name('home');
Route::get('/profile/{id}', [HomeController::class, 'profile'])->middleware('can:isUser');
Route::get('/input/{id}', [UserController::class, 'input0'])->middleware('can:isUser');
Route::post('/next', [UserController::class, 'next'])->middleware('can:isUser');
Route::post('/next2', [UserController::class, 'next2'])->middleware('can:isUser');
Route::get('/detail/{id}', [UserController::class, 'detail'])->middleware('can:isUser');
Route::get('/resume/{id}', [UserController::class, 'resume'])->middleware('can:isUser');
Route::get('/refresh/{id}', [UserController::class, 'refresh'])->middleware('can:isUser');
Route::get('/lotdetail/{id}', [InfoController::class, 'lotdetail'])->middleware('can:isUser');
Route::get('/cetaklot/{id}', [InfoController::class, 'cetaklot'])->middleware('can:isUser');

//admin level
Route::post('/user/update', [HomeController::class, 'profileupdate'])->middleware('can:isUser');
Route::get('/admin/tambahakun', function () {return view('auth.register');})->middleware('can:isAdmin');
Route::post('/baru/tambahakun', [AdminController::class, 'daftar'])->middleware('can:isAdmin');
Route::get('/admin/pengaturan', [AdminController::class, 'urus'])->middleware('can:isAdmin');

Route::post('/admin/delaku', [AdminController::class, 'delaku'])->middleware('can:isAdmin');
Route::post('/admin/changep', [AdminController::class, 'changep'])->middleware('can:isAdmin');
Route::get('/admin/produk', [AdminController::class, 'produk'])->middleware('can:isAdmin');
Route::get('/admin/produk/{tipe}', [AdminController::class, 'detailproduk'])->middleware('can:isAdmin');
Route::get('/admin/produk/parts/hapus/{id}', [AdminController::class, 'hapusparts'])->middleware('can:isAdmin');
Route::get('/admin/tambahproduk', [AdminController::class, 'tambahproduk'])->middleware('can:isAdmin');
Route::post('/admin/tambahplan', [AdminController::class, 'tambahplan'])->middleware('can:isAdmin');

// Pengaturan Produk
Route::get('/admin/produk', [AdminController::class, 'produk'])->middleware('can:isAdmin');
Route::post('/produk/dihapus', [AdminController::class, 'produkdihapus'])->middleware('can:isAdmin');
Route::post('/produk/ditambah', [AdminController::class, 'produkditambah'])->middleware('can:isAdmin');
Route::post('/produk/dirubah', [AdminController::class, 'produkdirubah'])->middleware('can:isAdmin');

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

// JSON 
Route::post('data1-json', [HomeController::class, 'select1'])->name('data1-json.data1');
Route::post('data2-json', [HomeController::class, 'select2'])->name('data2-json.data2');

Route::post('lot1-json', [HomeController::class, 'lot1'])->name('lot1-json.lot1');
Route::post('lot2-json', [HomeController::class, 'lot2'])->name('lot2-json.lot2');

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Route No Login Needed
Route::post('/downloadpwk', [noLoginController::class, 'downloadpwk']);
Route::get('/grafik/{id}', [noLoginController::class, 'grafik']);
Route::post('/returnpwk', [noLoginController::class, 'returnpwk']);
Route::get('/monitor', [noLoginController::class, 'monitor']);

