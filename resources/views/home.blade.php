@extends('layouts.app')

@push('styles')
<style>
    /* Hero Banner */
    .hero-section {
        background: linear-gradient(135deg, rgba(28, 25, 23, 0.92) 0%, rgba(38, 35, 32, 0.85) 100%), url('https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
        border-radius: var(--radius-lg);
        padding: 4.5rem 3rem;
        color: #FFFFFF;
        margin-bottom: 3.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .hero-content {
        max-width: 650px;
        position: relative;
        z-index: 2;
    }

    .hero-tag {
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
        margin-bottom: 1.2rem;
        letter-spacing: 0.5px;
    }

    .hero-title {
        font-size: 3.2rem;
        font-weight: 800;
        line-height: 1.15;
        margin-bottom: 1.2rem;
        letter-spacing: -1px;
    }

    .hero-title span {
        color: var(--accent-warm);
    }

    .hero-desc {
        font-size: 1.1rem;
        color: #D6D3D1;
        margin-bottom: 2.2rem;
        line-height: 1.7;
    }

    .hero-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn-primary {
        background: var(--accent-warm);
        color: #FFFFFF;
        padding: 0.95rem 2rem;
        border-radius: var(--radius-full);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        transition: var(--transition);
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        background: var(--accent-hover);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(197, 155, 39, 0.3);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        color: #FFFFFF;
        padding: 0.95rem 2rem;
        border-radius: var(--radius-full);
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: var(--transition);
    }

    .btn-secondary:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-3px);
    }

    /* Trust Stats */
    .trust-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3.5rem;
    }

    .stat-card {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        padding: 1.5rem;
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        gap: 1.2rem;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
    }

    .stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 14px;
        background: var(--accent-light);
        color: var(--accent-warm);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }

    .stat-info h4 {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.2rem;
    }

    .stat-info p {
        font-size: 0.85rem;
        color: var(--text-secondary);
    }

    /* Controls Bar (Filter + Sort) */
    .controls-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .category-pills {
        display: flex;
        gap: 0.6rem;
        overflow-x: auto;
        padding-bottom: 0.5rem;
    }

    .category-pill {
        padding: 0.6rem 1.4rem;
        border-radius: var(--radius-full);
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        color: var(--text-secondary);
        font-weight: 500;
        font-size: 0.9rem;
        text-decoration: none;
        white-space: nowrap;
        transition: var(--transition);
    }

    .category-pill:hover, .category-pill.active {
        background: var(--dark-primary);
        color: #FFFFFF;
        border-color: var(--dark-primary);
    }

    .sort-select-wrapper {
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .sort-select-wrapper label {
        font-size: 0.9rem;
        color: var(--text-secondary);
        font-weight: 500;
    }

    .sort-select {
        padding: 0.6rem 1.2rem;
        border-radius: var(--radius-full);
        border: 1px solid var(--border-color);
        background: var(--bg-surface);
        font-size: 0.9rem;
        outline: none;
        cursor: pointer;
    }

    /* Product Grid */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }

    .product-card {
        background: var(--bg-surface);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-color);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg);
        border-color: rgba(197, 155, 39, 0.3);
    }

    .product-image-wrap {
        width: 100%;
        height: 240px;
        position: relative;
        overflow: hidden;
        background: #F5F5F4;
    }

    .product-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .product-card:hover .product-image-wrap img {
        transform: scale(1.08);
    }

    .product-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: var(--dark-primary);
        color: #FFFFFF;
        padding: 0.3rem 0.8rem;
        border-radius: var(--radius-full);
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        z-index: 2;
    }

    .product-badge.badge-new {
        background: var(--accent-warm);
    }

    .product-actions-overlay {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        display: flex;
        gap: 0.5rem;
        opacity: 0;
        transform: translateY(10px);
        transition: var(--transition);
        z-index: 2;
    }

    .product-card:hover .product-actions-overlay {
        opacity: 1;
        transform: translateY(0);
    }

    .action-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.95);
        color: var(--text-primary);
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
    }

    .action-btn:hover {
        background: var(--dark-primary);
        color: #FFFFFF;
    }

    .product-body {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .product-category {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        color: var(--accent-warm);
        font-weight: 700;
        margin-bottom: 0.4rem;
    }

    .product-title {
        font-size: 1.15rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: var(--text-primary);
        text-decoration: none;
    }

    .product-title:hover {
        color: var(--accent-warm);
    }

    .product-rating {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.85rem;
        color: #F59E0B;
        margin-bottom: 0.8rem;
    }

    .product-rating span {
        color: var(--text-muted);
        font-weight: 400;
    }

    .product-price-wrap {
        margin-top: auto;
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        padding-top: 1rem;
        border-top: 1px dashed var(--border-color);
    }

    .product-price {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text-primary);
        font-family: 'Outfit', sans-serif;
    }

    .product-original-price {
        font-size: 0.85rem;
        text-decoration: line-through;
        color: var(--text-muted);
        margin-left: 0.4rem;
    }

    .btn-add-cart {
        background: var(--bg-primary);
        color: var(--text-primary);
        border: 1px solid var(--border-color);
        padding: 0.65rem 1.1rem;
        border-radius: var(--radius-full);
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
    }

    .btn-add-cart:hover {
        background: var(--dark-primary);
        color: #FFFFFF;
        border-color: var(--dark-primary);
    }

    /* Modal Quick View */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(6px);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1.5rem;
        opacity: 0;
        visibility: hidden;
        transition: var(--transition);
    }

    .modal-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .modal-card {
        background: var(--bg-surface);
        border-radius: var(--radius-lg);
        max-width: 850px;
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        overflow: hidden;
        position: relative;
        box-shadow: var(--shadow-lg);
    }

    .modal-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--bg-primary);
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 5;
    }

    .modal-img-wrap {
        height: 100%;
        min-height: 380px;
    }

    .modal-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .modal-details {
        padding: 2.5rem 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 3rem 1.8rem;
            margin-bottom: 2.5rem;
        }
        .hero-title {
            font-size: 2.2rem;
        }
        .hero-desc {
            font-size: 1rem;
        }
        .modal-card {
            grid-template-columns: 1fr;
            max-height: 90vh;
            overflow-y: auto;
            width: 95%;
        }
        .controls-bar {
            flex-direction: column;
            align-items: stretch;
            gap: 1rem;
        }
        .category-pills {
            width: 100%;
        }
        .sort-select-wrapper {
            justify-content: space-between;
        }
        .sort-select {
            flex: 1;
        }
        .product-grid {
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 1.2rem;
        }
    }

    @media (max-width: 480px) {
        .hero-section {
            padding: 2.2rem 1.2rem;
            border-radius: var(--radius-md);
        }
        .hero-title {
            font-size: 1.75rem;
        }
        .hero-tag {
            font-size: 0.78rem;
            padding: 0.3rem 0.8rem;
        }
        .hero-buttons {
            flex-direction: column;
            gap: 0.8rem;
        }
        .btn-primary, .btn-secondary {
            width: 100%;
            justify-content: center;
        }
        .product-grid {
            grid-template-columns: 1fr;
        }
        .trust-stats {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        .stat-card {
            padding: 1.1rem;
        }
    }
</style>
@endpush

@section('content')

<!-- Hero Section Banner -->
<section class="hero-section">
    <div class="hero-content">
        <div class="hero-tag"><i class="fa-solid fa-gem"></i> Premium Teak & Scandinavian Collection</div>
        <h1 class="hero-title">Keindahan & Kenyamanan <span>Furniture Kayu</span> Terbaik</h1>
        <p class="hero-desc">Temukan koleksi eksklusif sofa, meja makan jati, dan dekorasi interior modern yang dirancang presisi oleh pengrajin profesional untuk hunian impian Anda.</p>
        <div class="hero-buttons">
            <a href="#catalog" class="btn-primary"><i class="fa-solid fa-couch"></i> Jelajahi Katalog</a>
            <a href="#trust" class="btn-secondary"><i class="fa-solid fa-shield-halved"></i> Garansi 5 Tahun</a>
        </div>
    </div>
</section>

<!-- Trust Feature Stats -->
<section class="trust-stats" id="trust">
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-tree"></i></div>
        <div class="stat-info">
            <h4>100% Kayu Jati TPK</h4>
            <p>Bahan kayu pilihan kualitas ekspor</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-truck-fast"></i></div>
        <div class="stat-info">
            <h4>Pengiriman Aman</h4>
            <p>Termasuk instalasi gratis di tempat</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-ribbon"></i></div>
        <div class="stat-info">
            <h4>Garansi Resmi</h4>
            <p>Perlindungan konstruksi 5 tahun</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
        <div class="stat-info">
            <h4>Custom Desain</h4>
            <p>Bisa sesuaikan ukuran & warna</p>
        </div>
    </div>
</section>

<!-- Main Catalog Section -->
<section id="catalog">

    <!-- Controls Bar -->
    <div class="controls-bar">
        <div class="category-pills">
            @foreach($categories as $cat)
                <a href="{{ route('home', ['category' => $cat, 'q' => request('q'), 'sort' => request('sort')]) }}" 
                   class="category-pill {{ $selectedCategory === $cat ? 'active' : '' }}">
                    @if($cat === 'All') <i class="fa-solid fa-grip" style="margin-right: 4px;"></i> Semua
                    @elseif($cat === 'Living Room') <i class="fa-solid fa-couch" style="margin-right: 4px;"></i> Ruang Tamu
                    @elseif($cat === 'Bedroom') <i class="fa-solid fa-bed" style="margin-right: 4px;"></i> Kamar Tidur
                    @elseif($cat === 'Dining Room') <i class="fa-solid fa-utensils" style="margin-right: 4px;"></i> Ruang Makan
                    @elseif($cat === 'Office') <i class="fa-solid fa-briefcase" style="margin-right: 4px;"></i> Kantor
                    @elseif($cat === 'Outdoor') <i class="fa-solid fa-sun" style="margin-right: 4px;"></i> Outdoor
                    @else {{ $cat }} @endif
                </a>
            @endforeach
        </div>

        <div class="sort-select-wrapper">
            <label for="sort"><i class="fa-solid fa-arrow-down-wide-short"></i> Urutkan:</label>
            <select class="sort-select" id="sort-select" onchange="applySort(this.value)">
                <option value="featured" {{ $selectedSort === 'featured' ? 'selected' : '' }}>Unggulan</option>
                <option value="newest" {{ $selectedSort === 'newest' ? 'selected' : '' }}>Terbaru</option>
                <option value="price_low" {{ $selectedSort === 'price_low' ? 'selected' : '' }}>Harga: Terendah ke Tertinggi</option>
                <option value="price_high" {{ $selectedSort === 'price_high' ? 'selected' : '' }}>Harga: Tertinggi ke Terendah</option>
                <option value="rating" {{ $selectedSort === 'rating' ? 'selected' : '' }}>Rating Tertinggi</option>
            </select>
        </div>
    </div>

    <!-- Product Items Grid -->
    @if($products->isEmpty())
        <div style="text-align: center; padding: 4rem 1rem; background: var(--bg-surface); border-radius: var(--radius-lg); border: 1px solid var(--border-color);">
            <i class="fa-solid fa-magnifying-glass" style="font-size: 3rem; color: var(--text-muted); margin-bottom: 1rem;"></i>
            <h3>Produk Tidak Ditemukan</h3>
            <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">Tidak ada produk furniture yang sesuai dengan kriteria pencarian atau filter Anda.</p>
            <a href="{{ route('home') }}" class="btn-primary">Lihat Semua Produk</a>
        </div>
    @else
        <div class="product-grid">
            @foreach($products as $product)
                <div class="product-card">
                    <div class="product-image-wrap">
                        @if($product->is_new)
                            <span class="product-badge badge-new">BARU</span>
                        @elseif($product->is_featured)
                            <span class="product-badge">BEST SELLER</span>
                        @endif
                        
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=800&q=80';">
                        
                        <div class="product-actions-overlay">
                            <button class="action-btn" title="Quick View" onclick="openQuickView('{{ $product->slug }}')">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <a href="{{ route('products.show', $product->slug) }}" class="action-btn" title="Detail Lengkap">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            </a>
                        </div>
                    </div>
                    <div class="product-body">
                        <div class="product-category">{{ $product->category }}</div>
                        <a href="{{ route('products.show', $product->slug) }}" class="product-title">{{ $product->name }}</a>
                        
                        <div class="product-rating">
                            <i class="fa-solid fa-star"></i>
                            <strong>{{ number_format($product->rating, 1) }}</strong>
                            <span>({{ $product->review_count }} ulasan)</span>
                        </div>
                        
                        <div class="product-price-wrap">
                            <div>
                                <span class="product-price">{{ $product->formatted_price }}</span>
                                @if($product->formatted_original_price)
                                    <span class="product-original-price">{{ $product->formatted_original_price }}</span>
                                @endif
                            </div>
                            
                            <button class="btn-add-cart" onclick="addToCart({
                                id: {{ $product->id }},
                                name: '{{ addslashes($product->name) }}',
                                price: {{ $product->price }},
                                image_url: '{{ $product->image_url }}'
                            })">
                                <i class="fa-solid fa-plus"></i> Cart
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>

