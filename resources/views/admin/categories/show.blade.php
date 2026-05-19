@extends('admin.layout')

@section('title', $category->name)
@section('page-title', 'Category Details')

@section('content')
<div class="grid grid-cols-3 gap-8">
    <div class="col-span-2">
        <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-blue-500/30 rounded-xl p-6">
            <h2 class="text-2xl font-bold mb-4">{{ $category->name }}</h2>
            <p class="text-gray-400 mb-6">Videos in this category: <span class="text-blue-400 font-bold">{{ count($category->videos) }}</span></p>

            <div class="grid grid-cols-2 gap-4">
                @forelse($category->videos as $video)
                    <div class="bg-slate-700/50 border border-blue-500/20 rounded-lg p-4">
                        <h3 class="font-semibold truncate mb-2">{{ $video->title }}</h3>
                        <p class="text-xs text-gray-500">{{ $video->created_at->format('M d, Y') }}</p>
                    </div>
                @empty
                    <div class="col-span-2 text-center py-8 text-gray-500">
                        No videos in this category yet
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="space-y-4">
        <a href="/admin/categories/{{ $category->id }}/edit" class="block w-full bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 px-6 py-3 rounded-lg font-semibold transition text-center">
            Edit Category
        </a>
        <form action="/admin/categories/{{ $category->id }}" method="POST" onsubmit="return confirm('Delete this category?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="w-full bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 px-6 py-3 rounded-lg font-semibold transition">
                Delete Category
            </button>
        </form>
        <a href="/admin/categories" class="block w-full bg-slate-700 hover:bg-slate-600 px-6 py-3 rounded-lg font-semibold transition text-center">
            ← Back to Categories
        </a>
    </div>
</div>
@endsection