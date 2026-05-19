@extends("admin.layout")
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
@endsection