<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Videos - Ice Stream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen">
    <nav class="fixed top-0 w-full z-50 bg-black/95 border-b border-gray-700">
        <div class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto w-full">
            <a href="{{ route('landing') }}" class="flex items-center gap-3 hover:opacity-80">
                <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">❄️</span>
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent">
                    ICE STREAM
                </span>
            </a>

            <div class="flex items-center gap-6">
                <a href="{{ route('landing') }}" class="hover:text-gray-300 transition">Home</a>
                <a href="{{ route('videos.index') }}" class="hover:text-gray-300 transition">Browse</a>
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-gray-300 transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-cyan-500 px-4 py-2 rounded hover:bg-cyan-600 transition">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="pt-24 pb-16 px-6 max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold mb-2">Browse Videos</h1>
        <p class="text-gray-400 mb-8">Filter by category or search by title.</p>

        <form id="search" method="get" action="{{ route('videos.index') }}" class="flex flex-col sm:flex-row gap-4 mb-8 scroll-mt-28">
            <input
                type="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search titles…"
                class="flex-1 rounded-lg bg-gray-900 border border-gray-700 px-4 py-2 text-white placeholder-gray-500 focus:border-cyan-500 focus:outline-none"
            >
            <button type="submit" class="rounded-lg bg-cyan-600 px-6 py-2 font-semibold hover:bg-cyan-500 transition">
                Search
            </button>
        </form>

        @if($categories->isNotEmpty())
            <div class="flex flex-wrap gap-2 mb-10">
                <a
                    href="{{ route('videos.index', array_filter(['search' => request('search')])) }}"
                    class="rounded-full px-4 py-1.5 text-sm font-medium border transition {{ request('category') ? 'border-gray-600 text-gray-300 hover:border-cyan-500' : 'border-cyan-500 bg-cyan-600/20 text-cyan-300' }}"
                >
                    All
                </a>
                @foreach($categories as $cat)
                    <a
                        href="{{ route('videos.index', array_filter(['category' => $cat->id, 'search' => request('search')])) }}"
                        class="rounded-full px-4 py-1.5 text-sm font-medium border transition {{ (string) request('category') === (string) $cat->id ? 'border-cyan-500 bg-cyan-600/20 text-cyan-300' : 'border-gray-600 text-gray-300 hover:border-cyan-500' }}"
                    >
                        {{ $cat->name ?? ('Category #' . $cat->id) }}
                    </a>
                @endforeach
            </div>
        @endif

        @if($videos->isEmpty())
            <p class="text-gray-500 text-center py-16">No videos found.</p>
        @else
            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach($videos as $v)
                    <a href="{{ route('videos.show', $v->id) }}" class="group rounded-xl border border-gray-800 bg-gray-900/40 overflow-hidden hover:border-cyan-600/50 transition">
                        <div class="aspect-video bg-gradient-to-b from-blue-900/40 to-gray-900 flex items-center justify-center relative">
                            @if($v->thumbnail)
                                <img src="{{ asset('storage/' . $v->thumbnail) }}" alt="" class="absolute inset-0 w-full h-full object-cover opacity-90 group-hover:opacity-100 transition">
                            @endif
                            <span class="text-5xl relative z-10 drop-shadow-lg">🎬</span>
                            @if($v->duration)
                                <span class="absolute bottom-2 right-2 z-10 rounded bg-black/80 px-2 py-0.5 text-xs text-gray-200">
                                    {{ gmdate('H:i:s', (int) $v->duration) }}
                                </span>
                            @endif
                        </div>
                        <div class="p-4">
                            <h2 class="font-semibold text-white group-hover:text-cyan-400 transition line-clamp-2">{{ $v->title }}</h2>
                            <p class="mt-2 text-xs text-gray-500">
                                {{ $v->category->name ?? 'Uncategorized' }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-10">
                {{ $videos->withQueryString()->links() }}
            </div>
        @endif
    </main>

    <footer class="border-t border-gray-800 px-6 py-8">
        <div class="max-w-7xl mx-auto text-center text-gray-500 text-sm">
            <p>&copy; 2026 Ice Stream. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
