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
Route::get('/admin/users/create', [AdminController::class, 'create_user'])->middleware(['auth', 'role:admin'])->name('admin.users.create');
Route::post('/api/admin/users/store', [AdminController::class, 'store_user'])->middleware(['auth', 'role:admin'])->name('admin.users.store');
Route::get('/admin/users/{user}/show', [AdminController::class, 'show_user'])->middleware(['auth', 'role:admin'])->name('admin.users.show');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit_user'])->middleware(['auth', 'role:admin'])->name('admin.users.edit');
Route::put('/api/admin/users/{user}', [AdminController::class, 'update_user'])->middleware(['auth', 'role:admin'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroy_user'])->middleware(['auth', 'role:admin'])->name('admin.users.destroy');

// Leave
