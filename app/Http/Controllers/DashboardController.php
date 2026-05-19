<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'total_videos' => Video::count(),
            'total_categories' => Category::count(),
            'recent_videos' => Video::with('category', 'creator')->latest()->limit(8)->get(),
        ]);
    }
}
