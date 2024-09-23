<?php

use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use Illuminate\Support\Facades\Route;


/* VENDOR ROUTES */
// 1ST WAY TO CREATE A ROUTE
// Route::get('vendor/dashboard', [VendorController::class, 'dashboard'])->middleware(['auth','role:vendor'])->name('vendor.dashboard');

// 2ND WAY
Route::get('dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('profile/update', [VendorProfileController::class, 'updateVendorProfile'])->name('profile.update');
Route::put('profile/update/password', [VendorProfileController::class, 'updateVendorPassword'])->name('password.update');

/* Vendor Shop Profile Routes*/
Route::resource('shop-profile', VendorShopProfileController::class);

/* Vendor Products Routes */
Route::put('products/changed-status', [VendorProductController::class, 'changeStatus'])->name('products.change-status');
Route::get('products/get-subcategories', [VendorProductController::class, 'getSubCategories'])->name('products.get-subcategories');
Route::get('products/get-childcategories', [VendorProductController::class, 'getChildCategories'])->name('products.get-childcategories');
Route::resource('products', VendorProductController::class);

/* Vendor Products Image Gallery Routes */
Route::resource('products-image-gallery', VendorProductImageGalleryController::class);

/* Product Variant Route */
Route::put('products-variant/changed-status', [VendorProductVariantController::class, 'changeStatus'])->name('products-variant.change-status');
Route::resource('products-variant', VendorProductVariantController::class);

/* Product Variant Item Route*/
Route::get('products-variant-item/{productId}/{variantId}', [VendorProductVariantItemController::class, 'index'])->name('products-variant-item.index');
Route::get('products-variant-item/create/{productId}/{variantId}', [VendorProductVariantItemController::class, 'create'])->name('products-variant-item.create');
Route::post('products-variant-item', [VendorProductVariantItemController::class, 'store'])->name('products-variant-item.store');
Route::put('products-variant-item/changed-status', [VendorProductVariantItemController::class, 'changeStatus'])->name('products-variant-item.change-status');
Route::get('products-variant-item-edit/{variantItemId}', [VendorProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
Route::put('products-variant-item-update/{variantItemId}', [VendorProductVariantItemController::class, 'update'])->name('products-variant-item.update');
Route::delete('products-variant-item/{variantItemId}', [VendorProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');