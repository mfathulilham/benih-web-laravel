<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\{HomeController, KeranjangController, ProfileController};
use App\Http\Controllers\Frontend\Transaksi\PemesananController;
use App\Http\Controllers\Backend\Admin\{DashboardController, CustomersController, SellerController, OrderController};
use App\Http\Controllers\Backend\Seller\{SellerHomeController,SellerTransaksiController, SellerPemesananController, SellerPengirimanController, SellerBenihController};

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
    Route::prefix('transaksi')->name('transaksi')->group(function(){
        Route::get('/pemesanan', [PemesananController::class, 'index'])->name('-pemesanan');
        Route::post('/pemesanan/bayar/{id}', [PemesananController::class, 'bayar'])->name('-pemesanan-bayar');
        Route::post('/pemesanan/cancel/{id}', [PemesananController::class, 'cancel'])->name('-pemesanan-cancel');
    });

    // Profile

});


Route::middleware('seller')->group(function () {
        //Home
        Route::get('/home', [SellerHomeController::class, 'index'])->name('home');
        //Transaksi
        Route::prefix('transaksi')->name('transaksi')->group(function(){
            Route::get('', [SellerPemesananController::class, 'index'])->name('');
            Route::get('/pengiriman', [SellerPengirimanController::class, 'index'])->name('-pengiriman');
        });
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
    Route::get('/order', [OrderController::class, 'index'])->name('order');
});

Auth::routes();
