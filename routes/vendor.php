<?php

use App\Http\Controllers\Backend\VendorController;
use Illuminate\Support\Facades\Route;


/* VENDOR ROUTES */
// 1ST WAY TO CREATE A ROUTE
// Route::get('vendor/dashboard', [VendorController::class, 'dashboard'])->middleware(['auth','role:vendor'])->name('vendor.dashboard');

// 2ND WAY
Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
