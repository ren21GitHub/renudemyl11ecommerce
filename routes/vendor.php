<?php

use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProfileController;
use Illuminate\Support\Facades\Route;


/* VENDOR ROUTES */
// 1ST WAY TO CREATE A ROUTE
// Route::get('vendor/dashboard', [VendorController::class, 'dashboard'])->middleware(['auth','role:vendor'])->name('vendor.dashboard');

// 2ND WAY
Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile/update', [VendorProfileController::class, 'updateVendorProfile'])->name('profile.update');
Route::put('profile/update/password', [VendorProfileController::class, 'updateVendorPassword'])->name('password.update');
