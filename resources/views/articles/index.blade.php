<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Artikel Saya') }}
            </h2>
            <a href="{{ route('articles.create') }}"
               class="px-4 py-2 bg-green-700 text-white text-sm font-medium rounded-lg hover:bg-green-800 transition">
                + Tulis Artikel
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                @if($articles->isEmpty())
                    <div class="p-10 text-center text-gray-500">
                        Kamu belum punya artikel. <a href="{{ route('articles.create') }}" class="text-green-700 font-medium hover:underline">Tulis artikel pertamamu</a>.
                    </div>
                @else
                    <table class="min-w-full divide-y divide-gray-100 text-sm">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                            <tr>
                                <th class="px-6 py-3 text-left">Judul</th>
                                <th class="px-6 py-3 text-left">Kategori</th>
                                <th class="px-6 py-3 text-left">Status</th>
                                <th class="px-6 py-3 text-left">Tanggal</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($articles as $article)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden shrink-0">
                                                @if($article->thumbnail)
                                                    <img src="{{ asset('storage/' . $article->thumbnail) }}" class="w-full h-full object-cover">
                                                @endif
                                            </div>
                                            <span class="font-medium text-gray-800">{{ $article->title }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">{{ $article->category->name ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        @if($article->status === 'published')
                                            <span class="px-2 py-1 rounded-full bg-green-50 text-green-700 text-xs font-medium">Dipublikasi</span>
                                        @else
                                            <span class="px-2 py-1 rounded-full bg-yellow-50 text-yellow-700 text-xs font-medium">Draft</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">{{ $article->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('articles.edit', $article) }}"
                                               class="px-3 py-1.5 text-xs font-medium text-gray-600 border border-gray-200 rounded-md hover:bg-gray-50">
                                                Edit
                                            </a>
                                            <form action="{{ route('articles.destroy', $article) }}" method="POST"
                                                  onsubmit="return confirm('Hapus artikel ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="px-3 py-1.5 text-xs font-medium text-red-600 border border-red-200 rounded-md hover:bg-red-50">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
