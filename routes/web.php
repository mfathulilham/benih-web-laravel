<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Backend\{DashboardController, CustomersController, SellerController, OrderController};

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


// Admin
Route::middleware('admin')->group(function() {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Customers
    Route::prefix('customer')->name('customer')->group(function(){
        Route::get('', [CustomersController::class, 'index'])->name('');
        Route::get('/edit/{id}', [CustomersController::class, 'edit'])->name('-edit');
    });
    // Seller
    Route::prefix('seller')->name('seller')->group(function(){
        Route::get('', [SellerController::class, 'index'])->name('');
        Route::get('/create', [SellerController::class, 'create'])->name('-create');
        Route::post('/store', [SellerController::class, 'store'])->name('-store');
        Route::get('/edit/{id}', [SellerController::class, 'edit'])->name('-edit');
    });
    // Order
    Route::get('/order', [OrderController::class, 'index'])->name('order');
});

Auth::routes();
