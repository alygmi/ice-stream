<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ice Stream - Watch Now</title>
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 bg-gradient-to-b from-black via-black/80 to-transparent">
        <div class="flex items-center justify-between px-6 py-4 max-w-7xl mx-auto w-full">
            <!-- Ice Stream Logo with Icon -->
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">❄️</span>
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent">
                    ICE STREAM
                </span>
            </div>
            
            <div class="flex items-center gap-6">
                <a href="#" class="hover:text-gray-300 transition">Home</a>
                <a href="#" class="hover:text-gray-300 transition">Movies</a>
                <a href="#" class="hover:text-gray-300 transition">My List</a>
                <a href="#" class="hover:text-gray-300 transition">Search</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative h-screen bg-cover bg-center" style="background: linear-gradient(135deg, #0F2027 0%, #203A43 50%, #2C5364 100%); background-attachment: fixed;">
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center z-10">
                <!-- Ice Stream Logo Large -->
                <div class="mb-8 flex justify-center">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-blue-600 rounded-2xl blur-2xl opacity-50"></div>
                        <div class="relative w-32 h-32 bg-gradient-to-br from-cyan-400 via-blue-500 to-purple-600 rounded-2xl flex items-center justify-center">
                            <span class="text-7xl">❄️</span>
                        </div>
                    </div>
                </div>
                
                <!-- Ice Stream Text -->
                <h1 class="text-7xl font-black mb-4">
                    <span class="bg-gradient-to-r from-cyan-400 via-blue-400 to-purple-500 bg-clip-text text-transparent">
                        ICE STREAM
                    </span>
                </h1>
                
                <p class="text-2xl text-gray-300 mb-8">Premium Streaming Experience</p>
                <p class="text-lg text-gray-400 mb-10 max-w-2xl mx-auto">Watch your favorite shows and movies in stunning quality. Stream unlimited content anytime, anywhere.</p>
                
                <div class="flex gap-4 justify-center">
                    <button class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 px-8 py-4 rounded-lg font-bold text-lg transition transform hover:scale-105">
                        ▶ Start Watching
                    </button>
                    <button class="border-2 border-cyan-400 hover:bg-cyan-400/10 px-8 py-4 rounded-lg font-bold text-lg transition">
                        Learn More
                    </button>
                </div>
            </div>
        </div>

        <!-- FLOATING RECOMMENDATION WINDOW -->
        <div id="floatingWindow" class="fixed bottom-8 right-8 w-96 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 rounded-2xl shadow-2xl border border-cyan-500/30 z-40 floating-window cursor-move" style="box-shadow: 0 0 40px rgba(34, 211, 238, 0.2);">
            <!-- Header -->
            <div class="bg-gradient-to-r from-cyan-600 to-blue-600 px-6 py-4 rounded-t-2xl flex items-center justify-between cursor-move" id="floatingHeader">
                <div class="flex items-center gap-2">
                    <span class="text-2xl">🎬</span>
                    <h3 class="font-bold text-lg">Recommendation</h3>
                </div>
                <button id="closeFloating" class="text-white hover:text-red-400 transition text-xl">
                    ✕
                </button>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="grid grid-cols-2 gap-3">
                    @forelse($trendingVideos->take(4) as $video)
                        <div class="group cursor-pointer">
                            <div class="relative w-full aspect-video rounded-lg overflow-hidden bg-gradient-to-b from-blue-900/30 to-gray-900 flex items-center justify-center transition transform group-hover:scale-110">
                                <div class="text-center">
                                    <div class="text-2xl">🎥</div>
                                </div>
                                <!-- Hover overlay -->
                                <div class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                    <button class="bg-cyan-500 hover:bg-cyan-600 text-black rounded-full w-10 h-10 flex items-center justify-center transition font-bold text-sm">
                                        ▶
                                    </button>
                                </div>
                            </div>
                            <p class="text-xs text-gray-300 mt-2 truncate">{{ Str::limit($video->title, 15) }}</p>
                        </div>
                    @empty
                        <div class="col-span-2 text-gray-400 text-sm">No recommendations</div>
                    @endforelse
                </div>
            </div>
        </div>

    </section>

    <!-- Trending Now Section - WITH CAROUSEL -->
    <section class="relative z-10 -mt-32 px-6 pb-12">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold mb-8 flex items-center gap-3">
                <span class="text-cyan-400">🔥</span>
                Trending Now
            </h2>

            <!-- Carousel Container -->
            <div class="relative">
                <!-- Carousel Wrapper -->
                <div class="overflow-hidden rounded-lg">
                    <div id="carouselTrack" class="flex transition-transform duration-500 ease-out">
                        @forelse($trendingVideos as $index => $video)
                            <div class="carousel-item flex-shrink-0 w-full md:w-1/2 lg:w-1/3 px-3">
                                <div class="relative w-full aspect-video rounded-lg overflow-hidden group">
                                    <!-- Video Card -->
                                    <div class="absolute inset-0 bg-gradient-to-b from-cyan-900/40 to-gray-900 flex items-center justify-center">
                                        <div class="text-center">
                                            <div class="text-6xl mb-2">🎬</div>
                                            <p class="text-lg text-gray-300 font-semibold">{{ Str::limit($video->title, 25) }}</p>
                                        </div>
                                    </div>
                                    <!-- Hover overlay -->
                                    <div class="absolute inset-0 bg-black/80 opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center gap-4">
                                        <button class="bg-cyan-500 hover:bg-cyan-600 text-black rounded-full w-16 h-16 flex items-center justify-center transition font-bold text-2xl">
                                            ▶
                                        </button>
                                        <p class="text-center px-4 text-sm">{{ Str::limit($video->title, 40) }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="w-full text-gray-400 py-12 text-center">No trending videos available</div>
                        @endforelse
                    </div>
                </div>

                <!-- Left Arrow -->
                <button id="prevBtn" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-5 bg-cyan-500/80 hover:bg-cyan-600 text-white w-12 h-12 rounded-full flex items-center justify-center transition z-20">
                    ❮
                </button>

                <!-- Right Arrow -->
                <button id="nextBtn" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-5 bg-cyan-500/80 hover:bg-cyan-600 text-white w-12 h-12 rounded-full flex items-center justify-center transition z-20">
                    ❯
                </button>

                <!-- Dots Pagination -->
                <div id="dotsContainer" class="flex justify-center gap-2 mt-6">
                    @forelse($trendingVideos as $index => $video)
                        <button class="carousel-dot w-3 h-3 rounded-full bg-gray-600 hover:bg-cyan-400 transition {{ $index === 0 ? 'bg-cyan-500' : '' }}" data-index="{{ $index }}"></button>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- New Releases Section -->
    <section class="px-6 py-12">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold mb-6 flex items-center gap-3">
                <span>✨</span>
                New Releases
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @forelse($newVideos as $video)
                    <div class="group cursor-pointer">
                        <div class="relative w-full aspect-video rounded-lg overflow-hidden bg-gray-800 mb-3 transition transform group-hover:scale-105 border border-gray-700">
                            <div class="absolute inset-0 bg-gradient-to-b from-blue-900/30 to-gray-900 flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-4xl mb-2">📹</div>
                                    <p class="text-xs text-gray-300">{{ Str::limit($video->title, 20) }}</p>
                                </div>
                            </div>
                            <!-- Hover overlay -->
                            <div class="absolute inset-0 bg-black/80 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <button class="bg-cyan-500 hover:bg-cyan-600 text-black rounded-full w-12 h-12 flex items-center justify-center transition font-bold">
                                    ▶
                                </button>
                            </div>
                        </div>
                        <h3 class="font-semibold group-hover:text-cyan-400 transition">{{ Str::limit($video->title, 25) }}</h3>
                        <p class="text-sm text-gray-500 mt-1">{{ $video->created_at->format('M Y') }}</p>
                    </div>
                @empty
                    <div class="col-span-4 text-gray-400 py-12">No new videos available</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Top Rated Section -->
    <section class="px-6 py-12 bg-gradient-to-b from-gray-900 to-black">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-3xl font-bold mb-6 flex items-center gap-3">
                <span>⭐</span>
                Top Rated
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($topRatedVideos as $video)
                    <div class="group cursor-pointer">
                        <div class="relative w-full aspect-video rounded-xl overflow-hidden bg-gray-800 mb-4 transition transform group-hover:scale-105 border border-gray-600">
                            <div class="absolute inset-0 bg-gradient-to-br from-cyan-900/20 to-gray-900 flex flex-col items-center justify-center">
                                <div class="text-5xl mb-2">⭐</div>
                                <p class="text-xs text-gray-300">{{ Str::limit($video->title, 20) }}</p>
                            </div>
                            <!-- Hover overlay with info -->
                            <div class="absolute inset-0 bg-black/90 opacity-0 group-hover:opacity-100 transition flex flex-col justify-between p-4">
                                <div>
                                    <h3 class="font-bold text-lg">{{ Str::limit($video->title, 30) }}</h3>
                                </div>
                                <button class="bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-black py-2 rounded-lg flex items-center justify-center gap-2 transition font-bold">
                                    ▶ Watch Now
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold group-hover:text-cyan-400 transition">{{ Str::limit($video->title, 30) }}</h3>
                                <p class="text-xs text-gray-600 mt-1">{{ $video->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="text-cyan-400 font-bold">9.2</div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-gray-400 py-12">No top rated videos available</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black border-t border-gray-700 px-6 py-12">
        <div class="max-w-7xl mx-auto">
            <div class="mb-8 flex items-center gap-3">
                <div class="w-8 h-8 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold">❄️</span>
                </div>
                <span class="text-xl font-bold bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent">
                    ICE STREAM
                </span>
            </div>
            
            <div class="grid grid-cols-4 gap-8 mb-8">
                <div>
                    <h4 class="font-bold mb-4">About</h4>
                    <ul class="text-gray-400 space-y-2 text-sm">
                        <li><a href="#" class="hover:text-cyan-400">About Us</a></li>
                        <li><a href="#" class="hover:text-cyan-400">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Contact</h4>
                    <ul class="text-gray-400 space-y-2 text-sm">
                        <li><a href="#" class="hover:text-cyan-400">Help Center</a></li>
                        <li><a href="#" class="hover:text-cyan-400">Support</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Legal</h4>
                    <ul class="text-gray-400 space-y-2 text-sm">
                        <li><a href="#" class="hover:text-cyan-400">Privacy</a></li>
                        <li><a href="#" class="hover:text-cyan-400">Terms</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Follow</h4>
                    <ul class="text-gray-400 space-y-2 text-sm">
                        <li><a href="#" class="hover:text-cyan-400">Twitter</a></li>
                        <li><a href="#" class="hover:text-cyan-400">Instagram</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-6 text-center text-gray-500 text-sm">
                <p>&copy; 2026 Ice Stream. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Custom Scrollbar Hide CSS + Floating Animation -->
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Floating Animation */
        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        .floating-window {
            animation: float 3s ease-in-out infinite;
        }

        .floating-window.dragging {
            animation: none;
            cursor: grabbing;
        }
    </style>

    <script>
        // ===== CAROUSEL FUNCTIONALITY =====
        const carouselTrack = document.getElementById('carouselTrack');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const dotsContainer = document.getElementById('dotsContainer');
        const dots = document.querySelectorAll('.carousel-dot');
        
        let currentIndex = 0;
        const itemsPerView = window.innerWidth >= 1024 ? 3 : window.innerWidth >= 768 ? 2 : 1;
        const totalItems = document.querySelectorAll('.carousel-item').length;

        function updateCarousel() {
            const translateX = -currentIndex * (100 / itemsPerView);
            carouselTrack.style.transform = `translateX(${translateX}%)`;

            // Update dots
            dots.forEach((dot, index) => {
                dot.classList.toggle('bg-cyan-500', index === currentIndex);
                dot.classList.toggle('bg-gray-600', index !== currentIndex);
            });
        }

        prevBtn.addEventListener('click', () => {
            currentIndex = Math.max(0, currentIndex - 1);
            updateCarousel();
        });

        nextBtn.addEventListener('click', () => {
            const maxIndex = Math.max(0, totalItems - itemsPerView);
            currentIndex = Math.min(maxIndex, currentIndex + 1);
            updateCarousel();
        });

        // Dots click
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentIndex = index;
                updateCarousel();
            });
        });

        // ===== FLOATING WINDOW DRAGGABLE =====
        const floatingWindow = document.getElementById('floatingWindow');
        const floatingHeader = document.getElementById('floatingHeader');
        const closeButton = document.getElementById('closeFloating');
        
        let isDragging = false;
        let offsetX = 0;
        let offsetY = 0;

        floatingHeader.addEventListener('mousedown', (e) => {
            isDragging = true;
            floatingWindow.classList.add('dragging');
            offsetX = e.clientX - floatingWindow.offsetLeft;
            offsetY = e.clientY - floatingWindow.offsetTop;
        });

        document.addEventListener('mousemove', (e) => {
            if (isDragging) {
                floatingWindow.style.position = 'fixed';
                floatingWindow.style.left = (e.clientX - offsetX) + 'px';
                floatingWindow.style.top = (e.clientY - offsetY) + 'px';
                floatingWindow.style.right = 'auto';
                floatingWindow.style.bottom = 'auto';
            }
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
            floatingWindow.classList.remove('dragging');
        });

        closeButton.addEventListener('click', () => {
            floatingWindow.style.display = 'none';
        });

        // ===== NAV SCROLL =====
        window.addEventListener('scroll', () => {
            const nav = document.querySelector('nav');
            if (window.scrollY > 50) {
                nav.classList.add('bg-black/95');
            } else {
                nav.classList.remove('bg-black/95');
            }
        });
    </script>
</body>
</html>