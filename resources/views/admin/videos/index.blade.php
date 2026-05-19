@extends("admin.layout")
@section("page_title", "Videos Management")
@section("content")
<div class="max-w-7xl mx-auto space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h2 class="text-2xl font-bold">Videos</h2>
            <p class="text-gray-400">Manage all videos, edit metadata, and review uploads.</p>
        </div>
        <a href="{{ route('admin.videos.create') }}" class="bg-cyan-600 hover:bg-cyan-700 px-4 py-2 rounded-lg font-semibold transition">+ Add Video</a>
    </div>

    <div class="grid gap-4 md:grid-cols-[1fr_auto]">
        <form method="get" class="flex gap-2 flex-1">
            <input type="search" name="search" value="{{ request('search') }}" placeholder="Search videos..." class="flex-1 bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white placeholder-gray-500 focus:border-cyan-500 focus:outline-none">
            <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 px-4 py-2 rounded-lg transition">Search</button>
        </form>
    </div>

    <div class="bg-gray-800/30 border border-gray-700 rounded-lg overflow-hidden">
        <table class="min-w-full">
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
                            <a href="{{ route('admin.videos.show', $video) }}" class="text-cyan-400 hover:text-cyan-300">View</a>
                            <a href="{{ route('admin.videos.edit', $video) }}" class="text-blue-400 hover:text-blue-300">Edit</a>
                            <form method="post" action="{{ route('admin.videos.destroy', $video) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this video?')" class="text-red-400 hover:text-red-300">Delete</button>
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
</div>
@endsection