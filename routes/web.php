<?php

use App\Http\Controllers\LeaveController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

// Authentication
Route::get('/', [SessionController::class, 'index'])->name('login');
Route::post('/api/login', [SessionController::class, 'store'])->name('user.login');
Route::post('/api/logout', [SessionController::class, 'destroy'])->name('user.logout');

Route::get('/profile', [RegisteredUserController::class, 'profile'])->middleware('auth')->name('profile');

// Leave
Route::get('/user/home', [LeaveController::class, 'user'])->middleware('auth')->name('user.home');
Route::get('/admin/home', [LeaveController::class, 'admin'])->middleware('auth')->name('admin.home');