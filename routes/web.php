<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\Admin\DashboardController;

// =========================================================================
// RUTE PUBLIK & TAMU (Sebelum Login)
// =========================================================================

// Halaman login utama
Route::get('/', function () {
    // Jika sudah login, cegah melihat form login lagi, langsung arahkan sesuai role
    if (auth()->check()) {
        return auth()->user()->role === 'admin' 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('user.homepage');
    }
    return view('auth.login');
})->name('landing');

// Halaman informasi statis
Route::view('/about', 'pages.info', ['title' => 'About', 'heading' => 'About Ice Stream', 'body' => 'Ice Stream is a demo streaming...'])->name('about');
Route::view('/blog', 'pages.info', ['title' => 'Blog', 'heading' => 'Blog', 'body' => 'No posts yet...'])->name('blog');
Route::view('/help', 'pages.info', ['title' => 'Help Center', 'heading' => 'Help Center', 'body' => 'Need help?...'])->name('help');
Route::view('/support', 'pages.info', ['title' => 'Support', 'heading' => 'Support', 'body' => 'For technical support...'])->name('support');
Route::view('/privacy', 'pages.info', ['title' => 'Privacy', 'heading' => 'Privacy', 'body' => 'This demo app may store...'])->name('privacy');
Route::view('/terms', 'pages.info', ['title' => 'Terms', 'heading' => 'Terms of use', 'body' => 'Ice Stream is provided as-is...'])->name('terms');


// =========================================================================
// RUTE PROTEKSI AUTH (Wajib Login Terlebih Dahulu)
// =========================================================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // -----------------------------------------------------------------
    // RUTE KHUSUS ADMIN (Menggunakan RoleManager lewat alias 'role')
    // -----------------------------------------------------------------
    Route::middleware(['role:admin'])->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    });

    // -----------------------------------------------------------------
    // RUTE KHUSUS USER BIASA
    // -----------------------------------------------------------------
    Route::middleware(['role:user'])->group(function () {
        Route::get('/home', [HomeController::class, 'index'])->name('user.homepage');
        Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
        Route::get('/videos/{id}', [VideoController::class, 'show'])->name('videos.show');
        Route::get('/my-list', [VideoController::class, 'myList'])->name('my-list');
    });

    // Akses universal (Admin & User)
    Route::post('/videos/{id}/favorite', [VideoController::class, 'toggleFavorite'])->name('videos.favorite');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// =========================================================================
// BERKAS RUTE EKSTERNAL
// =========================================================================
require __DIR__.'/auth.php';  
require __DIR__.'/admin.php';