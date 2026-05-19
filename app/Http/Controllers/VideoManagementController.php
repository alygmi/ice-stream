<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class VideoManagementController
{
    public function index(Request $request): View
    {
        $query = Video::with('category', 'creator');

        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $videos = $query->latest()->paginate(15);
        $categories = Category::all();

        return view('admin.videos.index', [
            'videos' => $videos,
            'categories' => $categories,
        ]);
    }

    public function create(): View
    {
        return view('admin.videos.create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'duration' => 'nullable|integer',
            'video' => 'nullable|file|mimes:mp4,avi,mkv,mov',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle video upload
        if ($request->hasFile('video')) {
            $videoPath = $request->file('video')->store('videos', 'public');
            $validated['video_path'] = $videoPath;
        }

        // Handle thumbnail upload
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $validated['thumbnail'] = $thumbnailPath;
        }

        $validated['created_by'] = auth()->id();

        Video::create($validated);

        return redirect()->route('admin.videos.index')
                       ->with('success', 'Video created successfully.');
    }

    public function show(Video $video): View
    {
        return view('admin.videos.show', [
            'video' => $video->load('category', 'creator'),
        ]);
    }

    public function edit(Video $video): View
    {
        return view('admin.videos.edit', [
            'video' => $video,
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, Video $video): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
            'duration' => 'nullable|integer',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_trending' => 'nullable|boolean',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            $validated['thumbnail'] = $thumbnailPath;
        }

        $video->update($validated);

        return redirect()->route('admin.videos.show', $video)
                       ->with('success', 'Video updated successfully.');
    }

    public function destroy(Video $video): RedirectResponse
    {
        $video->delete();

        return redirect()->route('admin.videos.index')
                       ->with('success', 'Video deleted successfully.');
    }
}
