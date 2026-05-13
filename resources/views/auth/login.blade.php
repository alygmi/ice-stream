<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ice Stream</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white min-h-screen flex flex-col">
    <nav class="border-b border-gray-800 px-6 py-4 flex justify-between max-w-lg mx-auto w-full">
        <a href="{{ route('landing') }}" class="text-cyan-400 text-sm hover:underline">← Home</a>
        <a href="{{ route('videos.index') }}" class="text-gray-400 text-sm hover:text-white">Browse</a>
    </nav>
    <main class="flex-1 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md rounded-2xl border border-gray-800 bg-gray-900/50 p-8">
            <h1 class="text-2xl font-bold mb-6 text-center">Sign in</h1>
            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-900/40 border border-red-700 px-4 py-3 text-sm text-red-200">
                    {{ $errors->first() }}
                </div>
            @endif
            <form method="POST" action="{{ route('login.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="block text-sm text-gray-400 mb-1">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                        class="w-full rounded-lg bg-black border border-gray-700 px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
                </div>
                <div>
                    <label for="password" class="block text-sm text-gray-400 mb-1">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="w-full rounded-lg bg-black border border-gray-700 px-4 py-2 text-white focus:border-cyan-500 focus:outline-none">
                </div>
                <label class="flex items-center gap-2 text-sm text-gray-400">
                    <input type="checkbox" name="remember" class="rounded border-gray-600"> Remember me
                </label>
                <button type="submit" class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 py-3 rounded-lg font-semibold">
                    Log in
                </button>
            </form>
        </div>
    </main>
</body>
</html>
