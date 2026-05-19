<?php
/**
 * Admin Views Generator
 * This script creates all admin blade view files
 * Run: php generate-views.php
 */

$views = [
    'admin/layout.blade.php' => '@yield("content")',
    'admin/dashboard.blade.php' => '@extends("admin.layout")
@section("page_title", "Dashboard")
@section("content")
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-6">
        <div class="text-gray-400 text-sm font-medium">Total Videos</div>
        <div class="text-4xl font-bold text-cyan-400 mt-2">{{ $total_videos }}</div>
    </div>
    <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-6">
        <div class="text-gray-400 text-sm font-medium">Total Categories</div>
        <div class="text-4xl font-bold text-cyan-400 mt-2">{{ $total_categories }}</div>
    </div>
    <div class="bg-gray-800/50 border border-gray-700 rounded-lg p-6">
        <div class="text-gray-400 text-sm font-medium">Admin</div>
        <div class="text-4xl font-bold text-cyan-400 mt-2">{{ auth()->user()->name }}</div>
    </div>
</div>

<h2 class="text-xl font-bold mb-4">Recent Videos</h2>
<div class="grid gap-4">
    @forelse($recent_videos as $video)
        <a href="{{ route("admin.videos.show", $video) }}" class="bg-gray-800/50 border border-gray-700 rounded-lg p-4 hover:border-cyan-600 transition flex items-center gap-4">
            <div class="w-24 h-16 bg-gray-700 rounded flex-shrink-0 flex items-center justify-center text-2xl">
                @if($video->thumbnail)
                    <img src="{{ asset("storage/" . $video->thumbnail) }}" alt="" class="w-full h-full object-cover rounded">
                @else
                    🎬
                @endif
            </div>
            <div class="flex-1">
                <h3 class="font-semibold text-cyan-400">{{ $video->title }}</h3>
                <p class="text-xs text-gray-400 mt-1">{{ $video->category->name ?? "Uncategorized" }}</p>
            </div>
            <span class="text-xs text-gray-500">{{ $video->created_at->format("M d, Y") }}</span>
        </a>
    @empty
        <p class="text-gray-400">No videos yet</p>
    @endforelse
</div>
@endsection',

    'admin/videos/index.blade.php' => '@extends("admin.layout")
@section("page_title", "Videos Management")
@section("content")
<div class="flex justify-between items-center mb-8">
    <div></div>
    <a href="{{ route("admin.videos.create") }}" class="bg-cyan-600 hover:bg-cyan-700 px-4 py-2 rounded-lg font-semibold transition">
        + Add Video
    </a>
</div>

<div class="mb-6 flex gap-4">
    <form method="get" class="flex gap-2 flex-1">
        <input type="search" name="search" value="{{ request("search") }}" placeholder="Search videos..." class="flex-1 bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white placeholder-gray-500 focus:border-cyan-500 focus:outline-none">
        <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 px-4 py-2 rounded-lg transition">Search</button>
    </form>
</div>

<div class="bg-gray-800/30 border border-gray-700 rounded-lg overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-900 border-b border-gray-700">
            <tr>
                <th class="text-left px-6 py-4 text-sm font-semibold">Title</th>
                <th class="text-left px-6 py-4 text-sm font-semibold">Category</th>
                <th class="text-left px-6 py-4 text-sm font-semibold">Creator</th>
                <th class="text-left px-6 py-4 text-sm font-semibold">Date</th>
                <th class="text-right px-6 py-4 text-sm font-semibold">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
            @forelse($videos as $video)
                <tr class="hover:bg-gray-800/50 transition">
                    <td class="px-6 py-4 text-sm">{{ $video->title }}</td>
                    <td class="px-6 py-4 text-sm text-gray-400">{{ $video->category->name ?? "—" }}</td>
                    <td class="px-6 py-4 text-sm text-gray-400">{{ $video->creator->name ?? "—" }}</td>
                    <td class="px-6 py-4 text-sm text-gray-400">{{ $video->created_at->format("M d, Y") }}</td>
                    <td class="px-6 py-4 text-right text-sm space-x-2">
                        <a href="{{ route("admin.videos.show", $video) }}" class="text-cyan-400 hover:text-cyan-300">View</a>
                        <a href="{{ route("admin.videos.edit", $video) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                        <form method="post" action="{{ route("admin.videos.destroy", $video) }}" class="inline">
                            @csrf
                            @method("DELETE")
                            <button type="submit" onclick="return confirm(\"Delete this video?\")" class="text-red-400 hover:text-red-300">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">No videos found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $videos->withQueryString()->links() }}
</div>
@endsection',

    'admin/videos/create.blade.php' => '@extends("admin.layout")
@section("page_title", "Create Video")
@section("content")
<div class="max-w-2xl">
    <form method="post" action="{{ route("admin.videos.store") }}" enctype="multipart/form-data" class="bg-gray-800/30 border border-gray-700 rounded-lg p-6 space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-2">Title *</label>
            <input type="text" name="title" value="{{ old("title") }}" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white placeholder-gray-600 focus:border-cyan-500 focus:outline-none">
            @error("title") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Description *</label>
            <textarea name="description" rows="4" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white placeholder-gray-600 focus:border-cyan-500 focus:outline-none">{{ old("description") }}</textarea>
            @error("description") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Category</label>
                <select name="category_id" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
                    <option value="">— Select Category —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old("category_id") == $cat->id ? "selected" : "" }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error("category_id") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Duration (seconds)</label>
                <input type="number" name="duration" value="{{ old("duration") }}" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
                @error("duration") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Thumbnail (Image)</label>
            <input type="file" name="thumbnail" accept="image/*" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-gray-400 file:bg-cyan-600 file:border-0 file:rounded file:px-3 file:py-1 file:text-white cursor-pointer">
            @error("thumbnail") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Video File (MP4, AVI, MKV, MOV)</label>
            <input type="file" name="video" accept="video/*" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-gray-400 file:bg-cyan-600 file:border-0 file:rounded file:px-3 file:py-1 file:text-white cursor-pointer">
            @error("video") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 px-6 py-2 rounded-lg font-semibold transition">Create Video</button>
            <a href="{{ route("admin.videos.index") }}" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg transition">Cancel</a>
        </div>
    </form>
