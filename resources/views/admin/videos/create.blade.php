@extends('admin.layout')

@section('title', 'Upload Video')
@section('page-title', ' Upload New Video')

@section('content')
<div class="max-w-2xl">
    <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-cyan-500/30 rounded-xl p-8">
        <form action="/admin/videos" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Video Title -->
            <div>
                <label class="block text-sm font-semibold mb-2 text-cyan-400">
                    Video Title
                </label>
                <input type="text" name="title" required class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-cyan-500/30 focus:border-cyan-400 focus:outline-none text-white placeholder-gray-500" placeholder="Enter video title">
                @error('title')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-semibold mb-2 text-cyan-400">
                    Category
                </label>
                <select name="category_id" required class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-cyan-500/30 focus:border-cyan-400 focus:outline-none text-white">
                    <option value="">Select a category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-semibold mb-2 text-cyan-400">
                    Description
                </label>
                <textarea name="description" rows="4" required class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-cyan-500/30 focus:border-cyan-400 focus:outline-none text-white placeholder-gray-500" placeholder="Enter video description"></textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Video File -->
            <div>
                <label class="block text-sm font-semibold mb-2 text-cyan-400">
                    Video File (mp4, mov, avi, wmv)
                </label>
                <div class="border-2 border-dashed border-cyan-500/30 rounded-lg p-6 text-center cursor-pointer hover:border-cyan-400/60 transition" id="dropZone">
                    <input type="file" name="video" id="videoInput" required accept=".mp4,.mov,.avi,.wmv" class="hidden">
                    <p class="text-cyan-400 font-semibold mb-2">📤 Drag & drop or click to select</p>
                    <p class="text-gray-500 text-sm">Max 500MB</p>
                    <p id="fileName" class="text-gray-400 text-sm mt-2"></p>
                </div>
                @error('video')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Checkboxes -->
            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_trending" class="w-4 h-4 rounded bg-slate-700 border border-cyan-500/30">
                    <span class="text-sm">Mark as Trending</span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-6 border-t border-cyan-500/20">
                <button type="submit" class="flex-1 bg-gradient-to-r from-cyan-600 to-cyan-500 hover:from-cyan-700 hover:to-cyan-600 px-6 py-3 rounded-lg font-semibold transition">
                    Upload Video
                </button>
                <a href="/admin/videos" class="flex-1 bg-slate-700 hover:bg-slate-600 px-6 py-3 rounded-lg font-semibold transition text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    const dropZone = document.getElementById('dropZone');
    const videoInput = document.getElementById('videoInput');
    const fileName = document.getElementById('fileName');

    dropZone.addEventListener('click', () => videoInput.click());
    
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('border-cyan-400', 'bg-cyan-600/10');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('border-cyan-400', 'bg-cyan-600/10');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-cyan-400', 'bg-cyan-600/10');
        const files = e.dataTransfer.files;
        if (files.length) {
            videoInput.files = files;
            fileName.textContent = `📁 ${files[0].name}`;
        }
    });

    videoInput.addEventListener('change', (e) => {
        if (e.target.files.length) {
            fileName.textContent = `📁 ${e.target.files[0].name}`;
        }
    });
</script>
@endsection