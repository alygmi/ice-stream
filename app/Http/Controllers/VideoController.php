<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function show($id){
        // fetch video dengan category
        $video = Video::with(['category', 'creator'])->findOrFail($id);

        // Related: same category when set; otherwise latest other videos
        $relatedQuery = Video::query()->where('id', '!=', $video->id);
        if ($video->category_id) {
            $relatedQuery->where('category_id', $video->category_id);
        }
        $relatedVideos = $relatedQuery->latest()->limit(6)->get();

        return view('videos.watch', [
            'video' => $video,
            'relatedVideos' => $relatedVideos,
        ]);
    }

    public function index(Request $request){
        $query = Video::with('category');

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

