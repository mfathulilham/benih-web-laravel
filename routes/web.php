<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\{HomeController, KeranjangController, ProfileController, RekeningController};
use App\Http\Controllers\Frontend\Transaksi\PemesananController;
use App\Http\Controllers\Backend\Admin\{DashboardController, CustomersController, SellerController, OrderController};
use App\Http\Controllers\Auth\NexmoController;
use App\Http\Controllers\Backend\Seller\{SellerHomeController,SellerTransaksiController, SellerBenihController, SellerProfileController};

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

Route::get('', [HomeController::class, 'index'])->name('')->middleware('notverified');
// Route::get('', [HomeController::class, 'index'])->name('')->middleware('verifiedphone');
Route::middleware('user',)->group(function () {
    //Home

    Route::prefix('/')->name('home')->group(function(){
        // Home Detail
        Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('-detail');
        Route::post('/add/{id}', [HomeController::class, 'add'])->name('-add');
        // Keranjang
        Route::prefix('keranjang')->name('-keranjang')->group(function(){
            Route::get('', [KeranjangController::class, 'keranjang'])->name('');
            Route::post('/add', [KeranjangController::class, 'keranjang_add'])->name('-add');
            Route::delete('/delete/{id}', [KeranjangController::class, 'delete'])->name('-delete');
        });
        // Profile
        Route::get('profile', [HomeController::class, 'profile'])->name('-profile');
        Route::patch('profile/update', [HomeController::class, 'profile_update'])->name('-profile-update');
        // Rekening
        Route::prefix('rekening')->name('-rekening')->group(function(){
            Route::get('', [RekeningController::class, 'index'])->name('');
            Route::post('add', [RekeningController::class, 'add'])->name('-add');
            Route::delete('delete/{id}', [RekeningController::class, 'delete'])->name('-delete');
        });
        // Password
        Route::prefix('password')->name('-password')->group(function(){
            Route::get('', [HomeController::class, 'password'])->name('');
            Route::patch('pass_update', [HomeController::class, 'pass_update'])->name('-update');
        });
        // Search
        Route::get('/search', [HomeController::class, 'search'])->name('-search');
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

    Route::prefix('selesai')->name('selesai')->group(function(){
        Route::get('/', [PemesananController::class, 'user_selesai'])->name('');
        Route::post('rating/{id}', [PemesananController::class, 'user_rating'])->name('-rating');

    });

});

// SMS



Route::middleware('seller')->group(function () {
        //Home
        Route::get('/home', [SellerHomeController::class, 'index'])->name('home');

        //Transaksi
        Route::get('/seller_pemesanan', [SellerTransaksiController::class, 'pemesanan'])->name('seller_pemesanan');
        Route::post('/seller_pemesanan/cancel/{id}', [SellerTransaksiController::class, 'seller_pemesanan_cancel'])->name('seller_pemesanan-cancel');

        Route::get('/seller_pengiriman', [SellerTransaksiController::class, 'pengiriman'])->name('seller_pengiriman');
        Route::post('/seller_pengiriman/kirim/{id}', [SellerTransaksiController::class, 'seller_pengiriman_kirim'])->name('seller_pengiriman-kirim');
        Route::post('/seller_pengiriman/selesai/{id}', [SellerTransaksiController::class, 'seller_pengiriman_selesai'])->name('seller_pengiriman-selesai');
        Route::post('/seller_pengiriman/cancel/{id}', [SellerTransaksiController::class, 'seller_pengiriman_cancel'])->name('seller_pengiriman-cancel');

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

        // Profile
        Route::prefix('seller_profile')->name('seller_profile')->group(function(){
            Route::get('', [SellerProfileController::class, 'index'])->name('');
            Route::patch('/update', [SellerProfileController::class, 'update'])->name('-update');
        });
        // Password
        Route::get('seller_password', [SellerProfileController::class, 'pass'])->name('seller_pass');
        Route::patch('/seller_password/update', [SellerProfileController::class, 'pass_update'])->name('seller_pass_update');
        // Rekening
        Route::prefix('seller_rekening')->name('seller_rekening')->group(function(){
            Route::get('', [SellerProfileController::class, 'rekening'])->name('');
            Route::post('add', [SellerProfileController::class, 'add'])->name('-add');
            Route::delete('delete/{id}', [SellerProfileController::class, 'delete'])->name('-delete');
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
        Route::post('/confirm/{id}', [SellerController::class, 'confirm'])->name('-confirm');
    });
    // Order
    Route::prefix('order')->name('order')->group(function(){
        Route::get('', [OrderController::class, 'index'])->name('');
        Route::post('/confirm/{id}', [OrderController::class, 'confirm'])->name('-confirm');
        Route::post('/selesai/{id}', [OrderController::class, 'selesai'])->name('-selesai');
        Route::post('/dana_pembeli/{id}', [OrderController::class, 'dana_pembeli'])->name('-dana_pembeli');
        Route::post('/cancel/{id}', [OrderController::class, 'cancel'])->name('-cancel');
    });
});

Auth::routes();
// Auth::routes();


Route::get('/verify', [NexmoController::class, 'index'])->name('verify')->middleware('verifiedphone');
Route::post('/verify', [NexmoController::class, 'verify'])->name('verify')->middleware('verifiedphone');
Route::post('/otp', [NexmoController::class, 'otp'])->name('otp')->middleware('verifiedphone');
