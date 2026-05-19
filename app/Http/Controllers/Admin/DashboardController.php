<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Category;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Mengembalikan view admin yang berada di resources/views/admin/dashboard.blade.php
        return view('admin.dashboard', [
            // UBAH DI SINI: Sesuaikan dengan nama variabel di Blade ($totalVideos)
            'totalVideos' => Video::count(),
            
            // UBAH DI SINI: Sesuaikan dengan nama variabel di Blade ($totalCategories)
            'totalCategories' => Category::count(),
            
            // Tambahkan juga variabel ini jika di Blade membutuhkan data trending & avg rating
            'trendingVideos' => Video::where('is_trending', true)->count(),
            'avgRating' => Video::avg('rating') ?? 0,
            
            // Sesuaikan limit dengan kebutuhan UI dashboard Anda (di blade terdisplay 3 grid)
            'recentVideos' => Video::with('category')->latest()->limit(3)->get(),
        ]);
    }
}