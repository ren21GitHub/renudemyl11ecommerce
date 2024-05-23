<?php

use App\Http\Controllers\Backend\AdminController;
use Illuminate\Support\Facades\Route;


/* ADMIN ROUTES */
// 1ST WAY TO CREATE A ROUTE
// Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth','role:admin'])->name('admin.dashboard');

// 2ND WAY
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
