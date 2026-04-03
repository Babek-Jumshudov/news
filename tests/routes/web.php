<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BasgetController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\OrdersController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/'], function () {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/home', [ProductController::class, 'index'])->name('home');
    Route::get('/explore', [ProductController::class, 'explore'])->name('explore');
    Route::get('/setting', [ProductController::class, 'setting'])->name('setting');
    Route::get('/home/products', [ProductController::class, 'products'])->name('home.products');
    Route::get('/home/sellers/{seller}', [ProductController::class, 'detals'])->name('home.detals');
    
    Route::get('/home/basget', [BasgetController::class, 'index'])->name('basget.index');
    Route::post('/home/basget', [BasgetController::class, 'basget'])->name('basget');
    Route::delete('/home/basget/delete/{basget}', [BasgetController::class, 'destroy'])->name('basget.delete');
    Route::get('/home/basget/order/{basget?}', [BasgetController::class, 'update'])->name('basget.update');
    
    Route::get('/orders', [OrdersController::class, 'index'])->name('orders');
    Route::get('/home/orders/create', [OrdersController::class, 'create'])->name('orders.create');

    Route::get('/favorites', [ProductController::class, 'favorites'])->name('favorites');
    Route::get('/home/favoritSeller/{seller}', [FavoritesController::class, 'create'])->name('sellers.fav');
    Route::delete('/favorites/seller/delete/{favorite}', [FavoritesController::class, 'destroy'])->name('favoritSeller.delete');

});

// --------------login-register---------------------------
Route::prefix('/login')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store'])->name("login");
});
Route::prefix('/register')->group(function () {
    Route::get('/', function () {
        return view('login-register.register');
    });
    Route::post('/', [UserController::class, 'Register'])->name("register");
});
Route::prefix("/forgot")->group(function () {
    Route::get('/', function () {
        return view('login-register.forgot');
    })->name('forgot');

    Route::post('password/reset', [UserController::class, 'resetPassword'])->name('password.reset');
});
Route::group(['prefix' => '/email'], function () {
    Route::get('connaction', [UserController::class, 'TestController'])->name('email.connaction');
    Route::get('send', [MailController::class, 'index'])->name('send.email');
});
// --------------Admin Panel-----------------------------
Route::group(['prefix' => '/adminPanel'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.user');
    Route::delete('users/{user}', [AdminController::class, 'destroy'])->name('admin.delete');
});
Route::group(['prefix' => 'adminPanel/menu'], function () {
    Route::get('/', [ProductController::class, 'view'])->name('menu');
    Route::post('/add', [ProductController::class, 'create'])->name('product.creat');
    Route::delete('product/{product}', [ProductController::class, 'destroy'])->name('product.delete');
});
Route::group(['prefix' => 'adminPanel/resturant'], function () {
    Route::get('/', [SellerController::class, 'index'])->name('restaurant');
    Route::post('/add', [SellerController::class, 'create'])->name('seller.creat');
    Route::delete('seller/{seller}', [SellerController::class, 'destroy'])->name('seller.delete');
});
