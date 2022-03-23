<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\front\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\back;

//auth route
Route::get('/login', [Auth\LoginController::class, 'index'])->name('login');
Route::get('/register', [Auth\RegisterController::class, 'index'])->name('register');
Route::get('/forgotPassword', [Auth\ForgotPasswordController::class, 'index'])->name('forgotPassword');
Route::get('/resetPassword', [Auth\ResetPasswordController::class, 'index'])->name('resetPassword');

Route::prefix('panel')->middleware('auth')->name('panel')->group(function () {

    //verify phone number
    Route::get('verify', [Auth\VerificationController::class, 'index'])->name('.verify');

    //verified routes
    Route::middleware('auth.verify')->group(function () {

        Route::get('/dashboard', [back\DashboardController::class, 'index'])->name('.dashboard');

        //profile
        Route::prefix('profile')->name('.profile')->group(function () {
            Route::get('/{user}/settings', [back\UserController::class, 'edit'])->name('.settings');
            Route::get('/verify/{token}', [Auth\VerificationController::class, 'verifyEmail'])->name('.email.verify');
        });
    });
});

//front routes
Route::name('front')->group(function () {
    Route::get('/sitemap', function () {
        redirect(url('/sitemap.xml'));
    })->name('.sitemap');

    Route::get('', [HomeController::class, 'index'])->name('.home');
});
