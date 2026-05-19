@extends("admin.layout")
@section("page_title", "Create Video")
@section("content")
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold">Create Video</h2>
            <p class="text-sm text-gray-400">Add a new video to the catalog.</p>
        </div>
        <a href="{{ route('admin.videos.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">Back to videos</a>
    </div>

    <form method="post" action="{{ route('admin.videos.store') }}" enctype="multipart/form-data" class="bg-gray-800/30 border border-gray-700 rounded-lg p-6 space-y-6">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-2">Title *</label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white placeholder-gray-600 focus:border-cyan-500 focus:outline-none">
            @error('title') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">Description *</label>
            <textarea name="description" rows="4" required class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white placeholder-gray-600 focus:border-cyan-500 focus:outline-none">{{ old('description') }}</textarea>
            @error('description') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Category</label>
                <select name="category_id" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
                    <option value="">— Select Category —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Duration (seconds)</label>
                <input type="number" name="duration" value="{{ old('duration') }}" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
                @error('duration') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Thumbnail (Image)</label>
                <input type="file" name="thumbnail" accept="image/*" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-gray-400 file:bg-cyan-600 file:border-0 file:rounded file:px-3 file:py-1 file:text-white cursor-pointer">
                @error('thumbnail') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Video File (MP4, AVI, MKV, MOV)</label>
                <input type="file" name="video" accept="video/*" class="w-full bg-gray-900 border border-gray-700 rounded-lg px-4 py-2 text-gray-400 file:bg-cyan-600 file:border-0 file:rounded file:px-3 file:py-1 file:text-white cursor-pointer">
                @error('video') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 pt-4">
            <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 px-6 py-2 rounded-lg font-semibold transition">Create Video</button>
            <a href="{{ route('admin.videos.index') }}" class="bg-gray-700 hover:bg-gray-600 px-6 py-2 rounded-lg transition text-center">Cancel</a>
        </div>
    </form>
</div>
@endsection