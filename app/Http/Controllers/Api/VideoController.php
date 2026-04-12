<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoController extends Controller
{
    //
    public function index()
    {
        return Video::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4,mov,avi,wmv|max:30000', // max 30MB
        ]);

        // ambil video dari request
        $file = $request->file('video');

        // simpan video ke storage/app/public/videos
        $path = $file->store('videos', 'public');

        // $video = new Video();
        // $video->title = $request->title;
        // $video->description = $request->description;
        // $video->created_by = auth()->id();

        // if ($request->hasFile('thumbnail')) {
        //     $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        //     $video->thumbnail = $thumbnailPath;
        // }

        // if ($request->hasFile('video')) {
        //     $videoPath = $request->file('video')->store('videos', 'public');
        //     $video->video_path = $videoPath;
        //     // Optionally, you can calculate and store the video duration here
        // }

        // $video->save();

        // return response()->json($video, 201);
        // simpan data video ke database
        $video = Video::create([
            'title' => $request->title,
            'video_path' => $path,
            'created_by' => auth()->id()
        ]);

        return response()->json($video, 201);
    }
}
