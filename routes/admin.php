<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use Illuminate\Support\Facades\Route;


/* ADMIN ROUTES */
// 1ST WAY TO CREATE A ROUTE
// Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth','role:admin'])->name('admin.dashboard');

// 2ND WAY

Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

/* PROFILE ROUTES */
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');