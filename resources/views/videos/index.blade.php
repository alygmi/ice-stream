<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $video->title }} - Ice Stream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 bg-black/95 border-b border-gray-700">
        <div class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto w-full">
            <a href="/" class="flex items-center gap-3 hover:opacity-80">
                <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">❄️</span>
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent">
                    ICE STREAM
                </span>
            </a>
            
            <div class="flex items-center gap-6">
                <a href="/" class="hover:text-gray-300 transition">Home</a>
                <a href="/videos" class="hover:text-gray-300 transition">Browse</a>
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="hover:text-gray-300 transition">Logout</button>
                    </form>
                @else
                    <a href="/login" class="bg-cyan-500 px-4 py-2 rounded hover:bg-cyan-600 transition">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Video Player Section -->
    <section class="pt-20 pb-12">
        <div class="max-w-6xl mx-auto px-6">
            <!-- Main Video Player -->
            <div class="relative w-full aspect-video bg-black rounded-lg overflow-hidden mb-8 border border-gray-700">
                @auth
                    <video 
                        id="videoPlayer" 
                        class="w-full h-full"
                        controls
                        controlsList="nodownload"
                    >
                        <source src="{{ asset('storage/videos/' . $video->video_path) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <!-- Login Required Overlay -->
                    <div class="absolute inset-0 bg-black/80 flex flex-col items-center justify-center z-10">
                        <div class="text-center">
                            <div class="text-6xl mb-4">🔒</div>
                            <h2 class="text-3xl font-bold mb-4">Login Required</h2>
                            <p class="text-gray-400 mb-8">Sign in to watch this video</p>
                            <a href="/login" class="bg-cyan-500 hover:bg-cyan-600 px-8 py-3 rounded-lg font-semibold transition">
                                Sign In Now
                            </a>
                        </div>
                    </div>
                    <div class="w-full h-full bg-gradient-to-b from-gray-800 to-gray-900 flex items-center justify-center">
                        <div class="text-6xl">🎬</div>
                    </div>
                @endauth
            </div>

            <!-- Video Info -->
            <div class="grid grid-cols-3 gap-8">
                <div class="col-span-2">
                    <!-- Title & Meta -->
                    <h1 class="text-4xl font-bold mb-4">{{ $video->title }}</h1>
                    
                    <div class="flex items-center gap-4 mb-6 text-gray-400">
                        <span class="flex items-center gap-2">
                            <span class="text-cyan-400">👤</span>
                            {{ $video->creator->name ?? 'Unknown' }}
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-2">
                            <span class="text-cyan-400">📅</span>
                            {{ $video->created_at->format('M d, Y') }}
                        </span>
                        <span>•</span>
                        <span class="flex items-center gap-2">
                            <span class="text-cyan-400">⏱️</span>
                            {{ gmdate("H:i:s", $video->duration) }}
                        </span>
                        <span>•</span>
                        <span class="bg-cyan-600/30 px-3 py-1 rounded text-cyan-400">
                            {{ $video->category->name ?? 'N/A' }}
                        </span>
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-3">Description</h3>
                        <p class="text-gray-300 leading-relaxed">{{ $video->description }}</p>
                    </div>

                    <!-- Action Buttons -->
                    @auth
                        <div class="flex gap-4">
                            <button class="flex items-center gap-2 bg-cyan-500 hover:bg-cyan-600 px-6 py-3 rounded-lg font-semibold transition">
                                <span>❤️</span> Add to Favorites
                            </button>
                            <button class="flex items-center gap-2 border border-gray-600 hover:border-cyan-400 px-6 py-3 rounded-lg font-semibold transition">
                                <span>📝</span> Share
                            </button>
                        </div>
                    @endauth
                </div>

                <!-- Sidebar -->
                <div class="col-span-1">
                    <h3 class="text-xl font-bold mb-4">Related Videos</h3>
                    <div class="space-y-4">
                        @forelse($relatedVideos as $related)
                            <a href="/videos/{{ $related->id }}" class="group flex gap-3 hover:opacity-80 transition">
                                <div class="flex-shrink-0 w-24 h-16 rounded bg-gradient-to-b from-blue-900/30 to-gray-900 flex items-center justify-center">
                                    <span class="text-2xl">🎬</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-sm group-hover:text-cyan-400 transition line-clamp-2">
                                        {{ Str::limit($related->title, 40) }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ gmdate("H:i:s", $related->duration) }}
                                    </p>
                                </div>
                            </a>
                        @empty
                            <p class="text-gray-500 text-sm">No related videos</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black border-t border-gray-700 px-6 py-12 mt-12">
        <div class="max-w-7xl mx-auto text-center text-gray-500 text-sm">
            <p>&copy; 2026 Ice Stream. All rights reserved.</p>
        </div>
    </footer>

    <style>
        video::-webkit-media-controls-panel {
            background-color: rgba(0, 0, 0, 0.8);
        }
    </style>
</body>
</html>