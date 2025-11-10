<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\AdminBookController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminUserController;
use Illuminate\Support\Facades\Route;

// الصفحات العامة
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// صفحات الكتب
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

// صفحات المستخدم المسجل
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::view('profile', 'profile')->name('profile');
    Route::view('cart', 'cart')->name('cart');
});

// صفحات الإدارة
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::view('dashboard', 'admin.dashboard')->name('dashboard');
    
    // Books routes
    Route::get('books/trashed', [AdminBookController::class, 'trashed'])->name('books.trashed');
    Route::post('books/{id}/restore', [AdminBookController::class, 'restore'])->name('books.restore');
    Route::delete('books/{id}/force-delete', [AdminBookController::class, 'forceDelete'])->name('books.forceDelete');
    Route::resource('books', AdminBookController::class);
    
    // Categories routes
    Route::get('categories/trashed', [AdminCategoryController::class, 'trashed'])->name('categories.trashed');
    Route::post('categories/{id}/restore', [AdminCategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/force-delete', [AdminCategoryController::class, 'forceDelete'])->name('categories.forceDelete');
    Route::resource('categories', AdminCategoryController::class);
    
    // Orders routes
    Route::get('orders/trashed', [AdminOrderController::class, 'trashed'])->name('orders.trashed');
    Route::post('orders/{id}/restore', [AdminOrderController::class, 'restore'])->name('orders.restore');
    Route::delete('orders/{id}/force-delete', [AdminOrderController::class, 'forceDelete'])->name('orders.forceDelete');
    Route::resource('orders', AdminOrderController::class);
    
    Route::resource('users', AdminUserController::class);
});

require __DIR__.'/auth.php';
