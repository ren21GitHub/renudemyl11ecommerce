<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
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

/* Slider Route */
Route::resource('slider', SliderController::class);

/* Category Route */
Route::put('changed-status', [CategoryController::class, 'changeStatus'])->name('category.change-status');
Route::resource('category', CategoryController::class);

/* SubCategory Route */
Route::put('subcategory/changed-status', [SubCategoryController::class, 'changeStatus'])->name('sub-category.change-status');
Route::resource('sub-category', SubCategoryController::class);

/* ChildCategory Route */
Route::put('childcategory/changed-status', [ChildCategoryController::class, 'changeStatus'])->name('child-category.change-status');
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');
Route::resource('child-category', ChildCategoryController::class);