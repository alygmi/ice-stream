<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Ice Stream Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-slate-950 via-slate-900 to-black text-white">
    <!-- Sidebar Navigation -->
    <div class="fixed left-0 top-0 h-screen w-64 bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 border-r border-cyan-500/20 z-50">
        <!-- Logo -->
        <div class="p-6 border-b border-cyan-500/20">
            <a href="/admin" class="flex items-center gap-3 hover:opacity-80 transition">
                <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">❄️</span>
                </div>
                <div>
                    <p class="text-lg font-bold bg-gradient-to-r from-cyan-400 to-blue-600 bg-clip-text text-transparent">
                        ICE STREAM
                    </p>
                    <p class="text-xs text-gray-500">Admin Panel</p>
                </div>
            </a>
        </div>

        <!-- Navigation Menu -->
        <nav class="p-4 space-y-2">
            <a href="/admin/dashboard" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->is('admin') ? 'bg-cyan-600/20 border-l-2 border-cyan-400' : 'hover:bg-slate-700/50 text-gray-400' }} transition">
                <span class="text-xl"></span>
                <span>Dashboard</span>
            </a>
            <a href="/admin/videos" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->is('admin/videos*') ? 'bg-cyan-600/20 border-l-2 border-cyan-400' : 'hover:bg-slate-700/50 text-gray-400' }} transition">
                <span class="text-xl"></span>
                <span>Videos</span>
            </a>
            <a href="/admin/categories" class="flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->is('admin/categories*') ? 'bg-cyan-600/20 border-l-2 border-cyan-400' : 'hover:bg-slate-700/50 text-gray-400' }} transition">
                <span class="text-xl"></span>
                <span>Categories</span>
            </a>
        </nav>

        <!-- Logout -->
        <div class="absolute bottom-6 left-4 right-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg bg-red-600/20 hover:bg-red-600/30 text-red-400 transition border border-red-500/30">
                    <span class="text-xl"></span>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="ml-64">
        <!-- Top Bar -->
        <div class="bg-slate-900/50 border-b border-cyan-500/20 backdrop-blur-md sticky top-0 z-40">
            <div class="px-8 py-4 flex items-center justify-between">
                <h1 class="text-2xl font-bold">@yield('page-title', 'Dashboard')</h1>
                <div class="flex items-center gap-4">
                    <a href="/" class="text-gray-400 hover:text-cyan-400 transition flex items-center gap-2">
                        <span></span>
                        <span>Back to Home</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-8">
            @if ($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-600/20 border border-red-500/50">
                    <p class="text-red-400 font-semibold mb-2">⚠️ Errors:</p>
                    <ul class="text-red-300 text-sm space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="mb-6 p-4 rounded-lg bg-green-600/20 border border-green-500/50 flex items-center justify-between">
                    <span class="text-green-400">✅ {{ session('success') }}</span>
                    <button onclick="this.parentElement.style.display='none'" class="text-green-400 hover:text-green-300">✕</button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <style>
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-in {
            animation: slideIn 0.3s ease-out;
        }
    </style>
</body>
</html>