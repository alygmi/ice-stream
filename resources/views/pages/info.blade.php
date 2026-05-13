<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} - Ice Stream</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen">
    <nav class="border-b border-gray-800 px-6 py-4">
        <div class="max-w-3xl mx-auto flex items-center justify-between">
            <a href="{{ route('landing') }}" class="text-cyan-400 hover:text-cyan-300 text-sm font-medium">← Back to home</a>
            <a href="{{ route('videos.index') }}" class="text-gray-400 hover:text-white text-sm">Browse</a>
        </div>
    </nav>
    <main class="max-w-3xl mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold mb-6 bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent">{{ $heading }}</h1>
        <div class="prose prose-invert prose-gray max-w-none text-gray-300 leading-relaxed space-y-4">
            {!! nl2br(e($body)) !!}
        </div>
    </main>
</body>
</html>
