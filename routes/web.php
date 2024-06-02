<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::controller(UserController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('add/user', 'storeUser')->name('storeUser');
    Route::get('otp/email/{email}', 'showOTPVerificationForm')->name('otp');
    Route::post('/otp/verify/email/{email}', 'verifyOTP')->name('otp.verify');
    Route::get('/login', 'login')->name('login');
    Route::post('/login/user', 'loginUser')->name('loginUser');
});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::post('/transfer',  'transfer')->name('transfer.perform');
});

Route::controller(NotificationController::class)->group(function () {
    Route::get('/notification', 'notification')->name('notification');
    Route::post('/notifications/markAsRead', 'markAsRead')->name('notifications.markAsRead');
});
