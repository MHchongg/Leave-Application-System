<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Authentication and Authorization
Route::controller(SessionController::class)->group(function () {
    Route::get('/', 'index')->name('login');
    Route::post('/api/login', 'store')->name('user.login');
    Route::post('/api/logout', 'destroy')->name('logout');
});
Route::controller(RegisteredUserController::class)->group(function () {
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::get('/password/reset', 'password')->name('password');
        Route::patch('/api/password/reset/{user}', 'update_password')->name('password.update');
    });
});

// User
Route::controller(UserController::class)->group(function () {
    Route::middleware(['auth', 'role:user'])->group(function () {
        Route::get('/profile', 'profile')->name('profile');
        Route::get('/user/home', 'index')->name('user.home');
        Route::get('/profile/edit', 'edit_profile')->name('user.profile.edit');
        Route::put('/api/profile/{user}', 'update_profile')->name('user.profile.update');
    });
});

// Admin
Route::controller(AdminController::class)->group(function () {
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/admin/home', 'index')->name('admin.home');
        Route::get('/admin/users', 'users')->name('admin.users');
        Route::get('/admin/users/create', 'create_user')->name('admin.users.create');
        Route::post('/api/admin/users/store', 'store_user')->name('admin.users.store');
        Route::get('/admin/users/{user}/show', 'show_user')->name('admin.users.show');
        Route::delete('/admin/users/{user}', 'destroy_user')->name('admin.users.destroy');
    });
});

// Leave
Route::controller(LeaveController::class)->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/leave/create', 'create')->middleware('role:user')->name('leave.create');
        Route::post('/api/leave/store', 'store')->middleware('role:user')->name('leave.store');
        Route::get('/leave/{leave}/show', 'show')->can('view_leave', 'leave')->name('leave.show');
        Route::delete('/api/leave/{leave}', 'destroy')->can('delete_leave', 'leave')->name('leave.destroy');
        Route::patch('/api/leave/{leave}/approve', 'approve')->middleware('role:admin')->name('leave.approve');
        Route::patch('/api/leave/{leave}/reject', 'reject')->middleware('role:admin')->name('leave.reject');
    });
});
