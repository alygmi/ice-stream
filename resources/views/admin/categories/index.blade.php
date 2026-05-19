@extends("admin.layout")
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
@endsection