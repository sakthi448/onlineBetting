<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\login\LoginController;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Route::get('game-entry', [LoginController::class, 'gameEntry'])->name('gameEntry')->middleware('auth'); 
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
