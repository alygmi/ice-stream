<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class LandingController extends Controller
{
    public function index()
    {
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

        return view('landing', [
            'trendingVideos' => $trendingVideos,
            'newVideos' => $newVideos,
            'topRatedVideos' => $topRatedVideos,
        ]);
    }
}