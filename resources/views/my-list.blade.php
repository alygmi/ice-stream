<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My List - Ice Stream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen flex flex-col justify-between">
    
    <!-- HEADER: Navigation Bar Seragam -->
    <nav class="fixed top-0 w-full z-50 bg-black/95 border-b border-gray-700">
        <div class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto w-full">
            
            <!-- LOGO -->
            <a href="{{ Auth::check() ? route('user.homepage') : route('landing') }}" class="flex items-center gap-3 hover:opacity-80 transition">
                <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">❄️</span>
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent">
                    ICE STREAM
                </span>
            </a>

            <!-- NAV MENU -->
            <div class="flex items-center gap-6 text-sm sm:text-base">
                <a href="{{ route('user.homepage') }}" 
                   class="transition {{ Route::is('user.homepage') ? 'text-cyan-400 font-semibold' : 'text-gray-400 hover:text-white' }}">
                    Home
                </a>
                
                <a href="{{ route('videos.index') }}" 
                   class="transition {{ Route::is('videos.index') && !request()->text ? 'text-cyan-400 font-semibold' : 'text-gray-400 hover:text-white' }}">
                    Movies
                </a>
                
                <a href="{{ route('my-list') }}" 
                   class="transition {{ Route::is('my-list') ? 'text-cyan-400 font-semibold' : 'text-gray-400 hover:text-white' }}">
                    My List
                </a>
                
                <a href="{{ route('videos.index') }}#search" 
                   class="text-gray-400 hover:text-white transition">
                    Search
                </a>
                
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="inline ml-2">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-red-400 transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-cyan-500 px-4 py-2 rounded text-white hover:bg-cyan-600 transition ml-2">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="pt-24 pb-16 px-6 max-w-7xl mx-auto w-full flex-grow">
        
        <!-- Flash Alert Notification -->
        @if (session('success'))
            <div class="mb-6 p-4 rounded-lg bg-green-600/20 border border-green-500/40 text-green-400 text-left max-w-7xl mx-auto">
                <span>✅ {{ session('success') }}</span>
            </div>
        @endif

        <div class="text-left mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-white to-gray-400 bg-clip-text text-transparent">My List</h1>
            <p class="text-gray-400 text-sm mt-1">Kumpulan video yang Anda simpan untuk ditonton nanti.</p>
        </div>

        {{-- Cek apakah user memiliki video favorit --}}
        @if(isset($favoriteVideos) && $favoriteVideos->count() > 0)
            
            <!-- Grid Video Catalog -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 text-left">
                @foreach($favoriteVideos as $video)
                    <div class="group bg-gray-900/40 border border-gray-800 rounded-xl overflow-hidden hover:border-cyan-500/50 transition-all duration-300 flex flex-col justify-between">
                        
                        <!-- Link ke Halaman Watch -->
                        <a href="{{ route('videos.show', $video->id) }}" class="block relative aspect-video bg-gray-800">
                            @if($video->thumbnail)
                                <img src="{{ asset('storage/' . $video->thumbnail) }}" alt="{{ $video->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <!-- Fallback jika video tidak memiliki file thumbnail -->
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-800 to-gray-900">
                                    <span class="text-4xl">🎬</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <span class="bg-cyan-500 text-white p-3 rounded-full font-bold shadow-lg transform scale-90 group-hover:scale-100 transition duration-300">▶</span>
                            </div>
                        </a>

                        <!-- Detail Informasi Video -->
                        <div class="p-4 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="font-semibold text-lg line-clamp-1 group-hover:text-cyan-400 transition mb-1">
                                    <a href="{{ route('videos.show', $video->id) }}">{{ $video->title }}</a>
                                </h3>
                                <p class="text-xs text-gray-500 mb-3">
                                    {{ $video->category->name ?? 'Uncategorized' }}
                                </p>
                            </div>

                            <!-- Tombol Hapus Cepat (Quick Remove) dari My List -->
                            <form action="{{ route('videos.favorite', $video->id) }}" method="POST" class="mt-2">
                                @csrf
                                <button type="submit" class="w-full text-center text-xs bg-gray-800 hover:bg-red-950/40 text-gray-400 hover:text-red-400 py-2 rounded-md border border-gray-700 hover:border-red-900/60 transition duration-200">
                                    💔 Remove
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach
            </div>

        @else
            <!-- EMPTY STATE: Tampilan jika data favorit kosong -->
            <div class="max-w-md mx-auto py-16 text-center">
                <div class="text-6xl mb-4 text-gray-600">📂</div>
                <h2 class="text-xl font-medium mb-2">Daftar favorit Anda kosong</h2>
                <p class="text-gray-500 mb-8 text-sm">Anda belum menambahkan video apa pun ke daftar tontonan. Jelajahi katalog film kami dan temukan tontonan menarik.</p>
                <a href="{{ route('videos.index') }}" class="inline-block bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 px-8 py-3 rounded-lg font-semibold transition transform hover:scale-105 shadow-md shadow-cyan-500/10">
                    Browse Videos
                </a>
            </div>
        @endif

    </main>

    <!-- FOOTER -->
    <footer class="border-t border-gray-800 px-6 py-8 mt-auto">
        <div class="max-w-7xl mx-auto text-center text-gray-500 text-sm">
            <p>&copy; 2026 Ice Stream. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>