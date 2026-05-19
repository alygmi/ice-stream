<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Ice Stream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white min-h-screen flex flex-col justify-between">
    <main class="flex-1 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md rounded-2xl border border-gray-800 bg-gray-900/50 p-8 backdrop-blur-sm">
            <h1 class="text-2xl font-bold mb-2 text-center text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">Create Account</h1>
            <p class="text-gray-400 text-sm text-center mb-6">Join Ice Stream to start tracking your movies.</p>
            
            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-900/40 border border-red-700 px-4 py-3 text-sm text-red-200">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm text-gray-400 mb-1">Full Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus autocomplete="name"
                        class="w-full rounded-lg bg-black border border-gray-700 px-4 py-2 text-white focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 transition">
                </div>

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm text-gray-400 mb-1">Email Address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="username"
                        class="w-full rounded-lg bg-black border border-gray-700 px-4 py-2 text-white focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 transition">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm text-gray-400 mb-1">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="new-password"
                        class="w-full rounded-lg bg-black border border-gray-700 px-4 py-2 text-white focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 transition">
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm text-gray-400 mb-1">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password"
                        class="w-full rounded-lg bg-black border border-gray-700 px-4 py-2 text-white focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 transition">
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 py-3 rounded-lg font-semibold shadow-lg shadow-cyan-500/20 active:scale-[0.99] transition duration-150 mt-4">
                    Register Account
                </button>
            </form>

            <div class="mt-6 pt-5 border-t border-gray-800 text-center text-sm text-gray-400">
                Already registered? 
                <a href="{{ route('login') }}" class="text-cyan-400 hover:underline font-medium">Log in instead</a>
            </div>
        </div>
    </main>
</body>
</html>