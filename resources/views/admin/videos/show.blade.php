@extends("admin.layout")
@section("page_title", $video->title)
@section("content")
<div class="max-w-7xl mx-auto space-y-6">
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
        <div>
            <h2 class="text-2xl font-bold">{{ $video->title }}</h2>
            <p class="text-gray-400">Video details and management actions.</p>
        </div>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('admin.videos.index') }}" class="bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-lg font-semibold transition">Back to List</a>
            <a href="{{ route('admin.videos.edit', $video) }}" class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg font-semibold transition">Edit Video</a>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-[2fr_1fr]">
        <div>
            <div class="bg-gray-800/30 border border-gray-700 rounded-lg overflow-hidden mb-6">
                <div class="aspect-video bg-gradient-to-b from-blue-900/40 to-gray-900 flex items-center justify-center relative">
                    @if($video->thumbnail)
                        <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }} thumbnail" class="absolute inset-0 w-full h-full object-cover">
                    @endif
                    <span class="text-6xl relative z-10">🎬</span>
                </div>
            </div>

            <h1 class="text-3xl font-bold mb-2">{{ $video->title }}</h1>
            <p class="text-gray-400 mb-6">{{ $video->description }}</p>

            <div class="bg-gray-800/30 border border-gray-700 rounded-lg p-6 space-y-4">
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <span class="text-gray-400 text-sm">Category</span>
                        <p class="text-cyan-400">{{ $video->category->name ?? 'Uncategorized' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-400 text-sm">Creator</span>
                        <p class="text-cyan-400">{{ $video->creator->name ?? '—' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-400 text-sm">Duration</span>
                        <p class="text-cyan-400">{{ $video->duration ? gmdate('H:i:s', $video->duration) : '—' }}</p>
                    </div>
                    <div>
                        <span class="text-gray-400 text-sm">Created</span>
                        <p class="text-cyan-400">{{ $video->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <a href="{{ route('admin.videos.edit', $video) }}" class="w-full bg-blue-600 hover:bg-blue-700 px-4 py-3 rounded-lg font-semibold transition text-center block">Edit</a>

            <form method="post" action="{{ route('admin.videos.destroy', $video) }}" class="w-full">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Delete this video?')" class="w-full bg-red-600/20 hover:bg-red-600/40 border border-red-600 px-4 py-3 rounded-lg font-semibold transition text-red-400">Delete</button>
            </form>

            <a href="{{ route('admin.videos.index') }}" class="w-full bg-gray-700 hover:bg-gray-600 px-4 py-3 rounded-lg font-semibold transition text-center block">Back to List</a>
        </div>
    </div>
</div>
@endsection