<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Authentication and Authorization
Route::get('/', [SessionController::class, 'index'])->name('login');
Route::post('/api/login', [SessionController::class, 'store'])->name('user.login');
Route::post('/api/logout', [SessionController::class, 'destroy'])->name('logout');
Route::get('/forbidden', [SessionController::class, 'forbidden'])->name('forbidden');

// User
Route::get('/profile', [UserController::class, 'profile'])->middleware(['auth', 'role:user'])->name('profile');
Route::get('/user/home', [UserController::class, 'index'])->middleware(['auth', 'role:user'])->name('user.home');

// Admin
Route::get('/admin/home', [AdminController::class, 'index'])->middleware(['auth', 'role:admin'])->name('admin.home');
Route::get('/admin/users', [AdminController::class, 'users'])->middleware(['auth', 'role:admin'])->name('admin.users');

// Leave
