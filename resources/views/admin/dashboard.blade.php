@extends("admin.layout")
@section("page_title", "Dashboard")
@section("content")
<div class="space-y-10">
    <section class="relative overflow-hidden rounded-[2rem] border border-cyan-500/20 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800 p-8 shadow-2xl shadow-cyan-500/10">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(34,211,238,0.25),_transparent_30%)] pointer-events-none"></div>
        <div class="relative grid gap-6 lg:grid-cols-[1.5fr_0.9fr] items-center">
            <div class="space-y-6 text-white">
                <div class="inline-flex items-center gap-3 rounded-3xl bg-white/5 px-4 py-2 text-sm text-cyan-200 ring-1 ring-white/10">
                    <span class="text-xl">❄️</span>
                    Admin Dashboard
                </div>
                <div>
                    <h1 class="text-4xl sm:text-5xl font-black tracking-tight bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-500 bg-clip-text text-transparent">
                        Manage your stream with style
                    </h1>
                    <p class="mt-4 max-w-2xl text-gray-300 text-lg sm:text-xl">
                        Kelola video, kategori, dan statistik dalam tampilan modern yang selaras dengan UI landing page Ice Stream.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('admin.videos.index') }}" class="inline-flex items-center justify-center rounded-full bg-cyan-500 px-6 py-3 text-sm font-semibold text-black transition hover:bg-cyan-400">
                        Lihat Semua Video
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center justify-center rounded-full border border-white/10 bg-white/5 px-6 py-3 text-sm font-semibold text-white transition hover:border-cyan-400 hover:text-cyan-300">
                        Kategori
                    </a>
                </div>
            </div>
            <div class="grid gap-4 sm:grid-cols-3">
                <div class="rounded-[1.75rem] border border-white/10 bg-white/5 p-6 text-center shadow-[0_0_80px_-40px_rgba(34,211,238,0.3)]">
                    <div class="text-sm text-gray-400">Total Videos</div>
                    <div class="mt-4 text-4xl font-extrabold text-cyan-400">{{ $total_videos }}</div>
                </div>
                <div class="rounded-[1.75rem] border border-white/10 bg-white/5 p-6 text-center">
                    <div class="text-sm text-gray-400">Total Categories</div>
                    <div class="mt-4 text-4xl font-extrabold text-cyan-400">{{ $total_categories }}</div>
                </div>
                <div class="rounded-[1.75rem] border border-white/10 bg-white/5 p-6 text-center">
                    <div class="text-sm text-gray-400">Admin</div>
                    <div class="mt-4 text-4xl font-extrabold text-cyan-400">{{ auth()->user()->name }}</div>
                </div>
            </div>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-[1.5fr_0.9fr]">
        <div class="rounded-[2rem] border border-gray-700 bg-slate-950/90 p-6 shadow-xl shadow-slate-950/10">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-white">Recent Videos</h2>
                    <p class="text-gray-400">Update terakhir ditampilkan di sini.</p>
                </div>
                <a href="{{ route('admin.videos.index') }}" class="rounded-full border border-cyan-500/30 bg-cyan-500/10 px-4 py-2 text-sm font-semibold text-cyan-300 transition hover:bg-cyan-500/20">
                    Lihat Semua
                </a>
            </div>

            <div class="mt-6 grid gap-4">
                @forelse($recent_videos as $video)
                    <a href="{{ route('admin.videos.show', $video) }}" class="group block overflow-hidden rounded-[1.75rem] border border-gray-700 bg-gradient-to-br from-slate-900 to-gray-950 p-4 transition hover:-translate-y-0.5 hover:border-cyan-500/50">
                        <div class="flex items-center gap-4">
                            <div class="flex h-20 w-28 items-center justify-center overflow-hidden rounded-3xl bg-gray-800 text-3xl text-gray-400">
                                @if($video->thumbnail)
                                    <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }} thumbnail" class="h-full w-full object-cover" />
                                @else
                                    🎬
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="truncate text-lg font-semibold text-cyan-300">{{ $video->title }}</h3>
                                <p class="truncate text-sm text-gray-400">{{ $video->category->name ?? 'Uncategorized' }}</p>
                            </div>
                            <span class="text-xs text-gray-500">{{ $video->created_at->format('M d, Y') }}</span>
                        </div>
                    </a>
                @empty
                    <div class="rounded-[1.75rem] border border-gray-700 bg-gray-900/80 p-6 text-center text-gray-400">
                        Tidak ada video terbaru.
                    </div>
                @endforelse
            </div>
        </div>

        <div class="space-y-4">
            <div class="rounded-[2rem] border border-gray-700 bg-slate-950/90 p-6 shadow-xl shadow-slate-950/10">
                <h3 class="text-lg font-bold text-white">Quick Actions</h3>
                <div class="mt-4 grid gap-3">
                    <a href="{{ route('admin.videos.create') }}" class="rounded-3xl bg-cyan-500 px-4 py-3 text-center font-semibold text-black transition hover:bg-cyan-400">Tambah Video</a>
                    <a href="{{ route('admin.categories.create') }}" class="rounded-3xl border border-gray-700 bg-white/5 px-4 py-3 text-center font-semibold text-white transition hover:border-cyan-400">Tambah Kategori</a>
                    <a href="{{ route('admin.videos.index') }}" class="rounded-3xl border border-gray-700 bg-white/5 px-4 py-3 text-center font-semibold text-white transition hover:border-cyan-400">Kelola Video</a>
                </div>
            </div>

            <div class="rounded-[2rem] border border-gray-700 bg-slate-950/90 p-6 shadow-xl shadow-slate-950/10">
                <h3 class="text-lg font-bold text-white">Stats Overview</h3>
                <div class="mt-4 grid gap-3">
                    <div class="rounded-3xl bg-gray-900/80 p-4">
                        <div class="text-sm text-gray-400">Rasio video per kategori</div>
                        <div class="mt-3 text-3xl font-semibold text-cyan-400">{{ $total_categories ? number_format($total_videos / $total_categories, 1) : '0.0' }}</div>
                    </div>
                    <div class="rounded-3xl bg-gray-900/80 p-4">
                        <div class="text-sm text-gray-400">Video trending kini</div>
                        <div class="mt-3 text-3xl font-semibold text-cyan-400">{{ $recent_videos->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection