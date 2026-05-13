<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My List - Ice Stream</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen">
    <nav class="border-b border-gray-800 px-6 py-4 flex items-center justify-between max-w-5xl mx-auto">
        <a href="{{ route('landing') }}" class="flex items-center gap-2">
            <span class="text-xl">❄️</span>
            <span class="font-bold bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">ICE STREAM</span>
        </a>
        <div class="flex gap-4 text-sm">
            <a href="{{ route('videos.index') }}" class="text-gray-400 hover:text-white">Browse</a>
            @auth
                <form method="POST" action="{{ route('logout') }}" class="inline">@csrf<button type="submit" class="text-gray-400 hover:text-white">Logout</button></form>
            @else
                <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-300">Login</a>
            @endauth
        </div>
    </nav>
    <main class="max-w-3xl mx-auto px-6 py-16 text-center">
        <h1 class="text-3xl font-bold mb-4">My List</h1>
        <p class="text-gray-400 mb-8">Saved titles will appear here. For now, browse the catalog and pick something to watch.</p>
        <a href="{{ route('videos.index') }}" class="inline-block bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 px-8 py-3 rounded-lg font-semibold">Browse videos</a>
    </main>
</body>
</html>
