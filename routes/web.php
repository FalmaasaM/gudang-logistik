<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\GudangController;
use Illuminate\Support\Facades\Route;


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

// Route::get('/', function () {
//     return view('admin.index');
// });
Route :: get("/",[LoginController::class,'showLoginForm'])->name('login');
Route::get('stokgudang', [BarangController::class, 'join'])->name('join');

Route ::prefix("supplier")->group(function(){
Route::get('/', [SupplierController::class, 'index'])->name('supplier.index');
Route::get('add', [SupplierController::class, 'create'])->name('supplier.create');
Route::post('store', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
Route::post('update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
Route::post('delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');
});
Route ::prefix("barang")->group(function(){
Route::get('/', [BarangController::class, 'index'])->name('barang.index');
Route::get('add', [BarangController::class, 'create'])->name('barang.create');
Route::post('store', [BarangController::class, 'store'])->name('barang.store');
Route::get('edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
Route::post('update/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::post('delete/{id}', [BarangController::class, 'delete'])->name('barang.delete');
Route::post('recycle/{id}', [BarangController::class, 'recycle'])->name('barang.recycle');
Route::get('restore/{id}', [BarangController::class, 'restore'])->name('barang.restore');
});
Route ::prefix("gudang")->group(function(){
Route::get('/', [GudangController::class, 'index'])->name('gudang.index');
Route::get('add', [GudangController::class, 'create'])->name('gudang.create');
Route::post('store', [GudangController::class, 'store'])->name('gudang.store');
Route::get('edit/{id}', [GudangController::class, 'edit'])->name('gudang.edit');
Route::post('update/{id}', [GudangController::class, 'update'])->name('gudang.update');
Route::post('delete/{id}', [GudangController::class, 'delete'])->name('gudang.delete');
Route::post('recycle/{id}', [GudangController::class, 'recycle'])->name('gudang.recycle');
Route::get('restore/{id}', [GudangController::class, 'restore'])->name('gudang.restore');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