</div>
@endsection',

    'admin/videos/show.blade.php' => '@extends("admin.layout")
@section("page_title", $video->title)
@section("content")
<div class="grid grid-cols-3 gap-6">
    <div class="col-span-2">
        <div class="bg-gray-800/30 border border-gray-700 rounded-lg overflow-hidden mb-6">
            <div class="aspect-video bg-gradient-to-b from-blue-900/40 to-gray-900 flex items-center justify-center relative">
                @if($video->thumbnail)
                    <img src="{{ asset("storage/" . $video->thumbnail) }}" alt="" class="absolute inset-0 w-full h-full object-cover">
                @endif
                <span class="text-6xl relative z-10">🎬</span>
            </div>
        </div>

        <h1 class="text-3xl font-bold mb-2">{{ $video->title }}</h1>
        <p class="text-gray-400 mb-6">{{ $video->description }}</p>

        <div class="bg-gray-800/30 border border-gray-700 rounded-lg p-6 space-y-4 mb-6">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <span class="text-gray-400 text-sm">Category</span>
                    <p class="text-cyan-400">{{ $video->category->name ?? "Uncategorized" }}</p>
                </div>
                <div>
                    <span class="text-gray-400 text-sm">Creator</span>
                    <p class="text-cyan-400">{{ $video->creator->name ?? "—" }}</p>
                </div>
                <div>
                    <span class="text-gray-400 text-sm">Duration</span>
                    <p class="text-cyan-400">{{ $video->duration ? gmdate("H:i:s", $video->duration) : "—" }}</p>
                </div>
                <div>
                    <span class="text-gray-400 text-sm">Created</span>
                    <p class="text-cyan-400">{{ $video->created_at->format("M d, Y") }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <a href="{{ route("admin.videos.edit", $video) }}" class="w-full bg-blue-600 hover:bg-blue-700 px-4 py-3 rounded-lg font-semibold transition text-center block">
            Edit
        </a>
        <form method="post" action="{{ route("admin.videos.destroy", $video) }}">
            @csrf
            @method("DELETE")
            <button type="submit" onclick="return confirm(\"Delete this video?\")" class="w-full bg-red-600/20 hover:bg-red-600/40 border border-red-600 px-4 py-3 rounded-lg font-semibold transition text-red-400">
                Delete
            </button>
        </form>
        <a href="{{ route("admin.videos.index") }}" class="w-full bg-gray-700 hover:bg-gray-600 px-4 py-3 rounded-lg font-semibold transition text-center block">
            Back to List
        </a>
    </div>
</div>
@endsection',

    'admin/videos/edit.blade.php' => '@extends("admin.layout")
@section("page_title", "Edit Video")
@section("content")
<div class="max-w-2xl">
    <form method="post" action="{{ route("admin.videos.update", $video) }}" enctype="multipart/form-data" class="bg-gray-800/30 border border-gray-700 rounded-lg p-6 space-y-6">
        @csrf
        @method("PUT")

        <div>
            <label class="block text-sm font-medium mb-2">Title *</label>
            <input type="text" name="title" value="{{ old("title", $video->title) }}" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
            @error("title") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Description *</label>
            <textarea name="description" rows="4" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">{{ old("description", $video->description) }}</textarea>
            @error("description") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Category</label>
                <select name="category_id" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
                    <option value="">— Select Category —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old("category_id", $video->category_id) == $cat->id ? "selected" : "" }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error("category_id") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Duration (seconds)</label>
                <input type="number" name="duration" value="{{ old("duration", $video->duration) }}" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
                @error("duration") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Thumbnail (Image)</label>
            @if($video->thumbnail)
                <p class="text-sm text-gray-400 mb-2">Current: {{ $video->thumbnail }}</p>
            @endif
            <input type="file" name="thumbnail" accept="image/*" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-gray-400 file:bg-cyan-600 file:border-0 file:rounded file:px-3 file:py-1 file:text-white cursor-pointer">
            @error("thumbnail") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_trending" {{ old("is_trending", $video->is_trending) ? "checked" : "" }} class="rounded border-gray-600 bg-gray-900">
                <span class="text-sm">Mark as Trending</span>
            </label>
            <div>
                <label class="block text-sm font-medium mb-2">Rating (0-5)</label>
                <input type="number" name="rating" step="0.1" min="0" max="5" value="{{ old("rating", $video->rating) }}" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
            </div>
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 px-6 py-2 rounded-lg font-semibold transition">Update Video</button>
            <a href="{{ route("admin.videos.show", $video) }}" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg transition">Cancel</a>
        </div>
    </form>
