@extends('layouts.app')

@push('styles')
<style>
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

    .detail-grid {
        display: grid;
        grid-template-columns: 1.1fr 1fr;
        gap: 3.5rem;
        background: var(--bg-surface);
        padding: 3rem;
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-color);
        box-shadow: var(--shadow-sm);
        margin-bottom: 4rem;
    }

    .detail-gallery {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .main-image-wrap {
        width: 100%;
        height: 480px;
        border-radius: var(--radius-lg);
        overflow: hidden;
        background: #F5F5F4;
        border: 1px solid var(--border-color);
    }

    .main-image-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .detail-info {
        display: flex;
        flex-direction: column;
    }

    .detail-category {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--accent-warm);
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .detail-title {
        font-size: 2.2rem;
        font-weight: 800;
        line-height: 1.25;
        margin-bottom: 0.8rem;
    }

    .detail-rating {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #F59E0B;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .detail-price-box {
        background: var(--bg-primary);
        padding: 1.2rem 1.5rem;
        border-radius: var(--radius-md);
        display: flex;
        align-items: baseline;
        gap: 1rem;
        margin-bottom: 1.8rem;
    }

    .detail-price {
        font-size: 2rem;
        font-weight: 800;
        color: var(--accent-warm);
        font-family: 'Outfit', sans-serif;
    }

    .detail-original-price {
        font-size: 1.1rem;
        text-decoration: line-through;
        color: var(--text-muted);
    }

    .detail-desc {
        color: var(--text-secondary);
        line-height: 1.8;
        font-size: 1rem;
        margin-bottom: 2rem;
    }

    .spec-table {
        margin-bottom: 2rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        background: var(--bg-primary);
        padding: 1.2rem;
        border-radius: var(--radius-md);
        border: 1px solid var(--border-color);
    }

    .spec-item i {
        color: var(--accent-warm);
        margin-right: 0.4rem;
    }

    .spec-item strong {
        display: block;
        font-size: 0.82rem;
        color: var(--text-muted);
        text-transform: uppercase;
        margin-bottom: 0.2rem;
    }

    .spec-item span {
        font-size: 0.95rem;
        font-weight: 600;
    }

    .action-row {
        display: flex;
        gap: 1rem;
        align-items: center;
        margin-top: auto;
    }

    .qty-selector {
        display: flex;
        align-items: center;
        border: 1px solid var(--border-color);
        border-radius: var(--radius-full);
        background: var(--bg-surface);
        overflow: hidden;
    }

    .qty-btn {
        width: 42px;
        height: 42px;
        background: none;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }

    .qty-btn:hover {
        background: var(--bg-primary);
    }

    .qty-input {
        width: 45px;
        text-align: center;
        border: none;
        font-weight: 700;
        font-size: 1rem;
        outline: none;
    }

    .btn-lg-cart {
        flex: 1;
        background: var(--dark-primary);
        color: #FFFFFF;
        padding: 0.95rem 1.8rem;
        border-radius: var(--radius-full);
        border: none;
        font-weight: 700;
        font-size: 1rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        transition: var(--transition);
    }

    .btn-lg-cart:hover {
        background: var(--accent-warm);
    }

    @media (max-width: 900px) {
        .detail-grid {
            grid-template-columns: 1fr;
            padding: 1.5rem;
        }
        .main-image-wrap {
            height: 320px;
        }
    }
</style>
@endpush

@section('content')

<!-- Breadcrumb -->
<div class="breadcrumb">
    <a href="{{ route('home') }}">Beranda</a>
    <i class="fa-solid fa-chevron-right" style="font-size: 0.7rem;"></i>
    <a href="{{ route('home', ['category' => $product->category]) }}">{{ $product->category }}</a>
    <i class="fa-solid fa-chevron-right" style="font-size: 0.7rem;"></i>
    <span>{{ $product->name }}</span>
</div>

<!-- Product Detail Container -->
<div class="detail-grid">
    <div class="detail-gallery">
        <div class="main-image-wrap">
            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=800&q=80';">
        </div>
    </div>

    <div class="detail-info">
        <div class="detail-category">{{ $product->category }}</div>
        <h1 class="detail-title">{{ $product->name }}</h1>

        <div class="detail-rating">
            <i class="fa-solid fa-star"></i>
            <strong>{{ number_format($product->rating, 1) }}</strong>
            <span style="color: var(--text-muted);">({{ $product->review_count }} Ulasan Pembeli)</span>
            <span style="margin: 0 6px;">•</span>
            <span style="color: #10B981; font-weight: 600;"><i class="fa-solid fa-circle-check"></i> Stok Tersedia ({{ $product->stock }} unit)</span>
        </div>

        <div class="detail-price-box">
            <span class="detail-price">{{ $product->formatted_price }}</span>
            @if($product->formatted_original_price)
                <span class="detail-original-price">{{ $product->formatted_original_price }}</span>
            @endif
        </div>

        <p class="detail-desc">{{ $product->description }}</p>

        <div class="spec-table">
            <div class="spec-item">
                <strong><i class="fa-solid fa-ruler-combined"></i> Dimensi Produk</strong>
                <span>{{ $product->dimensions ?? 'Standar Ergonomis' }}</span>
            </div>
            <div class="spec-item">
                <strong><i class="fa-solid fa-layer-group"></i> Material Kayu & Busa</strong>
                <span>{{ $product->material ?? 'Solid Wood & High-Density Foam' }}</span>
            </div>
            <div class="spec-item">
                <strong><i class="fa-solid fa-shield-cat"></i> Garansi Resmi</strong>
                <span>5 Tahun Garansi Kayu</span>
            </div>
            <div class="spec-item">
                <strong><i class="fa-solid fa-truck-ramp-box"></i> Perakitan</strong>
                <span>Gratis Perakitan di Tempat</span>
            </div>
        </div>

        <div class="action-row">
            <div class="qty-selector">
                <button class="qty-btn" onclick="changeQty(-1)"><i class="fa-solid fa-minus"></i></button>
                <input type="number" id="detail-qty" class="qty-input" value="1" min="1" max="{{ $product->stock }}" readonly>
                <button class="qty-btn" onclick="changeQty(1)"><i class="fa-solid fa-plus"></i></button>
            </div>

            <button class="btn-lg-cart" onclick="addMultipleToCart()">
                <i class="fa-solid fa-bag-shopping"></i> Tambah ke Keranjang Belanja
            </button>
        </div>
    </div>
</div>

<!-- Related Products Section -->
@if(!$relatedProducts->isEmpty())
<section>
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 1.8rem;">
        <div>
            <span style="color: var(--accent-warm); font-weight: 700; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Koleksi Serupa</span>
            <h2 style="font-size: 1.8rem; font-weight: 800;">Produk Terkait Dalam {{ $product->category }}</h2>
        </div>
        <a href="{{ route('home', ['category' => $product->category]) }}" style="color: var(--dark-primary); font-weight: 600; text-decoration: none;">Lihat Semua <i class="fa-solid fa-arrow-right"></i></a>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 2rem;">
        @foreach($relatedProducts as $rel)
            <div class="product-card" style="background: var(--bg-surface); border-radius: var(--radius-lg); border: 1px solid var(--border-color); overflow: hidden;">
                <div class="product-image-wrap" style="height: 200px;">
                    <img src="{{ $rel->image_url }}" alt="{{ $rel->name }}">
                </div>
                <div style="padding: 1.2rem;">
                    <div style="font-size: 0.75rem; color: var(--accent-warm); font-weight: 700; text-transform: uppercase; margin-bottom: 0.3rem;">{{ $rel->category }}</div>
                    <a href="{{ route('products.show', $rel->slug) }}" style="font-weight: 700; color: var(--text-primary); text-decoration: none; font-size: 1rem; display: block; margin-bottom: 0.6rem;">{{ $rel->name }}</a>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 800; font-family: 'Outfit', sans-serif; font-size: 1.1rem; color: var(--text-primary);">{{ $rel->formatted_price }}</span>
                        <a href="{{ route('products.show', $rel->slug) }}" style="color: var(--dark-primary); background: var(--bg-primary); padding: 0.4rem 0.8rem; border-radius: var(--radius-full); font-size: 0.8rem; text-decoration: none; font-weight: 600;">Lihat</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif

@endsection

@push('scripts')
<script>
    function changeQty(delta) {
        const input = document.getElementById('detail-qty');
        let val = parseInt(input.value) + delta;
        if(val < 1) val = 1;
        if(val > {{ $product->stock }}) val = {{ $product->stock }};
        input.value = val;
    }

    function addMultipleToCart() {
        const qty = parseInt(document.getElementById('detail-qty').value);
        for(let i = 0; i < qty; i++) {
            addToCart({
                id: {{ $product->id }},
                name: '{{ addslashes($product->name) }}',
                price: {{ $product->price }},
                image_url: '{{ $product->image_url }}'
            });
        }
    }
</script>
@endpush
