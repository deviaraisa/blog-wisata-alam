<x-public-layout>
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <a href="{{ route('home') }}" class="text-sm text-green-700 hover:underline inline-flex items-center gap-1 mb-6">
            &larr; Kembali ke Beranda
        </a>

        <span class="inline-block px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs font-medium mb-3">
            {{ $article->category->name }}
        </span>

        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 leading-tight">
            {{ $article->title }}
        </h1>

        <div class="mt-3 flex items-center gap-2 text-sm text-gray-400">
            <span>{{ $article->user->name }}</span>
            <span>&middot;</span>
            <span>{{ $article->created_at->translatedFormat('d M Y') }}</span>
        </div>

        @if($article->thumbnail)
            <div class="mt-6 rounded-xl overflow-hidden bg-gray-100">
                <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}"
                     class="w-full max-h-[420px] object-cover">
            </div>
        @endif

        <div class="prose prose-gray max-w-none mt-8 whitespace-pre-line leading-relaxed text-gray-700">
            {{ $article->content }}
        </div>

        <div class="mt-10 pt-6 border-t border-gray-100">
            <a href="{{ route('home', ['category' => $article->category_id]) }}"
               class="text-sm font-medium text-green-700 hover:underline">
                Lihat artikel lain di kategori {{ $article->category->name }} &rarr;
            </a>
        </div>
    </div>
</x-public-layout>
