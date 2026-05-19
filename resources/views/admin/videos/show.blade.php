@extends('admin.layout')

@section('title', $video->title)
@section('page-title', 'Video Details')

@section('content')
<div class="grid grid-cols-3 gap-8">
    <!-- Main Info -->
    <div class="col-span-2">
        <!-- Video Preview -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-cyan-500/30 rounded-xl overflow-hidden mb-6">
            <div class="aspect-video bg-gradient-to-b from-blue-900/30 to-gray-900 flex items-center justify-center">
                <span class="text-7xl"></span>
            </div>
        </div>

        <!-- Info Card -->
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-cyan-500/30 rounded-xl p-6 space-y-4">
            <div>
                <h2 class="text-2xl font-bold mb-2">{{ $video->title }}</h2>
                <p class="text-gray-400">{{ $video->description }}</p>
            </div>

            <div class="grid grid-cols-2 gap-4 py-4 border-t border-cyan-500/20">
                <div>
                    <p class="text-gray-500 text-sm">Created By</p>
                    <p class="text-white font-semibold">{{ $video->creator->name ?? 'Unknown' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Category</p>
                    <p class="text-cyan-400 font-semibold">{{ $video->category->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Duration</p>
                    <p class="text-white font-semibold">{{ gmdate("H:i:s", $video->duration) }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Rating</p>
                    <p class="text-white font-semibold">⭐ {{ $video->rating ?? 0 }}/10</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Uploaded</p>
                    <p class="text-white font-semibold">{{ $video->created_at->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Status</p>
                    <p class="text-white font-semibold">
                        @if($video->is_trending)
                            <span class="bg-red-600/30 text-red-400 px-2 py-1 rounded text-sm">Trending</span>
                        @else
                            <span class="bg-gray-600/30 text-gray-400 px-2 py-1 rounded text-sm">Regular</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Sidebar -->
    <div class="space-y-4">
        <a href="/admin/videos/{{ $video->id }}/edit" class="block w-full bg-gradient-to-r from-cyan-600 to-cyan-500 hover:from-cyan-700 hover:to-cyan-600 px-6 py-3 rounded-lg font-semibold transition text-center">
            Edit Video
        </a>
        <a href="/videos/{{ $video->id }}" target="_blank" class="block w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 px-6 py-3 rounded-lg font-semibold transition text-center">
            Watch Video
        </a>
        <form action="/admin/videos/{{ $video->id }}" method="POST" onsubmit="return confirm('Delete this video?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 px-6 py-3 rounded-lg font-semibold transition">
                 Delete Video
            </button>
        </form>
        <a href="/admin/videos" class="block w-full bg-slate-700 hover:bg-slate-600 px-6 py-3 rounded-lg font-semibold transition text-center">
            ← Back to Videos
        </a>
    </div>
</div>
@endsection