<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Ice Stream') }} - @yield('page_title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
</head>
<body class="bg-black text-white min-h-screen">
    <div class="min-h-screen bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 py-6 sm:px-6 lg:px-8">
            <header class="mb-8">
                <h1 class="text-2xl font-bold tracking-tight text-white">@yield('page_title')</h1>
            </header>

            <main class="space-y-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>