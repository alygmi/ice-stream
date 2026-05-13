<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

Route::get('/', [App\Http\Controllers\LandingController::class, 'index'])->name('landing');

Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/{id}', [VideoController::class, 'show'])->name('videos.show');

Route::view('/my-list', 'my-list')->name('my-list');

Route::view('/about', 'pages.info', [
    'title' => 'About',
    'heading' => 'About Ice Stream',
    'body' => 'Ice Stream is a demo streaming-style experience for browsing and watching videos. This page is here so the footer and navigation links on the home page go somewhere useful.',
])->name('about');

Route::view('/blog', 'pages.info', [
    'title' => 'Blog',
    'heading' => 'Blog',
    'body' => 'No posts yet. Check back later, or head to Browse to watch something now.',
])->name('blog');

Route::view('/help', 'pages.info', [
    'title' => 'Help Center',
    'heading' => 'Help Center',
    'body' => 'Need help? Use Browse to find a title, open it, and press play (you may need to sign in). For account issues, contact your administrator.',
])->name('help');

Route::view('/support', 'pages.info', [
    'title' => 'Support',
    'heading' => 'Support',
    'body' => 'For technical support, describe what you were doing and what you expected to happen. You can continue exploring from the home page or Browse.',
])->name('support');

Route::view('/privacy', 'pages.info', [
    'title' => 'Privacy',
    'heading' => 'Privacy',
    'body' => 'This demo app may store basic account and session data needed to sign you in. Do not upload sensitive personal content unless you trust this environment.',
])->name('privacy');

Route::view('/terms', 'pages.info', [
    'title' => 'Terms',
    'heading' => 'Terms of use',
    'body' => 'Ice Stream is provided as-is for demonstration. Content and availability are not guaranteed. Use responsibly and in line with your local laws.',
])->name('terms');

require __DIR__.'/auth.php';
