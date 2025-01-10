<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\setlocalecontroller;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login.submit');
Route::get('/password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('/password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm'])->name('password.confirm.submit');
Route::post('/password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');
Route::get('/password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'create'])->name('register.submit');

Route::get('/payment', [App\Http\Controllers\PaymentController::class, 'payment'])->name('payment');
Route::post('/payment', [App\Http\Controllers\PaymentController::class, 'processPayment'])->name('payment.submit');

Route::get('/payment/confirmation', [App\Http\Controllers\PaymentController::class, 'showPaymentConfirmation'])->name('payment.confirmation');
Route::post('/payment/confirmation', [App\Http\Controllers\PaymentController::class, 'confirmPayment'])->name('payment.confirmation.submit');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop');

Route::get('/chat/', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
Route::get('/chat/{receiverId}', [App\Http\Controllers\ChatController::class, 'showChatDetail'])->name('chat.detail');
Route::post('/chat/send', [App\Http\Controllers\ChatController::class, 'sendMessage'])->name('chat.send');

Route::get('/notification', [App\Http\Controllers\NotificationController::class, 'index'])->name('notification');

Route::post('/wishlist/add', [App\Http\Controllers\WhistlistController::class, 'toggleWishlist'])->name('wishlist.add');
Route::get('/wishlist', [App\Http\Controllers\WhistlistController::class, 'showWishlist'])->name('wishlist.show');
Route::post('/wishlist/accept/{userId}', [App\Http\Controllers\WhistlistController::class, 'acceptRequest'])->name('wishlist.accept');
Route::get('/set-locale/{locale}', [setlocalecontroller::class, 'setLocale'])->name('set-locale');