@extends('admin.layout')

@section('title', 'Edit Video')
@section('page-title', '✏️ Edit Video')

@section('content')
<div class="max-w-2xl">
    <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-cyan-500/30 rounded-xl p-8">
        <form action="/admin/videos/{{ $video->id }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Video Title -->
            <div>
                <label class="block text-sm font-semibold mb-2 text-cyan-400">
                    📝 Video Title
                </label>
                <input type="text" name="title" value="{{ $video->title }}" required class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-cyan-500/30 focus:border-cyan-400 focus:outline-none text-white">
                @error('title')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label class="block text-sm font-semibold mb-2 text-cyan-400">
                    📁 Category
                </label>
                <select name="category_id" required class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-cyan-500/30 focus:border-cyan-400 focus:outline-none text-white">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $video->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description -->
            <div>
                <label class="block text-sm font-semibold mb-2 text-cyan-400">
                    📄 Description
                </label>
                <textarea name="description" rows="4" required class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-cyan-500/30 focus:border-cyan-400 focus:outline-none text-white">{{ $video->description }}</textarea>
                @error('description')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Duration (Read-only) -->
            <div>
                <label class="block text-sm font-semibold mb-2 text-cyan-400">
                    ⏱️ Duration
                </label>
                <input type="text" value="{{ gmdate('H:i:s', $video->duration) }}" disabled class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-cyan-500/30 text-gray-400">
            </div>

            <!-- Rating -->
            <div>
                <label class="block text-sm font-semibold mb-2 text-cyan-400">
                    ⭐ Rating
                </label>
                <input type="number" name="rating" value="{{ $video->rating }}" min="0" max="10" step="0.1" class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-cyan-500/30 focus:border-cyan-400 focus:outline-none text-white">
                @error('rating')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Checkboxes -->
            <div class="flex items-center gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_trending" {{ $video->is_trending ? 'checked' : '' }} class="w-4 h-4 rounded bg-slate-700 border border-cyan-500/30">
                    <span class="text-sm"> Mark as Trending</span>
                </label>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-6 border-t border-cyan-500/20">
                <button type="submit" class="flex-1 bg-gradient-to-r from-cyan-600 to-cyan-500 hover:from-cyan-700 hover:to-cyan-600 px-6 py-3 rounded-lg font-semibold transition">
                     Update Video
                </button>
                <a href="/admin/videos/{{ $video->id }}" class="flex-1 bg-slate-700 hover:bg-slate-600 px-6 py-3 rounded-lg font-semibold transition text-center">
                     Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection