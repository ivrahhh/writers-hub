<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResendEmailVerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserAuthenticationController;
use App\Http\Controllers\Auth\UserRegistrationController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::get('login', [UserAuthenticationController::class,'create'])->name('login');
    Route::post('login', [UserAuthenticationController::class,'store'])->name('login.auth'); 
    
    Route::get('register', [UserRegistrationController::class,'create'])->name('register');
    Route::post('register', [UserRegistrationController::class,'store'])->name('register.store');

    Route::get('password/forgot', [ForgotPasswordController::class,'create'])->name('password.request');
    Route::post('password/forgot', [ForgotPasswordController::class,'store'])->name('password.email');

    Route::get('password/reset/{token}',[ResetPasswordController::class,'edit'])->name('password.reset');
    Route::put('password/reset', [ResetPasswordController::class,'update'])->name('password.update');
});

Route::middleware('auth')->group(function() {  
    Route::post('logout', [UserAuthenticationController::class,'destroy'])->name('logout');

    Route::get('email/verify', [VerifyEmailController::class,'index'])->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', [VerifyEmailController::class,'store'])
        ->middleware('signed')
        ->name('verification.verify');
        
    Route::post('email/resend', ResendEmailVerificationController::class)
        ->middleware('throttle:6,1')
        ->name('verification.send');
});