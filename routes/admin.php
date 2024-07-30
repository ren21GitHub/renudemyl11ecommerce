<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Models\ProductVariant;
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

/* Brand Route */
Route::put('brand/changed-status', [BrandController::class, 'changeStatus'])->name('brand.change-status');
Route::resource('brand', BrandController::class);

/* Vendor Profile Route */
Route::put('vendor-profile/changed-status', [AdminVendorProfileController::class, 'changeStatus'])->name('vendor-profile.change-status');
Route::resource('vendor-profile', AdminVendorProfileController::class);

/* Product Route */
Route::put('products/changed-status', [ProductController::class, 'changeStatus'])->name('products.change-status');
Route::get('products/get-subcategories', [ProductController::class, 'getSubCategories'])->name('products.get-subcategories');
Route::get('products/get-childcategories', [ProductController::class, 'getChildCategories'])->name('products.get-childcategories');
Route::resource('products', ProductController::class);
/* Product Image Gallery Route */
Route::resource('products-image-gallery', ProductImageGalleryController::class);
/* Product Variant Route */
Route::put('products-variant/changed-status', [ProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', ProductVariantController::class);
/* Product Variant Item Route */
Route::get('products-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-item.index');
Route::get('products-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-item.create');
Route::post('products-variant-item', [ProductVariantItemController::class, 'store'])->name('products-variant-item.store');
Route::put('products-variant-item/changed-status', [ProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.change-status');
Route::get('products-variant-item-edit/{variantItemId}', [ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
Route::put('products-variant-item-update/{variantItemId}', [ProductVariantItemController::class, 'update'])->name('products-variant-item.update');
Route::delete('products-variant-item/{variantItemId}', [ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');