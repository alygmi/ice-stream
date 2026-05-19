@extends('admin.layout')

@section('title', 'Categories')
@section('page-title', 'Categories Management')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <h2 class="text-lg font-semibold">All Categories</h2>
    <a href="/admin/categories/create" class="bg-gradient-to-r from-cyan-600 to-cyan-500 hover:from-cyan-700 hover:to-cyan-600 px-6 py-2 rounded-lg font-semibold transition flex items-center gap-2">
        <span></span> New Category
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($categories as $category)
        <div class="group bg-gradient-to-br from-slate-800 to-slate-900 border border-blue-500/20 rounded-xl p-6 hover:border-blue-400/60 hover:shadow-lg hover:shadow-blue-500/20 transition">
            <div class="flex items-start justify-between mb-4">
                <h3 class="text-xl font-bold">{{ $category->name }}</h3>
                <span class="text-2xl"></span>
            </div>

            <div class="mb-4 py-4 border-t border-blue-500/20">
                <p class="text-sm text-gray-500 mb-2">Videos in this category</p>
                <p class="text-2xl font-bold text-blue-400">{{ $category->videos_count ?? 0 }}</p>
            </div>

            <div class="flex gap-2">
                <a href="/admin/categories/{{ $category->id }}/edit" class="flex-1 bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded text-sm font-semibold transition text-center">Edit</a>
                <form action="/admin/categories/{{ $category->id }}" method="POST" class="flex-1" onsubmit="return confirm('Delete this category?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 px-3 py-2 rounded text-sm font-semibold transition">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-3 text-center py-12">
            <div class="text-5xl mb-4"></div>
            <p class="text-lg text-gray-400 mb-4">No categories found</p>
            <a href="/admin/categories/create" class="inline-block bg-cyan-600 hover:bg-cyan-700 px-6 py-3 rounded-lg font-semibold transition">
                Create Your First Category
            </a>
        </div>
    @endforelse
</div>
@endsection