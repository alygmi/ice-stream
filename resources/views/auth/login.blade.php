<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ice Stream</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-white min-h-screen flex flex-col justify-between">

    <main class="flex-1 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md rounded-2xl border border-gray-800 bg-gray-900/50 p-8 backdrop-blur-sm">
            <h1 class="text-2xl font-bold mb-6 text-center text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">❄️ICESTREAM</h1>
            
            @if ($errors->any())
                <div class="mb-4 rounded-lg bg-red-900/40 border border-red-700 px-4 py-3 text-sm text-red-200">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('status'))
                <div class="mb-4 rounded-lg bg-green-900/40 border border-green-700 px-4 py-3 text-sm text-green-200">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm text-gray-400 mb-1">Email</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full rounded-lg bg-black border border-gray-700 px-4 py-2 text-white focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 transition">
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm text-gray-400 mb-1">Password</label>
                    <input id="password" name="password" type="password" required autocomplete="current-password"
                        class="w-full rounded-lg bg-black border border-gray-700 px-4 py-2 text-white focus:border-cyan-500 focus:outline-none focus:ring-1 focus:ring-cyan-500 transition">
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-gray-400 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="rounded border-gray-600 bg-black text-cyan-500 focus:ring-0 focus:ring-offset-0"> 
                        Remember me
                    </label>
                    
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:text-cyan-400 transition">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 py-3 rounded-lg font-semibold shadow-lg shadow-cyan-500/20 active:scale-[0.99] transition duration-150 mt-2">
                    Log in
                </button>
            </form>

            <!-- New Register Button/Link -->
            <div class="mt-6 pt-5 border-t border-gray-800 text-center text-sm text-gray-400">
                New to Ice Stream? 
                <a href="{{ route('register') }}" class="text-cyan-400 hover:underline font-medium">Create an account</a>
            </div>
        </div>
    </main>
</body>
</html>