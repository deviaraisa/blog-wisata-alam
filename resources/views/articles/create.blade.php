<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tulis Artikel Baru') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">

                @if($categories->isEmpty())
                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 text-sm px-4 py-3 rounded-lg mb-6">
                        Kamu belum punya kategori. <a href="{{ route('categories.create') }}" class="font-medium underline">Buat kategori dulu</a> sebelum menulis artikel.
                    </div>
                @endif

                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="title" value="Judul Artikel" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                      value="{{ old('title') }}" required autofocus />
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="category_id" value="Kategori" />
                        <select id="category_id" name="category_id" required
                                class="mt-1 block w-full border-gray-300 focus:border-green-600 focus:ring-green-600 rounded-md shadow-sm">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="content" value="Konten Artikel" />
                        <textarea id="content" name="content" rows="10" required
                                  class="mt-1 block w-full border-gray-300 focus:border-green-600 focus:ring-green-600 rounded-md shadow-sm">{{ old('content') }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="thumbnail" value="Thumbnail (opsional)" />
                        <input id="thumbnail" name="thumbnail" type="file" accept="image/png, image/jpeg, image/jpg"
                               class="mt-1 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:bg-green-50 file:text-green-700 hover:file:bg-green-100" />
                        <p class="text-xs text-gray-400 mt-1">Format JPG/PNG, maksimal 2MB.</p>
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="status" value="Status" />
                        <select id="status" name="status" required
                                class="mt-1 block w-full border-gray-300 focus:border-green-600 focus:ring-green-600 rounded-md shadow-sm">
                            <option value="draft" @selected(old('status') == 'draft')>Draft</option>
                            <option value="published" @selected(old('status') == 'published')>Dipublikasi</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <x-primary-button>Simpan Artikel</x-primary-button>
                        <a href="{{ route('articles.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
