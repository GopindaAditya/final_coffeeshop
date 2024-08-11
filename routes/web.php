<?php

use App\Http\Controllers\AuhtController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
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

// Route::get('/otp', function () {
//     return view('verify-otp');
// });

Route::get('/login', [AuhtController::class, 'index'])->name('login');
Route::post('/login', [AuhtController::class, 'login']);
Route::get('/logout', [AuhtController::class, 'logout'])->name('logout');
Route::get('/register', [AuhtController::class, 'showReq'])->name('register');
Route::post('/register', [AuhtController::class, 'register']);
Route::post('/verifyOtp', [AuhtController::class, 'verifyOtp'])->name('verify.otp');
Route::post('/resendOtp', [AuhtController::class, 'resendOtp'])->name('resend.otp');
Route::get('/forgotPassword', [AuhtController::class, 'showForgotPassword'])->name('forgotPassword');
Route::post('/forgotPassword', [AuhtController::class, 'sendOtp'])->name('sendOtp');
Route::post('/changePassword', [AuhtController::class, 'forgotPassword'])->name('verify');
Route::get('/resetPassword',[AuhtController::class, 'showResetPassword'])->name('resetPassword');
Route::post('/resetPassword',[AuhtController::class, 'resetPassword']);


Route::get('/', [ProdukController::class, 'index'])->name('manu');
Route::get('/read', [ProdukController::class, 'read'])->name('read');
Route::post('/search', [ProdukController::class, 'search'])->name('search');

//costomer route
Route::get('/customer/dahsboard', [CustomerController::class, 'index'])->name('customer');
Route::get('/customer/read',[CustomerController::class,'read'])->name('customerDetail');
Route::post('/customer/update', [CustomerController::class, 'update'])->name('customer.update');
Route::post('/hitung-harga', [CartController::class, 'hitungHarga']);
Route::get('/customer/menu', [ProdukController::class, 'index'])->name('customer.menu');
Route::get('/customer/cart', [CartController::class, 'index']);
Route::get('/customer/detailCart', [CartController::class, 'read'])->name('detailCart'); // Ubah nama rute menjadi 'detailCart'
Route::get('/customer/shopping-cart/{id}', [CartController::class, 'show'])->name('cart');
Route::get('/customer/cart/{id}', [CartController::class, 'show'])->name('cart');
Route::post('/customer/addCart/{id}', [CartController::class, 'addCart'])->name('addCart'); // Ubah nama rute menjadi 'addToCart'
Route::post('/customer/cart/delete', [CartController::class, 'destroy'])->name('delCart'); // Ubah nama rute menjadi 'addToCart'
Route::post('/customer/cekout', [CartController::class, 'cekout'])->name('cekout');
Route::get('/customer/qrcode', [CartController::class, 'qrcode'])->name('qrcode');
Route::get('/customer/uploadBukti', [PenjualanController::class, 'showUploadBukti'])->name('showUploadBukti');
Route::post('/customer/uploadBukti', [PenjualanController::class, 'uploadBukti'])->name('uploadBukti');
Route::get('/customer/updateTransactionStatus/{id}', [CartController::class, 'updateTransactionStatus'])->name('updateTransactionStatus');



//owner route
Route::get('/owner/menu',[OwnerController::class, 'index'])->name('owner');
Route::get('/owner/menu/read',[OwnerController::class, 'read'])->name('owner.read');
Route::post('/owner/menu/search',[OwnerController::class, 'search'])->name('owner.search');
Route::get('/owner/menu/create',[OwnerController::class, 'create'])->name('create');
Route::post('/owner/menu/addProduk',[OwnerController::class, 'addProduk'])->name('addProduk');
Route::get('/owner/menu/edit/{id}',[OwnerController::class, 'show'])->name('edit');
Route::post('/owner/menu/update/{id}', [OwnerController::class, 'update'])->name('update');
Route::post('/owner/menu/delete/{id}', [OwnerController::class, 'destroy'])->name('delete');
Route::post('/owner/menu/addStok/{id}', [OwnerController::class, 'addStok'])->name('addStok');
Route::post('/owner/menu/minStok/{id}', [OwnerController::class, 'minStok'])->name('minStok');
Route::get('/owner/laporan', [OwnerController::class, 'laporan']);
Route::get('/owner/cetakLaporan', [OwnerController::class, 'cetakLaporan'])->name('cetakLaporan');

//kasir route
Route::get('/kasir/menu', [KasirController::class, 'index'])->name('kasir');
Route::get('/kasir/menu/read', [KasirController::class, 'read'])->name('kasir.read');
Route::post('/kasir/menu/search', [KasirController::class, 'search'])->name('kasir.search');
Route::get('/kasir/menu/stok/{id}', [KasirController::class, 'stok'])->name('kasir.stok');
Route::post('/kasir/menu/updateStok/{id}', [KasirController::class, 'updateStok'])->name('kasir.updateStok');
Route::post('/kasir/menu/addStok/{id}', [KasirController::class, 'addStok'])->name('addStok');
Route::post('/kasir/menu/minStok/{id}', [KasirController::class, 'minStok'])->name('minStok');
Route::get('/kasir/pesanan', [PenjualanController::class, 'index'])->name('pesanan');
Route::get('/kasir/pesanan/read', [PenjualanController::class, 'read'])->name('pesanan.read');
Route::get('/kasir/pesanan/bukti/{id}', [PenjualanController::class, 'showBukti'])->name('pesanan.bukti');
Route::post('/kasir/pesanan/confirm/{id}', [PenjualanController::class, 'confirm'])->name('pesanan.confirm');
Route::get('/kasir/nota', [PenjualanController::class, 'nota'])->name('nota');
Route::get('/kasir/nota/read', [PenjualanController::class, 'readNota'])->name('nota.read');
Route::get('/kasir/nota/cetak/{id}', [PenjualanController::class, 'cetakNota'])->name('nota.cetakNota');