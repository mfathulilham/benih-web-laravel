<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\{HomeController, KeranjangController, ProfileController};
use App\Http\Controllers\Frontend\Transaksi\PemesananController;
use App\Http\Controllers\Backend\Admin\{DashboardController, CustomersController, SellerController, OrderController};
use App\Http\Controllers\Backend\Seller\{SellerHomeController,SellerTransaksiController, SellerBenihController};

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

Route::get('', [HomeController::class, 'index'])->name('');
Route::middleware('user')->group(function () {
    //Home

    Route::prefix('/')->name('home')->group(function(){
        // Home Detail
        Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('-detail');
        Route::post('/add/{id}', [HomeController::class, 'add'])->name('-add');
        // Keranjang
        Route::get('/keranjang', [HomeController::class, 'keranjang'])->name('-keranjang');
        Route::post('/keranjang/add', [HomeController::class, 'keranjang_add'])->name('-keranjang-add');
        // Profile
        Route::get('profile', [HomeController::class, 'profile'])->name('-profile');
    });


    // Transaksi
    Route::prefix('pemesanan')->name('pemesanan')->group(function(){
        Route::get('/', [PemesananController::class, 'index'])->name('');
        Route::post('bayar/{id}', [PemesananController::class, 'bayar'])->name('-bayar');
        Route::post('cancel/{id}', [PemesananController::class, 'cancel'])->name('-cancel');

    });
    Route::prefix('pengiriman')->name('pengiriman')->group(function(){
        Route::get('', [PemesananController::class, 'user_pengiriman'])->name('');
    });
    Route::get('cancel', [PemesananController::class, 'user_cancel'])->name('cancel');
    Route::get('selesai', [PemesananController::class, 'user_selesai'])->name('selesai');

});


Route::middleware('seller')->group(function () {
        //Home
        Route::get('/home', [SellerHomeController::class, 'index'])->name('home');

        //Transaksi
        Route::get('/seller_pemesanan', [SellerTransaksiController::class, 'pemesanan'])->name('seller_pemesanan');
        Route::post('/seller_pemesanan/cancel/{id}', [SellerTransaksiController::class, 'seller_pemesanan_cancel'])->name('seller_pemesanan-cancel');

        Route::get('/seller_pengiriman', [SellerTransaksiController::class, 'pengiriman'])->name('seller_pengiriman');
        Route::post('/seller_pengiriman/kirim/{id}', [SellerTransaksiController::class, 'seller_pengiriman_kirim'])->name('seller_pengiriman-kirim');
        Route::post('/seller_pengiriman/selesai/{id}', [SellerTransaksiController::class, 'seller_pengiriman_selesai'])->name('seller_pengiriman-selesai');

        Route::get('/seller_selesai', [SellerTransaksiController::class, 'selesai'])->name('seller_selesai');
        Route::get('/seller_cancel', [SellerTransaksiController::class, 'cancel'])->name('seller_cancel');

        //Benih
        Route::prefix('benih')->name('benih')->group(function(){
            Route::get('', [SellerBenihController::class, 'index'])->name('');
            Route::get('/create', [SellerBenihController::class, 'create'])->name('-create');
            Route::post('/store', [SellerBenihController::class, 'store'])->name('-store');
            Route::get('/edit/{id}', [SellerBenihController::class, 'edit'])->name('-edit');
            Route::patch('/update/{id}', [SellerBenihController::class, 'update'])->name('-update');
            Route::delete('/delete/{id}', [SellerBenihController::class, 'delete'])->name('-delete');
        });

});

// Admin Dashboard
Route::middleware('admin')->group(function() {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Customers
    Route::prefix('customer')->name('customer')->group(function(){
        Route::get('', [CustomersController::class, 'index'])->name('');
        Route::get('/edit/{id}', [CustomersController::class, 'edit'])->name('-edit');
        Route::patch('/update/{id}', [CustomersController::class, 'update'])->name('-update');
        Route::delete('/delete/{id}', [CustomersController::class, 'delete'])->name('-delete');
    });
    // Seller
    Route::prefix('seller')->name('seller')->group(function(){
        Route::get('', [SellerController::class, 'index'])->name('');
        Route::get('/create', [SellerController::class, 'create'])->name('-create');
        Route::post('/store', [SellerController::class, 'store'])->name('-store');
        Route::get('/edit/{user:id}', [SellerController::class, 'edit'])->name('-edit');
        Route::patch('/update/{id}', [SellerController::class, 'update'])->name('-update');
        Route::delete('/delete/{id}', [SellerController::class, 'delete'])->name('-delete');
    });
    // Order
    Route::prefix('order')->name('order')->group(function(){
        Route::get('', [OrderController::class, 'index'])->name('');
        Route::post('/confirm/{id}', [OrderController::class, 'confirm'])->name('-confirm');
    });
});

Auth::routes();
