<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TOKOE</title>
    @if (file_exists(public_path('build/manifest.json')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@else
    <link rel="stylesheet" href="{{ asset('tailwind.css') }}">
@endif

    {{-- ICON --}}
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/3081/3081648.png">
</head>

<body class="bg-gray-100 dark:bg-gray-900">

    {{-- NAVBAR PREMIUM --}}
    <nav class="bg-white dark:bg-gray-800 shadow-lg sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">

            <h1 class="text-2xl font-extrabold text-indigo-600 flex items-center gap-2">
                🛒 TOKOE <span class="text-gray-500 text-lg font-medium">Premium</span>
            </h1>

            <div class="flex items-center gap-4">

                {{-- SEARCH BAR --}}
                <form action="/produk/cari" method="GET">
                    <input type="text" name="q"
                        placeholder="Cari produk terbaik…"
                        class="px-4 py-2 rounded-xl shadow border-gray-300 dark:bg-gray-700 dark:text-white w-64">
                </form>

                {{-- ICONS --}}
                <div class="flex items-center gap-4 text-xl">
                    <a href="#" class="hover:text-indigo-600">❤️</a>
                    <a href="#" class="hover:text-indigo-600">🛒</a>
                    <a href="#" class="hover:text-indigo-600">👤</a>
                </div>
            </div>

        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <div class="container mx-auto py-10 px-6 
    bg-white/30 dark:bg-gray-800/30 
    backdrop-blur-xl shadow-2xl 
    rounded-3xl border border-white/20">
    @yield('content')
</div>

    </div>
</body>

</html>