</div>
@endsection',

    'admin/categories/index.blade.php' => '@extends("admin.layout")
@section("page_title", "Categories Management")
@section("content")
<div class="flex justify-between items-center mb-8">
    <div></div>
    <a href="{{ route("admin.categories.create") }}" class="bg-cyan-600 hover:bg-cyan-700 px-4 py-2 rounded-lg font-semibold transition">
        + Add Category
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($categories as $category)
        <a href="{{ route("admin.categories.show", $category) }}" class="bg-gray-800/30 border border-gray-700 rounded-lg p-6 hover:border-cyan-600 transition">
            <h3 class="text-lg font-bold text-cyan-400 mb-2">{{ $category->name }}</h3>
            <p class="text-sm text-gray-400 mb-4">{{ $category->description ?? "No description" }}</p>
            <p class="text-xs text-gray-500">{{ $category->videos_count }} video(s)</p>
            <div class="mt-4 flex gap-2">
                <a href="{{ route("admin.categories.edit", $category) }}" class="text-blue-400 hover:text-blue-300 text-sm">Edit</a>
                <form method="post" action="{{ route("admin.categories.destroy", $category) }}" class="inline">
                    @csrf
                    @method("DELETE")
                    <button type="submit" onclick="return confirm(\"Delete this category?\")" class="text-red-400 hover:text-red-300 text-sm">Delete</button>
                </form>
            </div>
        </a>
    @empty
        <p class="col-span-full text-center text-gray-400 py-12">No categories found</p>
    @endforelse
</div>

<div class="mt-6">
    {{ $categories->withQueryString()->links() }}
</div>
@endsection',

    'admin/categories/create.blade.php' => '@extends("admin.layout")
@section("page_title", "Create Category")
@section("content")
<div class="max-w-2xl">
    <form method="post" action="{{ route("admin.categories.store") }}" class="bg-gray-800/30 border border-gray-700 rounded-lg p-6 space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-2">Name *</label>
            <input type="text" name="name" value="{{ old("name") }}" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white placeholder-gray-600 focus:border-cyan-500 focus:outline-none">
            @error("name") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white placeholder-gray-600 focus:border-cyan-500 focus:outline-none">{{ old("description") }}</textarea>
            @error("description") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 px-6 py-2 rounded-lg font-semibold transition">Create Category</button>
            <a href="{{ route("admin.categories.index") }}" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg transition">Cancel</a>
        </div>
    </form>
</div>
@endsection',

    'admin/categories/show.blade.php' => '@extends("admin.layout")
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
@endsection',

    'admin/categories/edit.blade.php' => '@extends("admin.layout")
@section("page_title", "Edit Category")
@section("content")
<div class="max-w-2xl">
    <form method="post" action="{{ route("admin.categories.update", $category) }}" class="bg-gray-800/30 border border-gray-700 rounded-lg p-6 space-y-6">
        @csrf
        @method("PUT")

        <div>
            <label class="block text-sm font-medium mb-2">Name *</label>
            <input type="text" name="name" value="{{ old("name", $category->name) }}" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
            @error("name") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Description</label>
            <textarea name="description" rows="4" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">{{ old("description", $category->description) }}</textarea>
            @error("description") <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 px-6 py-2 rounded-lg font-semibold transition">Update Category</button>
            <a href="{{ route("admin.categories.show", $category) }}" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg transition">Cancel</a>
        </div>
    </form>
</div>
@endsection',
];

echo "Creating admin view files...\n";
$basePath = dirname(__FILE__) . "/resources/views";

foreach ($views as $path => $content) {
    $fullPath = $basePath . "/" . $path;
    $dir = dirname($fullPath);

    // Create directory
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
        echo "✓ Directory: $dir\n";
    }

    // Create file
    file_put_contents($fullPath, $content);
    echo "✓ Created: $path\n";
}

echo "\n✓ All admin view files created successfully!\n";
