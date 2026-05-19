@extends("admin.layout")
@section("page_title", "Edit Video")
@section("content")
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold">Edit Video</h2>
            <p class="text-gray-400">Update the video metadata, category, or media file.</p>
        </div>
        <a href="{{ route('admin.videos.show', $video) }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">View Video</a>
    </div>

    <form method="post" action="{{ route('admin.videos.update', $video) }}" enctype="multipart/form-data" class="bg-gray-800/30 border border-gray-700 rounded-lg p-6 space-y-6">
        @csrf
        @method("PUT")

        <div>
            <label class="block text-sm font-medium mb-2">Title *</label>
            <input type="text" name="title" value="{{ old('title', $video->title) }}" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
            @error('title') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Description *</label>
            <textarea name="description" rows="4" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">{{ old('description', $video->description) }}</textarea>
            @error('description') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Category</label>
                <select name="category_id" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
                    <option value="">— Select Category —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $video->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Duration (seconds)</label>
                <input type="number" name="duration" value="{{ old('duration', $video->duration) }}" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
                @error('duration') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Thumbnail (Image)</label>
                @if($video->thumbnail)
                    <p class="text-sm text-gray-400 mb-2">Current: {{ $video->thumbnail }}</p>
                @endif
                <input type="file" name="thumbnail" accept="image/*" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-gray-400 file:bg-cyan-600 file:border-0 file:rounded file:px-3 file:py-1 file:text-white cursor-pointer">
                @error('thumbnail') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Rating (0-5)</label>
                <input type="number" name="rating" step="0.1" min="0" max="5" value="{{ old('rating', $video->rating) }}" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
            </div>
        </div>

        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <label class="flex items-center gap-2 text-sm text-gray-300">
                <input type="checkbox" name="is_trending" {{ old('is_trending', $video->is_trending) ? 'checked' : '' }} class="rounded border-gray-600 bg-gray-900">
                Mark as Trending
            </label>

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 px-6 py-2 rounded-lg font-semibold transition">Update Video</button>
                <a href="{{ route('admin.videos.show', $video) }}" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg transition text-center">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection