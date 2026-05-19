<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VideoManagementController;
use App\Http\Controllers\CategoryManagementController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('videos', VideoManagementController::class);
    Route::resource('categories', CategoryManagementController::class);
});
