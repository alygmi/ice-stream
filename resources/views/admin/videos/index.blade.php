@extends('admin.layout')

@section('title', 'Videos')
@section('page-title', 'Videos Management')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div class="flex gap-3">
        <input type="text" id="searchInput" placeholder="Search videos..." class="px-4 py-2 rounded-lg bg-slate-800 border border-cyan-500/30 focus:border-cyan-400 focus:outline-none text-white placeholder-gray-500">
        <select id="categoryFilter" class="px-4 py-2 rounded-lg bg-slate-800 border border-cyan-500/30 focus:border-cyan-400 focus:outline-none text-white">
            <option value="">All Categories</option>
            @foreach($categories ?? [] as $cat)
                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
            @endforeach
        </select>
    </div>
    <a href="/admin/videos/create" class="bg-gradient-to-r from-cyan-600 to-cyan-500 hover:from-cyan-700 hover:to-cyan-600 px-6 py-2 rounded-lg font-semibold transition flex items-center gap-2">
        <span></span> Upload Video
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($videos as $video)
        <div class="group bg-gradient-to-br from-slate-800 to-slate-900 border border-cyan-500/20 rounded-xl overflow-hidden hover:border-cyan-400/60 hover:shadow-lg hover:shadow-cyan-500/20 transition">
            <!-- Video Thumbnail -->
            <div class="relative aspect-video bg-gradient-to-b from-blue-900/30 to-gray-900 flex items-center justify-center overflow-hidden">
                <span class="text-5xl"></span>
                <!-- Overlay on hover -->
                <div class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center gap-2">
                    <a href="/admin/videos/{{ $video->id }}/edit" class="bg-cyan-500 hover:bg-cyan-600 text-black rounded-full w-12 h-12 flex items-center justify-center transition font-bold text-lg"></a>
                    <a href="/admin/videos/{{ $video->id }}" class="text-cyan-400 hover:text-cyan-300 text-sm">View Details</a>
                </div>
            </div>

            <!-- Info -->
            <div class="p-5">
                <h3 class="font-semibold text-sm line-clamp-2 mb-2">{{ $video->title }}</h3>
                
                <div class="flex items-center gap-2 mb-3 text-xs text-gray-500">
                    <span> {{ gmdate("H:i:s", $video->duration) }}</span>
                    <span>•</span>
                    <span> {{ $video->created_at->format('M d') }}</span>
                </div>

                <div class="flex items-center gap-2 mb-4 flex-wrap">
                    <span class="bg-cyan-600/30 text-cyan-400 px-2 py-1 rounded text-xs font-semibold">
                        {{ $video->category->name ?? 'N/A' }}
                    </span>
                    @if($video->is_trending)
                        <span class="bg-red-600/30 text-red-400 px-2 py-1 rounded text-xs font-semibold">Trending</span>
                    @endif
                    <span class="bg-yellow-600/30 text-yellow-400 px-2 py-1 rounded text-xs font-semibold">⭐ {{ $video->rating ?? 0 }}</span>
                </div>

                <!-- Actions -->
                <div class="flex gap-2">
                    <a href="/admin/videos/{{ $video->id }}/edit" class="flex-1 bg-cyan-600 hover:bg-cyan-700 px-3 py-2 rounded text-sm font-semibold transition text-center">Edit</a>
                    <form action="/admin/videos/{{ $video->id }}" method="POST" class="flex-1" onsubmit="return confirm('Delete this video?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 px-3 py-2 rounded text-sm font-semibold transition">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-3 text-center py-12">
            <div class="text-5xl mb-4"></div>
            <p class="text-lg text-gray-400 mb-4">No videos found</p>
            <a href="/admin/videos/create" class="inline-block bg-cyan-600 hover:bg-cyan-700 px-6 py-3 rounded-lg font-semibold transition">
                Upload Your First Video
            </a>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<div class="mt-12">
    {{ $videos->links() }}
</div>

<script>
    // Simple search/filter
    document.getElementById('searchInput').addEventListener('keyup', function(e) {
        const value = e.target.value.toLowerCase();
        document.querySelectorAll('[data-video-title]').forEach(el => {
            el.parentElement.style.display = el.dataset.videoTitle.includes(value) ? '' : 'none';
        });
    });
</script>
@endsection