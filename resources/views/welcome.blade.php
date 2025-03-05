<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManWeb</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-white">
    <div class="min-h-screen flex flex-col">
        <header class="w-full py-4 px-6 bg-white shadow-md dark:bg-gray-800 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-12 w-auto">
                <span class="text-lg font-semibold">M a n W e b</span>
            </div>
            @if (Route::has('login'))
                <nav class="flex gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-700 hover:text-gray-900 dark:text-white dark:hover:text-gray-300">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 dark:text-white dark:hover:text-gray-300">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900 dark:text-white dark:hover:text-gray-300">Register</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="flex-1 flex flex-col items-center justify-center text-center px-6">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di ManWeb</h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl">Tempat terbaik untuk menemukan inspirasi, berbagi ide, dan membangun sesuatu yang luar biasa.</p>
            <a href="login" class="mt-6 px-6 py-3 bg-[#FF2D20] text-white text-lg rounded-lg shadow-lg hover:bg-red-600 transition">Jelajahi Sekarang</a>
        </main>

        <footer class="w-full py-6 text-center text-sm bg-gray-100 dark:bg-gray-800 dark:text-gray-400">
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>
</body>
</html>
