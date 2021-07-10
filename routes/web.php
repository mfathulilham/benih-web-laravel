<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Seller Dashboard
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
        Route::get('/edit/{id}', [SellerController::class, 'edit'])->name('-edit');
        Route::patch('/update/{id}', [SellerController::class, 'update'])->name('-update');
        Route::delete('/delete/{id}', [SellerController::class, 'delete'])->name('-delete');
    });
    // Order
    Route::get('/order', [OrderController::class, 'index'])->name('order');
});

Auth::routes();
