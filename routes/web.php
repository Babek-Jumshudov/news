<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NewsController::class, 'index'])->name('news.index');
Route::get('/home', [NewsController::class, 'index'])->name('home');
Route::delete('/news/{id}', [NewsController::class, 'delete'])->name('news.delete');

// Admin panel routes
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/news/store', [AdminController::class, 'storeNews'])->name('admin.storeNews');
// Xəbəri redaktə etmək
Route::get('admin/news/edit/{id}', [AdminController::class, 'editNewsForm'])->name('admin.news.editForm'); 
Route::post('admin/news/edit/{id}', [AdminController::class, 'editNews'])->name('admin.news.edit');
// Xəbəri redaktə silmek
Route::delete('/admin/news/{id}', [AdminController::class, 'deleteNews'])->name('admin.deleteNews');

