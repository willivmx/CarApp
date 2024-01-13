<?php


use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group(['prefix' => '/auth', 'as' => 'auth.'], function () {
    Route::get('/login', function () {
        return Inertia::render('Auth/Login');
    })->name('login');

    Route::get('/register', function () {
        return Inertia::render('Auth/Register');
    })->name('register');

    Route::get('/forgot-password', function () {
        return Inertia::render('Auth/ForgotPassword');
    })->name('forgotPassword');

    Route::get('/reset-password', function () {
        return Inertia::render('Auth/ResetPassword');
    })->name('resetPassword');

    Route::get('/confirm-password', function () {
        return Inertia::render('Auth/ConfirmPassword');
    })->name('confirmPassword');

    Route::get('/verify-email', function () {
        return Inertia::render('Auth/VerifyEmail');
    })->name('verifyEmail');
});
