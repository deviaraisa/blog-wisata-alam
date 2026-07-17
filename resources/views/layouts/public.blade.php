<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Explore Aceh') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-800">

    {{-- ===================== NAVBAR ===================== --}}
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 gap-4">
                <a href="{{ route('home') }}" class="flex items-center gap-2 shrink-0">
                    <svg class="h-7 w-7 text-green-700" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L2 20h20L12 2z" fill="currentColor"/>
                        <path d="M9 20l3-6 3 6" stroke="white" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div class="leading-tight">
                        <div class="font-bold text-gray-900">Explore Aceh</div>
                        <div class="text-[11px] text-gray-400 hidden sm:block">Jelajahi Keindahan Alam Aceh</div>
                    </div>
                </a>

                <div class="hidden md:flex items-center gap-6 text-sm font-medium text-gray-600">
                    <a href="{{ route('home') }}" class="hover:text-green-700 {{ request()->routeIs('home') ? 'text-green-700' : '' }}">Beranda</a>
                    <a href="{{ route('home') }}#destinasi" class="hover:text-green-700">Destinasi</a>
                    <a href="{{ route('home') }}#artikel" class="hover:text-green-700 {{ request()->routeIs('articles.show') ? 'text-green-700' : '' }}">Artikel</a>
                    <a href="{{ route('home') }}" class="hover:text-green-700">Tentang Aceh</a>
                </div>

                <form action="{{ route('home') }}" method="GET" class="hidden lg:flex items-center flex-1 max-w-xs">
                    <div class="relative w-full">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10.5A6.5 6.5 0 114 10.5a6.5 6.5 0 0113 0z" />
                        </svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel wisata..."
                            class="w-full pl-9 pr-3 py-2 text-sm border border-gray-200 rounded-full focus:border-green-600 focus:ring-green-600">
                    </div>
                </form>

                <div class="flex items-center gap-2 shrink-0">
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 text-sm font-medium text-gray-700 border border-gray-200 rounded-full hover:border-green-600 hover:text-green-700 transition">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 border border-gray-200 rounded-full hover:border-green-600 hover:text-green-700 transition">Masuk</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 text-sm font-medium text-white bg-green-700 rounded-full hover:bg-green-800 transition">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- ===================== CONTENT ===================== --}}
    <main>
        {{ $slot }}
    </main>

    {{-- ===================== FOOTER ===================== --}}
    <footer class="bg-gray-900 text-gray-300 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <svg class="h-6 w-6 text-green-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L2 20h20L12 2z"/></svg>
                    <span class="font-bold text-white">Explore Aceh</span>
                </div>
                <p class="text-sm text-gray-400">Jelajahi keindahan alam Aceh lewat informasi dan cerita perjalanan terbaik.</p>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Menu</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('home') }}#destinasi" class="hover:text-white">Destinasi</a></li>
                    <li><a href="{{ route('home') }}#artikel" class="hover:text-white">Artikel</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Kategori</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    @foreach(\App\Models\Category::take(4)->get() as $footerCategory)
                        <li><a href="{{ route('home', ['category' => $footerCategory->id]) }}" class="hover:text-white">{{ $footerCategory->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-3">Kontak</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li>exploreaceh@gmail.com</li>
                    <li>@exploreaceh</li>
                    <li>Aceh, Indonesia</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 py-4 text-center text-xs text-gray-500">
            &copy; {{ date('Y') }} Explore Aceh. Semua hak dilindungi.
        </div>
    </footer>
</body>
</html>
