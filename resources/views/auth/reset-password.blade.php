<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password - Ice Stream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white min-h-screen flex flex-col justify-between">
    <main class="flex-1 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md rounded-2xl border border-gray-800 bg-gray-900/50 p-8 backdrop-blur-sm">
            <h1 class="text-2xl font-bold mb-6 text-center text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">Create New Password</h1>
            
            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-900/40 border border-red-700 px-4 py-3 text-sm text-red-200">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm text-gray-400 mb-1">Email Address</label>
                    <input id="email" name="email" type="email" value="{{ old('email', $request->email) }}" required autocomplete="username" readonly
                        class="w-full rounded-lg bg-black/60 border border-gray-800 px-4 py-2 text-gray-500 focus:outline-none cursor-not-allowed">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm text-gray-400 mb-1">New Password</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password" autofocus
                        class="w-full rounded-lg bg-black border border-gray-700 px-4 py-2 text-white focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 transition">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm text-gray-400 mb-1">Confirm New Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                        class="w-full rounded-lg bg-black border border-gray-700 px-4 py-2 text-white focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 transition">
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 py-3 rounded-lg font-semibold shadow-lg shadow-cyan-500/20 active:scale-[0.99] transition duration-150 mt-2">
                    Reset Password
                </button>
            </form>
        </div>
    </main>
</body>
</html>