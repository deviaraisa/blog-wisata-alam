<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kategori Saya') }}
            </h2>
            <a href="{{ route('categories.create') }}"
               class="px-4 py-2 bg-green-700 text-white text-sm font-medium rounded-lg hover:bg-green-800 transition">
                + Tambah Kategori
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-lg overflow-hidden">
                @if($categories->isEmpty())
                    <div class="p-10 text-center text-gray-500">
                        Kamu belum punya kategori. <a href="{{ route('categories.create') }}" class="text-green-700 font-medium hover:underline">Tambah kategori pertama</a>.
                    </div>
                @else
                    <table class="min-w-full divide-y divide-gray-100 text-sm">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                            <tr>
                                <th class="px-6 py-3 text-left">Nama</th>
                                <th class="px-6 py-3 text-left">Deskripsi</th>
                                <th class="px-6 py-3 text-left">Jumlah Artikel</th>
                                <th class="px-6 py-3 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($categories as $category)
                                <tr>
                                    <td class="px-6 py-4 font-medium text-gray-800">{{ $category->name }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $category->description ? \Illuminate\Support\Str::limit($category->description, 60) : '-' }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $category->articles()->count() }}</td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end gap-2">
                                            <a href="{{ route('categories.edit', $category) }}"
                                               class="px-3 py-1.5 text-xs font-medium text-gray-600 border border-gray-200 rounded-md hover:bg-gray-50">
                                                Edit
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                                  onsubmit="return confirm('Hapus kategori ini? Artikel terkait juga akan terhapus.');">
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
