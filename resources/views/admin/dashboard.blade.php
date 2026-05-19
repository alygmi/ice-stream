@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', ' Dashboard')

@section('content')
<div class="grid grid-cols-4 gap-6 mb-12">
    <!-- Stats Cards -->
    <div class="bg-gradient-to-br from-cyan-600/20 to-cyan-900/20 border border-cyan-500/30 rounded-xl p-6 hover:border-cyan-400/60 transition">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-400 text-sm font-semibold">Total Videos</h3>
            <span class="text-2xl"></span>
        </div>
        <p class="text-3xl font-bold">{{ $totalVideos ?? 0 }}</p>
        <p class="text-cyan-400 text-xs mt-2">All videos in system</p>
    </div>

    <div class="bg-gradient-to-br from-blue-600/20 to-blue-900/20 border border-blue-500/30 rounded-xl p-6 hover:border-blue-400/60 transition">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-400 text-sm font-semibold">Categories</h3>
            <span class="text-2xl"></span>
        </div>
        <p class="text-3xl font-bold">{{ $totalCategories ?? 0 }}</p>
        <p class="text-blue-400 text-xs mt-2">Content categories</p>
    </div>

    <div class="bg-gradient-to-br from-purple-600/20 to-purple-900/20 border border-purple-500/30 rounded-xl p-6 hover:border-purple-400/60 transition">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-400 text-sm font-semibold">Trending</h3>
            <span class="text-2xl"></span>
        </div>
        <p class="text-3xl font-bold">{{ $trendingVideos ?? 0 }}</p>
        <p class="text-purple-400 text-xs mt-2">Trending videos</p>
    </div>

    <div class="bg-gradient-to-br from-green-600/20 to-green-900/20 border border-green-500/30 rounded-xl p-6 hover:border-green-400/60 transition">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-gray-400 text-sm font-semibold">Avg Rating</h3>
            <span class="text-2xl"></span>
        </div>
        <p class="text-3xl font-bold">{{ number_format($avgRating ?? 0, 1) }}</p>
        <p class="text-green-400 text-xs mt-2">Average rating</p>
    </div>
</div>

<!-- Quick Actions -->
<div class="mb-12">
    <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
    <div class="grid grid-cols-3 gap-4">
        <a href="/admin/videos/create" class="bg-gradient-to-r from-cyan-600 to-cyan-500 hover:from-cyan-700 hover:to-cyan-600 px-6 py-3 rounded-lg font-semibold transition flex items-center justify-center gap-2">
            <span></span> Upload Video
        </a>
        <a href="/admin/categories" class="bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 px-6 py-3 rounded-lg font-semibold transition flex items-center justify-center gap-2">
            <span></span> Manage Categories
        </a>
        <a href="/admin/videos" class="bg-gradient-to-r from-purple-600 to-purple-500 hover:from-purple-700 hover:to-purple-600 px-6 py-3 rounded-lg font-semibold transition flex items-center justify-center gap-2">
            <span></span> All Videos
        </a>
    </div>
</div>

<!-- Recent Videos -->
<div>
    <h2 class="text-xl font-bold mb-4">Recent Videos</h2>
    <div class="grid grid-cols-3 gap-6">
        @forelse($recentVideos ?? [] as $video)
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-cyan-500/20 rounded-lg overflow-hidden hover:border-cyan-400/60 transition group">
                <div class="aspect-video bg-gradient-to-b from-blue-900/30 to-gray-900 flex items-center justify-center relative overflow-hidden">
                    <span class="text-4xl">🎬</span>
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2">
                        <a href="/admin/videos/{{ $video->id }}/edit" class="bg-cyan-500 hover:bg-cyan-600 text-black rounded px-3 py-2 text-sm font-semibold transition">Edit</a>
                        <a href="/admin/videos/{{ $video->id }}" class="bg-blue-500 hover:bg-blue-600 text-black rounded px-3 py-2 text-sm font-semibold transition">View</a>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold truncate text-sm">{{ $video->title }}</h3>
                    <p class="text-xs text-gray-500 mt-1">
                        {{ $video->created_at->format('M d, Y') }}
                    </p>
                    <div class="flex items-center gap-2 mt-3 text-xs">
                        <span class="bg-cyan-600/30 text-cyan-400 px-2 py-1 rounded">
                            {{ $video->category->name ?? 'N/A' }}
                        </span>
                        @if($video->is_trending)
                            <span class="bg-red-600/30 text-red-400 px-2 py-1 rounded">🔥 Trending</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-3 text-center py-12 text-gray-500">
                <p class="text-lg">No videos yet</p>
                <p class="text-sm">Start by <a href="/admin/videos/create" class="text-cyan-400 hover:text-cyan-300">uploading a video</a></p>
            </div>
        @endforelse
    </div>
</div>
@endsection