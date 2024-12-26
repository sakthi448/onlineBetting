<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\register\RegisterController;

Route::get('/register', [RegisterController::class, 'registerView'])->name('register-view');
Route::post('/register-store', [RegisterController::class, 'register'])->name('register');
// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
