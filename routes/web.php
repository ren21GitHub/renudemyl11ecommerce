<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// require __DIR__.'/admin.php';
// require __DIR__.'/vendor.php';

Route::get('admin/login', [AdminController::class, 'login'])->middleware('guest')->name('admin.login');


// Route::get('/dashboard', function () {
//     return view('frontend.dashboard.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['middleware' => ['auth', 'verified'],
               'prefix' => 'user',
               'name' => 'user.'             
            ], function(){
                Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

            });