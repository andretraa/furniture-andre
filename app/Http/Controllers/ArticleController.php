<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Tampilkan daftar artikel & berita inspirasi perusahan.
     */
    public function index(Request $request)
    {
        $query = Article::query()->orderBy('published_at', 'desc');

        // Filter kategori artikel
        if ($request->has('category') && $request->category !== 'All' && !empty($request->category)) {
            $query->where('category', $request->category);
        }

        // Pencarian artikel
        if ($request->has('q') && !empty($request->q)) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $articles = $query->get();

        $categories = ['All', 'Profil Perusahaan', 'Panduan Kayu', 'Desain Interior', 'Tips & Trik'];
        $featuredArticles = Article::where('is_featured', true)->take(2)->get();

        return view('articles.index', [
            'articles' => $articles,
            'featuredArticles' => $featuredArticles,
            'categories' => $categories,
            'selectedCategory' => $request->get('category', 'All'),
            'searchQuery' => $request->get('q', ''),
        ]);
    }

    /**
     * Tampilkan detail isi artikel.
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $relatedArticles = Article::where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('articles.show', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
        ]);
    }
}
