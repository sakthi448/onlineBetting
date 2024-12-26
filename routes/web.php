<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin/users/data', [UserController::class, 'getAllUsers'])->name('admin.users.data');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

require_once  __DIR__.'/register/register.php';
require_once  __DIR__.'/login/login.php';
require_once  __DIR__.'/wallet.php';

