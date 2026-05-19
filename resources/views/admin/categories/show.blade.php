@extends("admin.layout")
@section("page_title", $category->name)
@section("content")
<div class="grid grid-cols-3 gap-6">
    <div class="col-span-2">
        <div class="bg-gray-800/30 border border-gray-700 rounded-lg p-6 mb-6">
            <h1 class="text-3xl font-bold mb-2">{{ $category->name }}</h1>
            <p class="text-gray-400">{{ $category->description ?? "No description" }}</p>
            <p class="text-sm text-gray-500 mt-4">{{ $category->videos_count }} video(s) in this category</p>
        </div>

        <h2 class="text-xl font-bold mb-4">Videos</h2>
        <div class="space-y-4">
            @forelse($videos as $video)
                <a href="{{ route("admin.videos.show", $video) }}" class="bg-gray-800/30 border border-gray-700 rounded-lg p-4 hover:border-cyan-600 transition flex items-center gap-4">
                    <div class="w-24 h-16 bg-gray-700 rounded flex-shrink-0 flex items-center justify-center text-xl">
                        @if($video->thumbnail)
                            <img src="{{ asset("storage/" . $video->thumbnail) }}" alt="" class="w-full h-full object-cover rounded">
                        @else
                            🎬
                        @endif
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold">{{ $video->title }}</h3>
                        <p class="text-xs text-gray-500 mt-1">{{ $video->created_at->format("M d, Y") }}</p>
                    </div>
                </a>
            @empty
                <p class="text-gray-400">No videos in this category</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $videos->withQueryString()->links() }}
        </div>
    </div>

    <div class="space-y-4">
        <a href="{{ route("admin.categories.edit", $category) }}" class="w-full bg-blue-600 hover:bg-blue-700 px-4 py-3 rounded-lg font-semibold transition text-center block">
            Edit
        </a>
        <form method="post" action="{{ route("admin.categories.destroy", $category) }}">
            @csrf
            @method("DELETE")
            <button type="submit" onclick="return confirm(\"Delete this category?\")" class="w-full bg-red-600/20 hover:bg-red-600/40 border border-red-600 px-4 py-3 rounded-lg font-semibold transition text-red-400">
                Delete
            </button>
        </form>
        <a href="{{ route("admin.categories.index") }}" class="w-full bg-gray-700 hover:bg-gray-600 px-4 py-3 rounded-lg font-semibold transition text-center block">
            Back to List
        </a>
    </div>
</div>
@endsection