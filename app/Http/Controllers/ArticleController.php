<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    // Menampilkan semua artikel milik user yang login
    public function index()
    {
        $articles = Article::where('user_id', Auth::id())->latest()->get();
        return view('articles.index', compact('articles'));
    }

    // Menampilkan form tambah artikel
    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return view('articles.create', compact('categories'));
    }

    // Menyimpan artikel baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Article::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
            'status' => $request->status,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil ditambahkan!');
    }

    // Menampilkan detail artikel (untuk publik)
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    // Menampilkan form edit artikel
    public function edit(Article $article)
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return view('articles.edit', compact('article', 'categories'));
    }

    // Update artikel
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $thumbnailPath = $article->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($thumbnailPath) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $article->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . uniqid(),
            'content' => $request->input('content'),
            'thumbnail' => $thumbnailPath,
            'status' => $request->status,
        ]);

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    // Hapus artikel
    public function destroy(Article $article)
    {
        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }
        $article->delete();

        return redirect()->route('articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}