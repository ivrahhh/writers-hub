<?php

use App\Http\Controllers\Auth\UserAuthenticationController;
use Illuminate\Support\Facades\Route;

Route::get('login', [UserAuthenticationController::class,'create'])->name('login');