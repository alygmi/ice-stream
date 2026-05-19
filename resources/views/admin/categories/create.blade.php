@extends('admin.layout')

@section('title', 'Create Category')
@section('page-title', 'Create New Category')

@section('content')
<div class="max-w-2xl">
    <div class="bg-gradient-to-br from-slate-800 to-slate-900 border border-blue-500/30 rounded-xl p-8">
        <form action="/admin/categories" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold mb-2 text-blue-400">
                    Category Name
                </label>
                <input type="text" name="name" required class="w-full px-4 py-2 rounded-lg bg-slate-700 border border-blue-500/30 focus:border-blue-400 focus:outline-none text-white placeholder-gray-500" placeholder="e.g., Action, Drama, Comedy">
                @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-4 pt-6 border-t border-blue-500/20">
                <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 px-6 py-3 rounded-lg font-semibold transition">
                    Create Category
                </button>
                <a href="/admin/categories" class="flex-1 bg-slate-700 hover:bg-slate-600 px-6 py-3 rounded-lg font-semibold transition text-center">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection