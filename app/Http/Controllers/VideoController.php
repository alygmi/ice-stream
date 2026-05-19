<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Tambahkan ini di atas

class VideoController extends Controller
{
    public function show(int|string $id){
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

    /**
     * Fitur Tambah/Hapus Favorites (Web Version)
     */
    public function toggleFavorite(int|string $id)
    {
        if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'You must be logged in to do that.');
        }

        $video = Video::findOrFail($id);
        
        /** @var \App\Models\User $user */
        $user = Auth::user(); // Komentar di atas memberi tahu VS Code tipe data pastinya

        // Sekarang Intelephense dijamin tidak akan protes lagi
        $user->favoriteVideos()->toggle($video->id);

        $isFavorite = $user->favoriteVideos()->where('video_id', $video->id)->exists();
        $message = $isFavorite ? 'Video added to your My List!' : 'Video removed from your My List!';

        return redirect()->back()->with('success', $message);
    }

    public function myList()
    {
        // Beri proteksi jika diakses lewat URL tanpa login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        $favoriteVideos = $user->favoriteVideos()->with('category')->latest()->get();

        return view('my-list', compact('favoriteVideos'));
    }
}