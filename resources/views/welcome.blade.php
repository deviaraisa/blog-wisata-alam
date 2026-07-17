<x-public-layout>

    {{-- ===================== HERO ===================== --}}
    <section class="relative">
        <div class="h-[420px] md:h-[480px] w-full overflow-hidden bg-gradient-to-br from-green-800 to-sky-700">
            <img src="{{ asset('images/hero.jpg') }}"
                 alt="Wisata Alam Aceh"
                 class="w-full h-full object-cover opacity-80">
        </div>
        <div class="absolute inset-0 flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                <div class="max-w-xl">
                    <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight drop-shadow-sm">
                        Jelajahi Keindahan Wisata Alam Aceh
                    </h1>
                    <p class="mt-4 text-gray-100 text-sm md:text-base drop-shadow-sm">
                        Temukan informasi, pengalaman perjalanan, dan rekomendasi destinasi terbaik mulai dari pantai,
                        pegunungan, danau, hingga air terjun yang memukau di Aceh.
                    </p>
                    <div class="mt-6 flex flex-wrap gap-3">
                        <a href="#artikel" class="px-5 py-2.5 bg-green-700 text-white text-sm font-medium rounded-lg hover:bg-green-800 transition">
                            Jelajahi Destinasi
                        </a>
                        <a href="#artikel" class="px-5 py-2.5 bg-white text-gray-800 text-sm font-medium rounded-lg hover:bg-gray-100 transition">
                            Baca Artikel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===================== SEARCH + FILTER BAR ===================== --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
        <div class="bg-white rounded-xl shadow-md border border-gray-100 p-4 flex flex-col md:flex-row gap-3 md:items-center">
            <form action="{{ route('home') }}" method="GET" class="relative flex-1">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10.5A6.5 6.5 0 114 10.5a6.5 6.5 0 0113 0z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel wisata..."
                    class="w-full pl-9 pr-3 py-2.5 text-sm border border-gray-200 rounded-full focus:border-green-600 focus:ring-green-600">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
            </form>

            <div class="flex flex-wrap gap-2">
                <a href="{{ route('home', array_filter(['search' => request('search')])) }}#artikel"
                   class="px-4 py-2 rounded-full text-sm font-medium transition {{ !request('category') ? 'bg-green-700 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('home', array_filter(['search' => request('search'), 'category' => $cat->id])) }}#artikel"
                       class="px-4 py-2 rounded-full text-sm font-medium transition {{ (string) request('category') === (string) $cat->id ? 'bg-green-700 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ===================== KATEGORI (dengan foto) ===================== --}}
    @if($categories->count())
    <section id="destinasi" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
        <h2 class="text-xl font-bold text-gray-900 mb-5">Kategori Wisata</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-5">
            @foreach($categories as $cat)
                @php
                    $representative = $cat->articles->where('status', 'published')->whereNotNull('thumbnail')->first();
                @endphp
                <a href="{{ route('home', ['category' => $cat->id]) }}#artikel"
                   class="group rounded-xl overflow-hidden border border-gray-100 bg-white hover:shadow-lg transition">
                    <div class="h-32 w-full bg-gray-100 overflow-hidden">
                        @if($representative)
                            <img src="{{ asset('storage/' . $representative->thumbnail) }}" alt="{{ $cat->name }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-green-600 to-sky-600 text-white">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="font-semibold text-gray-900 group-hover:text-green-700 transition">{{ $cat->name }}</div>
                        @if($cat->description)
                            <p class="text-xs text-gray-500 mt-1 line-clamp-2">{{ $cat->description }}</p>
                        @endif
                        <div class="mt-2 text-xs text-gray-400">{{ $cat->articles->where('status', 'published')->count() }} artikel</div>
                        <span class="inline-block mt-2 text-xs font-medium text-green-700">Lihat Destinasi &rarr;</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ===================== ARTIKEL TERBARU ===================== --}}
    <section id="artikel" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-14 mb-16">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-xl font-bold text-gray-900">
                @if(request('search') || request('category'))
                    Hasil Pencarian
                @else
                    Artikel Terbaru
                @endif
            </h2>
            <span class="text-sm text-gray-400">{{ $articles->count() }} artikel</span>
        </div>

        @if($articles->isEmpty())
            <div class="text-center py-20 bg-white rounded-xl border border-gray-100">
                <p class="text-gray-500">Belum ada artikel yang cocok. Coba kata kunci atau kategori lain.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($articles as $article)
                    <a href="{{ route('articles.show', $article->slug) }}"
                       class="bg-white rounded-xl overflow-hidden border border-gray-100 hover:shadow-lg transition group">
                        <div class="h-44 w-full bg-gray-100 overflow-hidden">
                            @if($article->thumbnail)
                                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-300">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M4 8h16M4 4h16v16H4V4z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 leading-snug group-hover:text-green-700 transition">
                                {{ $article->title }}
                            </h3>
                            <div class="mt-2 flex items-center gap-2 text-xs text-gray-400">
                                <span>{{ $article->user->name }}</span>
                                <span>&middot;</span>
                                <span>{{ $article->category->name }}</span>
                                <span>&middot;</span>
                                <span>{{ $article->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                            <p class="mt-2 text-sm text-gray-500 line-clamp-2">
                                {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            <span class="inline-block mt-3 text-sm font-medium text-green-700">Baca Selengkapnya &rarr;</span>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

</x-public-layout>
