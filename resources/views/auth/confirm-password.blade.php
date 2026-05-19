<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Password - Ice Stream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white min-h-screen flex flex-col justify-between">
    <main class="flex-1 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md rounded-2xl border border-gray-800 bg-gray-900/50 p-8 backdrop-blur-sm">
            <h1 class="text-xl font-bold mb-3 text-center text-cyan-400">Security Check</h1>
            <p class="text-sm text-gray-400 mb-6 text-center leading-relaxed">
                This is a secure area of the application. Please confirm your password before continuing.
            </p>

            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-900/40 border border-red-700 px-4 py-3 text-sm text-red-200">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
                @csrf

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm text-gray-400 mb-1">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password" autofocus
                        class="w-full rounded-lg bg-black border border-gray-700 px-4 py-2 text-white focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 transition">
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 py-3 rounded-lg font-semibold shadow-lg shadow-cyan-500/20 active:scale-[0.99] transition duration-150 mt-2">
                    Confirm Password
                </button>
            </form>
        </div>
    </main>
</body>
</html>