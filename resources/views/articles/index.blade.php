@extends('layouts.app')

@push('styles')
<style>
    .articles-hero {
        background: linear-gradient(135deg, rgba(28, 25, 23, 0.94) 0%, rgba(38, 35, 32, 0.88) 100%), url('https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
        border-radius: var(--radius-lg);
        padding: 4rem 2.5rem;
        color: #FFFFFF;
        margin-bottom: 3rem;
        box-shadow: var(--shadow-lg);
    }

    .articles-hero-content {
        max-width: 650px;
    }

    .articles-hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(197, 155, 39, 0.2);
        border: 1px solid rgba(197, 155, 39, 0.4);
        color: var(--accent-warm);
        padding: 0.4rem 1rem;
        border-radius: var(--radius-full);
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .articles-hero-title {
        font-size: 2.8rem;
        font-weight: 800;
        line-height: 1.2;
        margin-bottom: 1rem;
        letter-spacing: -0.5px;
    }

    .articles-hero-desc {
        color: #D6D3D1;
        font-size: 1.05rem;
        line-height: 1.6;
    }

    /* Article Search & Category Controls */
    .article-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
        flex-wrap: wrap;
    }

    .article-categories {
        display: flex;
        gap: 0.6rem;
        overflow-x: auto;
        padding-bottom: 0.4rem;
    }

    .article-cat-pill {
        padding: 0.55rem 1.3rem;
        border-radius: var(--radius-full);
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
        font-weight: 500;
        font-size: 0.88rem;
        text-decoration: none;
        white-space: nowrap;
        transition: var(--transition);
    }

    .article-cat-pill:hover, .article-cat-pill.active {
        background: var(--dark-primary);
        color: #FFFFFF;
        border-color: var(--dark-primary);
    }

    /* Article Grid */
    .article-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
        margin-bottom: 4rem;
    }

    .article-card {
        background: var(--bg-surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-color);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: var(--transition);
        box-shadow: var(--shadow-sm);
        text-decoration: none;
        color: inherit;
    }

    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-md);
        border-color: var(--accent-warm);
    }

    .article-img-wrap {
        position: relative;
        width: 100%;
        height: 220px;
        overflow: hidden;
    }

    .article-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .article-card:hover .article-img-wrap img {
        transform: scale(1.06);
    }

    .article-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: rgba(28, 25, 23, 0.85);
        backdrop-filter: blur(8px);
        color: var(--accent-warm);
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.35rem 0.85rem;
        border-radius: var(--radius-full);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .article-body {
        padding: 1.6rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .article-meta {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        font-size: 0.82rem;
        color: var(--text-muted);
        margin-bottom: 0.6rem;
    }

    .article-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
        line-height: 1.35;
        margin-bottom: 0.8rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .article-excerpt {
        font-size: 0.9rem;
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }

    .article-read-more {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--accent-warm);
        margin-top: auto;
    }

    @media (max-width: 768px) {
        .articles-hero {
            padding: 2.8rem 1.5rem;
        }
        .articles-hero-title {
            font-size: 2rem;
        }
        .article-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Header -->
<div class="articles-hero">
    <div class="articles-hero-content">
        <div class="articles-hero-tag"><i class="fa-solid fa-book-open"></i> Artikel & Profil Perusahaan</div>
        <h1 class="articles-hero-title">Inspirasi & Pengetahuan Furniture Kayu Jati</h1>
        <p class="articles-hero-desc">Pelajari dedikasi pengrajin DrewWood, panduan memilih kayu berkualitas ekspor, serta tren desain interior terdepan untuk hunian impian Anda.</p>
    </div>
</div>

<!-- Controls Bar (Category Filter) -->
<div class="article-controls">
    <div class="article-categories">
        @foreach($categories as $cat)
            <a href="{{ route('articles.index', ['category' => $cat, 'q' => request('q')]) }}" 
               class="article-cat-pill {{ $selectedCategory === $cat ? 'active' : '' }}">
                @if($cat === 'All') <i class="fa-solid fa-layer-group" style="margin-right: 4px;"></i> Semua Artikel
                @else {{ $cat }} @endif
            </a>
        @endforeach
    </div>
</div>

<!-- Article Grid -->
@if($articles->isEmpty())
    <div style="text-align: center; padding: 4rem 1rem; background: var(--bg-surface); border-radius: var(--radius-lg); border: 1px solid var(--border-color);">
        <i class="fa-regular fa-newspaper" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
        <h3>Artikel Tidak Ditemukan</h3>
        <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">Tidak ada artikel yang sesuai dengan pencarian atau kategori Anda.</p>
        <a href="{{ route('articles.index') }}" class="btn-nav-register" style="display: inline-block;">Lihat Semua Artikel</a>
    </div>
@else
    <div class="article-grid">
        @foreach($articles as $article)
            <a href="{{ route('articles.show', $article->slug) }}" class="article-card">
                <div class="article-img-wrap">
                    <span class="article-badge">{{ $article->category }}</span>
                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=800&q=80';">
                </div>
                <div class="article-body">
                    <div class="article-meta">
                        <span><i class="fa-regular fa-calendar"></i> {{ $article->published_at ? $article->published_at->format('d M Y') : date('d M Y') }}</span>
                        <span>•</span>
                        <span><i class="fa-regular fa-clock"></i> {{ $article->read_time }}</span>
                    </div>
                    <h2 class="article-title">{{ $article->title }}</h2>
                    <p class="article-excerpt">{{ $article->excerpt }}</p>
                    <div class="article-read-more">
                        Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endif
@endsection
