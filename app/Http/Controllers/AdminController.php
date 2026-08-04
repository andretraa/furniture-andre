<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Tampilkan Ringkasan Dashboard Admin.
     */
    public function dashboard()
    {
        $totalArticles = Article::count();
        $featuredArticlesCount = Article::where('is_featured', true)->count();
        $totalUsers = User::count();
        $adminCount = User::where('role', 'admin')->count();

        $recentArticles = Article::orderBy('created_at', 'desc')->take(5)->get();
        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();

        return view('admin.dashboard', [
            'totalArticles' => $totalArticles,
            'featuredArticlesCount' => $featuredArticlesCount,
            'totalUsers' => $totalUsers,
            'adminCount' => $adminCount,
            'recentArticles' => $recentArticles,
            'recentUsers' => $recentUsers,
        ]);
    }

    /**
     * Tampilkan Daftar Artikel untuk Kelola Admin.
     */
    public function articles(Request $request)
    {
        $query = Article::query()->orderBy('created_at', 'desc');

        if ($request->filled('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        $articles = $query->paginate(10)->withQueryString();
        $categories = ['All', 'Profil Perusahaan', 'Panduan Kayu', 'Desain Interior', 'Tips & Trik'];

        return view('admin.articles.index', [
            'articles' => $articles,
            'categories' => $categories,
            'selectedCategory' => $request->get('category', 'All'),
            'searchQuery' => $request->get('q', ''),
        ]);
    }

    /**
     * Form Tambah Artikel Baru.
     */
    public function createArticle()
    {
        $categories = ['Profil Perusahaan', 'Panduan Kayu', 'Desain Interior', 'Tips & Trik'];
        return view('admin.articles.create', compact('categories'));
    }

    /**
     * Simpan Artikel Baru ke Database.
     */
    public function storeArticle(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'image_url' => 'required|string|url',
            'author' => 'required|string|max:255',
            'read_time' => 'required|string|max:50',
            'is_featured' => 'nullable|boolean',
        ], [
            'title.required' => 'Judul artikel wajib diisi.',
            'category.required' => 'Kategori wajib dipilih.',
            'excerpt.required' => 'Ringkasan singkat wajib diisi.',
            'content.required' => 'Konten artikel wajib diisi.',
            'image_url.required' => 'URL gambar header wajib diisi.',
            'image_url.url' => 'Format URL gambar tidak valid.',
            'author.required' => 'Nama penulis wajib diisi.',
            'read_time.required' => 'Estimasi waktu baca wajib diisi.',
        ]);

        $baseSlug = Str::slug($validated['title']);
        $slug = $baseSlug;
        $count = 1;
        while (Article::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        Article::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'image_url' => $validated['image_url'],
            'author' => $validated['author'],
            'read_time' => $validated['read_time'],
            'is_featured' => $request->has('is_featured'),
            'published_at' => now(),
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel "' . $validated['title'] . '" berhasil ditambahkan!');
    }

    /**
     * Form Edit Artikel.
     */
    public function editArticle(Article $article)
    {
        $categories = ['Profil Perusahaan', 'Panduan Kayu', 'Desain Interior', 'Tips & Trik'];
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    /**
     * Update Artikel yang Sudah Ada.
     */
    public function updateArticle(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'image_url' => 'required|string|url',
            'author' => 'required|string|max:255',
            'read_time' => 'required|string|max:50',
            'is_featured' => 'nullable|boolean',
        ], [
            'title.required' => 'Judul artikel wajib diisi.',
            'category.required' => 'Kategori wajib dipilih.',
            'excerpt.required' => 'Ringkasan singkat wajib diisi.',
            'content.required' => 'Konten artikel wajib diisi.',
            'image_url.required' => 'URL gambar header wajib diisi.',
            'image_url.url' => 'Format URL gambar tidak valid.',
            'author.required' => 'Nama penulis wajib diisi.',
            'read_time.required' => 'Estimasi waktu baca wajib diisi.',
        ]);

        if ($article->title !== $validated['title']) {
            $baseSlug = Str::slug($validated['title']);
            $slug = $baseSlug;
            $count = 1;
            while (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }
            $article->slug = $slug;
        }

        $article->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'image_url' => $validated['image_url'],
            'author' => $validated['author'],
            'read_time' => $validated['read_time'],
            'is_featured' => $request->has('is_featured'),
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel "' . $article->title . '" berhasil diperbarui!');
    }

    /**
     * Hapus Artikel.
     */
    public function destroyArticle(Article $article)
    {
        $title = $article->title;
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel "' . $title . '" berhasil dihapus.');
    }

    /**
     * Tampilkan Daftar Pengguna Terdaftar.
     */
    public function users(Request $request)
    {
        $query = User::query()->orderBy('created_at', 'desc');

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role') && in_array($request->role, ['user', 'admin'])) {
            $query->where('role', $request->role);
        }

        $users = $query->paginate(15)->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
            'searchQuery' => $request->get('q', ''),
            'selectedRole' => $request->get('role', 'all'),
        ]);
    }

    /**
     * Ubah Role Pengguna (Admin <-> User).
     */
    public function toggleUserRole(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('info', 'Anda tidak dapat mengubah peran akun Anda sendiri.');
        }

        $user->role = ($user->role === 'admin') ? 'user' : 'admin';
        $user->save();

        return back()->with('success', 'Peran pengguna ' . $user->name . ' berhasil diperbarui menjadi ' . strtoupper($user->role) . '.');
    }
}