<!-- Company Profile & Articles Showcase -->
@if(isset($latestArticles) && $latestArticles->count() > 0)
<section style="margin-top: 4.5rem; margin-bottom: 2rem;">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
        <div>
            <div style="color: var(--accent-warm); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.3rem;">
                <i class="fa-solid fa-feather-pointed" style="margin-right: 4px;"></i> Profil & Inspirasi
            </div>
            <h2 class="font-heading" style="font-size: 2rem; font-weight: 800; color: var(--text-primary);">Artikel & Cerita DrewWood</h2>
        </div>
        <a href="{{ route('articles.index') }}" class="btn-nav-login" style="padding: 0.65rem 1.4rem;">
            Lihat Semua Artikel <i class="fa-solid fa-arrow-right" style="margin-left: 4px;"></i>
        </a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.8rem;">
        @foreach($latestArticles as $art)
            <a href="{{ route('articles.show', $art->slug) }}" style="background: var(--bg-surface); border: 1px solid var(--border-color); border-radius: var(--radius-lg); overflow: hidden; text-decoration: none; color: inherit; transition: var(--transition); display: flex; flex-direction: column;" class="stat-card">
                <div style="position: relative; width: 100%; height: 190px; overflow: hidden;">
                    <img src="{{ $art->image_url }}" alt="{{ $art->title }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?auto=format&fit=crop&w=800&q=80';">
                    <span style="position: absolute; top: 0.8rem; left: 0.8rem; background: rgba(28, 25, 23, 0.85); backdrop-filter: blur(6px); color: var(--accent-warm); font-size: 0.72rem; font-weight: 700; padding: 0.3rem 0.75rem; border-radius: var(--radius-full);">
                        {{ $art->category }}
                    </span>
                </div>
                <div style="padding: 1.4rem; display: flex; flex-direction: column; flex: 1;">
                    <div style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 0.5rem;">
                        <i class="fa-regular fa-calendar" style="margin-right: 4px;"></i> {{ $art->published_at ? $art->published_at->format('d M Y') : date('d M Y') }}
                    </div>
                    <h3 style="font-size: 1.15rem; font-weight: 700; line-height: 1.35; margin-bottom: 0.6rem; color: var(--text-primary);">{{ $art->title }}</h3>
                    <p style="font-size: 0.88rem; color: var(--text-secondary); line-height: 1.5; margin-bottom: 1.2rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $art->excerpt }}</p>
                    <div style="margin-top: auto; font-size: 0.85rem; font-weight: 700; color: var(--accent-warm);">
                        Baca Artikel <i class="fa-solid fa-arrow-right" style="margin-left: 4px;"></i>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</section>
