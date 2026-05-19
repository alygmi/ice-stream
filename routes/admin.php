<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoManagementController;
use App\Http\Controllers\CategoryManagementController;

// Tambahkan middleware 'auth' dan 'role:admin' di sini
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Rute resource untuk manajemen data admin
    Route::resource('videos', VideoManagementController::class);
    Route::resource('categories', CategoryManagementController::class);
    
});