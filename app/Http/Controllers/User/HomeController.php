<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; // Ditambahkan karena berada di dalam sub-folder
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Logika query video tetap sama seperti LandingController lama Anda
        $trendingVideos = Video::where('is_trending', true)
            ->latest('created_at')
            ->limit(10)
            ->get();

        $newVideos = Video::latest('created_at')
            ->limit(8)
            ->get();

        $topRatedVideos = Video::orderBy('rating', 'desc')
            ->limit(6)
            ->get();

        $startVideo = $trendingVideos->first()
            ?? $newVideos->first()
            ?? $topRatedVideos->first();

        // Diarahkan ke view user/home.blade.php yang bertindak sebagai homepage user setelah login
        return view('landing', [
        'trendingVideos' => $trendingVideos,
        'newVideos' => $newVideos,
        'topRatedVideos' => $topRatedVideos,
        'startVideo' => $startVideo,
    ]);
    }
}