@extends('layouts.admin')

@section('title', 'Kelola Artikel Admin')
@section('page-title', 'Kelola Artikel')

@push('styles')
<style>
    .filter-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        flex: 1;
        max-width: 500px;
    }

    .input-search {
        width: 100%;
        padding: 0.7rem 1.1rem;
        background: var(--admin-surface);
        border: 1px solid var(--admin-border);
        border-radius: var(--radius-md);
        color: var(--text-main);
        font-size: 0.9rem;
        outline: none;
        transition: var(--transition);
    }

    .input-search:focus {
        border-color: var(--admin-gold);
        box-shadow: 0 0 0 3px var(--admin-gold-bg);
    }

    .select-category {
        padding: 0.7rem 1.1rem;
        background: var(--admin-surface);
        border: 1px solid var(--admin-border);
        border-radius: var(--radius-md);
        color: var(--text-main);
        font-size: 0.9rem;
        outline: none;
        cursor: pointer;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .custom-table th {
        padding: 0.9rem 1.2rem;
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-sub);
        background: rgba(255, 255, 255, 0.02);
        border-bottom: 1px solid var(--admin-border);
    }

    .custom-table td {
        padding: 1rem 1.2rem;
        font-size: 0.9rem;
        border-bottom: 1px solid var(--admin-border);
        color: var(--text-main);
        vertical-align: middle;
    }

    .article-thumb {
        width: 56px;
        height: 56px;
        border-radius: 10px;
        object-fit: cover;
    }

    .badge-category {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.08);
        color: var(--text-muted);
    }

    .badge-featured {
        font-size: 0.72rem;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
        background: var(--admin-gold-bg);
        color: var(--admin-gold);
        border: 1px solid rgba(197, 155, 39, 0.3);
        margin-top: 4px;
        display: inline-block;
    }

    .actions-group {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .pagination-wrapper {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
    }
</style>
@endpush

@section('content')
<!-- Filter & Action Bar -->
<div class="filter-bar">
    <form action="{{ route('admin.articles.index') }}" method="GET" class="search-box">
        <input type="text" name="q" value="{{ $searchQuery }}" placeholder="Cari berdasarkan judul, penulis, atau kata kunci..." class="input-search">
        
        <select name="category" onchange="this.form.submit()" class="select-category">
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ $selectedCategory === $cat ? 'selected' : '' }}>
                    {{ $cat === 'All' ? 'Semua Kategori' : $cat }}
                </option>
            @endforeach
        </select>
        
        <button type="submit" class="btn-secondary" style="padding: 0.7rem 1rem;">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>

    <a href="{{ route('admin.articles.create') }}" class="btn-primary">
        <i class="fa-solid fa-plus"></i> Tambah Artikel Baru
    </a>
</div>

<!-- Articles Table Card -->
<div class="admin-card">
    @if($articles->count() > 0)
        <div style="overflow-x: auto;">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 60px;">No</th>
                        <th>Artikel</th>
                        <th>Kategori</th>
                        <th>Penulis & Membaca</th>
                        <th>Tanggal Terbit</th>
                        <th style="text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $index => $art)
                        <tr>
                            <td><span style="color: var(--text-sub); font-size: 0.85rem;">{{ $articles->firstItem() + $index }}</span></td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <img src="{{ $art->image_url }}" alt="{{ $art->title }}" class="article-thumb" onerror="this.src='https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=150&q=80'">
                                    <div>
                                        <div style="font-weight: 700; color: var(--text-main); font-size: 0.95rem; margin-bottom: 2px;">
                                            {{ $art->title }}
                                        </div>
                                        <div style="font-size: 0.8rem; color: var(--text-sub); max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $art->excerpt }}
                                        </div>
                                        @if($art->is_featured)
                                            <span class="badge-featured"><i class="fa-solid fa-star" style="font-size: 0.65rem;"></i> Featured</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge-category">{{ $art->category }}</span></td>
                            <td>
                                <div style="font-weight: 500; font-size: 0.85rem;">{{ $art->author }}</div>
                                <div style="font-size: 0.78rem; color: var(--text-sub);"><i class="fa-regular fa-clock"></i> {{ $art->read_time }}</div>
                            </td>
                            <td>
                                <span style="font-size: 0.85rem; color: var(--text-muted);">
                                    {{ $art->published_at ? $art->published_at->format('d M Y') : $art->created_at->format('d M Y') }}
                                </span>
                            </td>
                            <td>
                                <div class="actions-group" style="justify-content: flex-end;">
                                    <a href="{{ route('articles.show', $art->slug) }}" target="_blank" class="btn-secondary btn-sm" title="Lihat di Website">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.articles.edit', $art->id) }}" class="btn-secondary btn-sm" title="Edit Artikel">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $art->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel {{ $art->title }}?');" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-danger btn-sm" title="Hapus Artikel">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $articles->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 3rem 1rem;">
            <i class="fa-solid fa-newspaper" style="font-size: 3rem; color: var(--text-sub); margin-bottom: 1rem;"></i>
            <h3 class="font-heading" style="color: var(--text-main); margin-bottom: 0.5rem;">Tidak Ada Artikel Ditemukan</h3>
            <p style="color: var(--text-muted); max-width: 400px; margin: 0 auto 1.5rem auto; font-size: 0.9rem;">
                Belum ada artikel yang sesuai dengan kriteria pencarian atau kategori ini.
            </p>
            <a href="{{ route('admin.articles.create') }}" class="btn-primary">
                <i class="fa-solid fa-plus"></i> Buat Artikel Baru
            </a>
        </div>
    @endif
</div>
@endsection
