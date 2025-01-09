<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop');
Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chat');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');
Route::get('/notification', [App\Http\Controllers\NotificationController::class, 'index'])->name('notification');
Route::get('/payment/{user}', [PaymentController::class, 'showPaymentForm'])->name('payment');
Route::post('/payment/{user}', [PaymentController::class, 'processPayment'])->name('payment.process');