<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show($id){
        // fetch video dengan category
        $video = Video::with('category', 'creator')->findOrFail($id);

        // Related videos dari category yang sama (exclude current video)
        $relatedVideos = Video::where('category_id', $video->category_id)
            ->where('id', '!=', $video->id)
            ->limit(6)
            ->get();

        return view('videos.watch', [
            'video' => $video,
            'relatedVideos' => $relatedVideos,
        ]);
    }

    public function index(Request $request){
        $query = Video::with('category', 'creator');

        // filter by category
        if ($request->category){
            $query->where('category_id', $request->category);
        }

        // search
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $videos = $query->latest()->paginate(12);
        $categories = \App\Models\Category::all();

        return view('videos.index', [
            'videos' => $videos,
            'categories' => $categories
        ]);
    }
}

