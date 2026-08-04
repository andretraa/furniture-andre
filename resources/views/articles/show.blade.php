@extends('layouts.app')

@push('styles')
<style>
    .article-detail-container {
        max-width: 860px;
        margin: 0 auto;
        padding-bottom: 4rem;
    }

    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-size: 0.9rem;
        color: var(--text-muted);
        margin-bottom: 2rem;
    }

    .breadcrumb a {
        color: var(--text-secondary);
        text-decoration: none;
        transition: var(--transition);
    }

    .breadcrumb a:hover {
        color: var(--accent-warm);
    }

    .article-header {
        margin-bottom: 2.2rem;
    }

    .article-category-badge {
        display: inline-block;
        background: var(--accent-light);
        color: var(--accent-warm);
        font-weight: 700;
        font-size: 0.85rem;
        padding: 0.4rem 1rem;
        border-radius: var(--radius-full);
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .article-main-title {
        font-size: 2.6rem;
        font-weight: 800;
        color: var(--text-primary);
        line-height: 1.25;
        letter-spacing: -0.5px;
        margin-bottom: 1.2rem;
    }

    .article-meta-bar {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        font-size: 0.9rem;
        color: var(--text-secondary);
        padding-bottom: 1.5rem;
        border-bottom: 1px solid var(--border-color);
        flex-wrap: wrap;
    }

    .author-info {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .author-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--dark-primary);
        color: var(--accent-warm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
    }

    .article-cover {
        width: 100%;
        max-height: 480px;
        border-radius: var(--radius-lg);
        overflow: hidden;
        margin-bottom: 2.5rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
    }

    .article-cover img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Content Styling */
    .article-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #334155;
        margin-bottom: 3.5rem;
    }

    .article-content p {
        margin-bottom: 1.6rem;
    }

    .article-content h3 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 2.2rem 0 1rem 0;
        line-height: 1.3;
    }

    .article-content ul {
        margin-bottom: 1.6rem;
        padding-left: 1.5rem;
    }

    .article-content li {
        margin-bottom: 0.6rem;
    }

    /* Share Section */
    .share-box {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-md);
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 4rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .share-title {
        font-weight: 700;
        font-size: 1rem;
        color: var(--text-primary);
    }

    .share-buttons {
        display: flex;
        gap: 0.8rem;
    }

    .btn-share {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.55rem 1.1rem;
        border-radius: var(--radius-full);
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        color: #FFFFFF;
        transition: var(--transition);
    }

    .btn-share-wa {
        background: #25D366;
    }

    .btn-share-wa:hover {
        background: #1EBE57;
        transform: translateY(-2px);
    }

    /* Related Articles */
    .related-articles-section {
        margin-top: 3rem;
        padding-top: 2.5rem;
        border-top: 1px solid var(--border-color);
    }

    .section-title {
        font-size: 1.6rem;
        font-weight: 800;
        margin-bottom: 1.8rem;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.8rem;
    }

    @media (max-width: 768px) {
        .article-main-title {
            font-size: 2rem;
        }
        .article-cover {
            max-height: 320px;
        }
        .article-content {
            font-size: 1.02rem;
        }
    }
</style>
@endpush

@section('content')
<div class="article-detail-container">
    <!-- Breadcrumb -->
    <div class="breadcrumb">
        <a href="{{ route('home') }}">Beranda</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 0.7rem;"></i>
        <a href="{{ route('articles.index') }}">Artikel</a>
        <i class="fa-solid fa-chevron-right" style="font-size: 0.7rem;"></i>
        <span>{{ Str::limit($article->title, 35) }}</span>
    </div>

    <!-- Article Header -->
    <div class="article-header">
        <span class="article-category-badge">{{ $article->category }}</span>
        <h1 class="article-main-title">{{ $article->title }}</h1>

        <div class="article-meta-bar">
            <div class="author-info">
                <div class="author-avatar"><i class="fa-solid fa-user-nib"></i></div>
                <span>{{ $article->author }}</span>
            </div>
            <div>
                <i class="fa-regular fa-calendar" style="margin-right: 4px;"></i>
                {{ $article->published_at ? $article->published_at->format('d M Y') : date('d M Y') }}
            </div>
            <div>
                <i class="fa-regular fa-clock" style="margin-right: 4px;"></i>
                {{ $article->read_time }}
            </div>
        </div>
    </div>

    <!-- Article Cover Image -->
    <div class="article-cover">
        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1000&q=80';">
    </div>

    <!-- Article Content Body -->
    <div class="article-content">
        {!! $article->content !!}
    </div>

    <!-- Share Box -->
    <div class="share-box">
        <div class="share-title">
            <i class="fa-solid fa-share-nodes" style="color: var(--accent-warm); margin-right: 6px;"></i> Bagikan Artikel Ini
        </div>
        <div class="share-buttons">
            <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . request()->url()) }}" target="_blank" class="btn-share btn-share-wa">
                <i class="fa-brands fa-whatsapp"></i> Bagikan ke WhatsApp
            </a>
        </div>
    </div>

    <!-- Related Articles -->
    @if($relatedArticles->count() > 0)
        <div class="related-articles-section">
            <h3 class="section-title font-heading">Artikel & Inspirasi Lainnya</h3>
            <div class="related-grid">
                @foreach($relatedArticles as $rel)
                    <a href="{{ route('articles.show', $rel->slug) }}" class="article-card" style="border: 1px solid var(--border-color); border-radius: var(--radius-md);">
                        <div class="article-img-wrap" style="height: 160px;">
                            <img src="{{ $rel->image_url }}" alt="{{ $rel->title }}" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=800&q=80';">
                        </div>
                        <div class="article-body" style="padding: 1.2rem;">
                            <div class="article-meta" style="font-size: 0.78rem;">
                                <span>{{ $rel->published_at ? $rel->published_at->format('d M Y') : date('d M Y') }}</span>
                            </div>
                            <h4 style="font-size: 1rem; font-weight: 700; color: var(--text-primary); line-height: 1.3; margin-bottom: 0.5rem;">{{ $rel->title }}</h4>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