@endif

<!-- Quick View Modal Structure -->
<div class="modal-overlay" id="quick-view-modal">
    <div class="modal-card">
        <button class="modal-close" onclick="closeQuickView()"><i class="fa-solid fa-xmark"></i></button>
        <div class="modal-img-wrap">
            <img src="" id="qv-img" alt="Quick view furniture image">
        </div>
        <div class="modal-details">
            <span class="product-category" id="qv-category">LIVING ROOM</span>
            <h2 id="qv-title" style="font-size: 1.6rem; margin-bottom: 0.5rem;">Product Name</h2>
            
            <div class="product-rating" style="margin-bottom: 1rem;">
                <i class="fa-solid fa-star"></i>
                <span id="qv-rating" style="font-weight: 700; color: var(--text-primary);">4.9</span>
            </div>

            <p id="qv-desc" style="color: var(--text-secondary); font-size: 0.95rem; margin-bottom: 1.5rem; line-height: 1.6;">Deskripsi produk...</p>
            
            <div style="background: var(--bg-primary); padding: 1rem; border-radius: var(--radius-md); margin-bottom: 1.5rem; font-size: 0.88rem;">
                <div><i class="fa-solid fa-ruler-combined" style="color: var(--accent-warm); margin-right: 6px;"></i> <strong>Dimensi:</strong> <span id="qv-dim">-</span></div>
                <div style="margin-top: 0.4rem;"><i class="fa-solid fa-layer-group" style="color: var(--accent-warm); margin-right: 6px;"></i> <strong>Material:</strong> <span id="qv-mat">-</span></div>
            </div>

            <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem;">
                <div>
                    <div style="font-size: 0.8rem; color: var(--text-muted);">Harga Promo</div>
                    <div id="qv-price" class="product-price" style="font-size: 1.5rem; color: var(--accent-warm);">Rp 0</div>
                </div>

                <button class="btn-primary" id="qv-add-btn">
                    <i class="fa-solid fa-cart-shopping"></i> Tambah ke Keranjang
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function applySort(sortVal) {
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set('sort', sortVal);
        window.location.search = urlParams.toString();
    }

    let activeQvProduct = null;

    function openQuickView(slug) {
        fetch(`/products/${slug}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(res => res.json())
        .then(data => {
            const p = data.product;
            activeQvProduct = p;

            document.getElementById('qv-img').src = p.image_url;
            document.getElementById('qv-category').textContent = p.category;
            document.getElementById('qv-title').textContent = p.name;
            document.getElementById('qv-rating').textContent = `${p.rating} (${p.review_count} ulasan)`;
            document.getElementById('qv-desc').textContent = p.description;
            document.getElementById('qv-dim').textContent = p.dimensions || 'Standar';
            document.getElementById('qv-mat').textContent = p.material || 'Kayu Jati Solid';
            document.getElementById('qv-price').textContent = data.formatted_price;

            document.getElementById('qv-add-btn').onclick = function() {
                addToCart({
                    id: p.id,
                    name: p.name,
                    price: p.price,
                    image_url: p.image_url
                });
                closeQuickView();
            };

            document.getElementById('quick-view-modal').classList.add('active');
        })
        .catch(err => {
            console.error(err);
        });
    }

    function closeQuickView() {
        document.getElementById('quick-view-modal').classList.remove('active');
    }

    document.getElementById('quick-view-modal').addEventListener('click', (e) => {
        if(e.target.id === 'quick-view-modal') {
            closeQuickView();
        }
    });
</script>
@endpush
