<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nanami Komik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-900 text-white font-sans">

    <nav class="bg-black p-4 md:px-8 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
            <a href="/" class="text-teal-400 text-xl md:text-2xl font-bold tracking-widest">Nanami</a>
            <div class="hidden md:flex items-center gap-5 text-sm">
                <a href="/browse" class="text-gray-300 hover:text-white transition">BROWSE</a>
                <a href="/library" class="text-gray-300 hover:text-white transition">MY LIBRARY</a>
            </div>
            <div class="flex items-center gap-3">
                <button id="mobile-menu-toggle" class="md:hidden text-teal-400" type="button">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <a href="/login" class="bg-teal-500 hover:bg-teal-400 text-black px-4 py-2 rounded font-semibold text-sm">LOGIN</a>
            </div>
        </div>
        <div id="mobile-menu" class="md:hidden hidden border-t border-gray-700 mt-3 pt-3">
            <a href="/browse" class="block text-gray-300 hover:text-white py-2 transition">BROWSE</a>
            <a href="/library" class="block text-gray-300 hover:text-white py-2 transition">MY LIBRARY</a>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 py-6">
        @yield('content')
    </div>

    <script>
        document.getElementById('mobile-menu-toggle')?.addEventListener('click', function () {
            document.getElementById('mobile-menu')?.classList.toggle('hidden');
        });
    </script>

</body>
</html>
