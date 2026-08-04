@extends('layouts.admin')

@section('title', 'Dashboard Admin Overview')
@section('page-title', 'Dashboard Overview')

@push('styles')
<style>
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .metric-card {
        background: var(--admin-surface);
        border: 1px solid var(--admin-border);
        border-radius: var(--radius-lg);
        padding: 1.4rem;
        display: flex;
        align-items: center;
        gap: 1.2rem;
        transition: var(--transition);
    }

    .metric-card:hover {
        border-color: var(--admin-gold);
        transform: translateY(-3px);
    }

    .metric-icon {
        width: 54px;
        height: 54px;
        border-radius: 14px;
        background: var(--admin-gold-bg);
        color: var(--admin-gold);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .metric-value {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-main);
        line-height: 1;
        margin-bottom: 0.3rem;
    }

    .metric-label {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
    }

    .card-header-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.2rem;
        padding-bottom: 0.8rem;
        border-bottom: 1px solid var(--admin-border);
    }

    .card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .card-title i {
        color: var(--admin-gold);
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        text-align: left;
    }

    .custom-table th {
        padding: 0.8rem 1rem;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--text-sub);
        background: rgba(255, 255, 255, 0.02);
        border-bottom: 1px solid var(--admin-border);
    }

    .custom-table td {
        padding: 0.9rem 1rem;
        font-size: 0.88rem;
        border-bottom: 1px solid var(--admin-border);
        color: var(--text-main);
        vertical-align: middle;
    }

    .custom-table tr:last-child td {
        border-bottom: none;
    }

    .article-thumb-mini {
        width: 44px;
        height: 44px;
        border-radius: 8px;
        object-fit: cover;
    }

    .badge-category {
        font-size: 0.72rem;
        font-weight: 600;
        padding: 3px 8px;
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
    }

    .badge-role-admin {
        font-size: 0.72rem;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 6px;
        background: var(--admin-gold-bg);
        color: var(--admin-gold);
        text-transform: uppercase;
    }

    .badge-role-user {
        font-size: 0.72rem;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.08);
        color: var(--text-muted);
        text-transform: uppercase;
    }

    .user-item-mini {
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .user-avatar-mini {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        object-fit: cover;
    }

    @media (max-width: 1024px) {
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Metrics Banner -->
<div class="metrics-grid">
    <div class="metric-card">
        <div class="metric-icon"><i class="fa-solid fa-newspaper"></i></div>
        <div>
            <div class="metric-value">{{ $totalArticles }}</div>
            <div class="metric-label">Total Artikel</div>
        </div>
    </div>
    
    <div class="metric-card">
        <div class="metric-icon"><i class="fa-solid fa-star"></i></div>
        <div>
            <div class="metric-value">{{ $featuredArticlesCount }}</div>
            <div class="metric-label">Artikel Utama (Featured)</div>
        </div>
    </div>

    <div class="metric-card">
        <div class="metric-icon"><i class="fa-solid fa-users"></i></div>
        <div>
            <div class="metric-value">{{ $totalUsers }}</div>
            <div class="metric-label">Total Akun Terdaftar</div>
        </div>
    </div>

    <div class="metric-card">
        <div class="metric-icon"><i class="fa-solid fa-user-shield"></i></div>
        <div>
            <div class="metric-value">{{ $adminCount }}</div>
            <div class="metric-label">Akun Administrator</div>
        </div>
    </div>
</div>

<!-- Quick Actions Header -->
<div class="admin-card" style="margin-bottom: 2rem; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 1rem;">
    <div>
        <h3 class="font-heading" style="font-size: 1.2rem; margin-bottom: 0.2rem;">Manajemen Konten & Akun Pengguna</h3>
        <p style="font-size: 0.88rem; color: var(--text-muted);">Kelola postingan artikel blog, berita furniture, dan pantau pengguna website DrewWood.</p>
    </div>
    <div style="display: flex; gap: 0.8rem; flex-wrap: wrap;">
        <a href="{{ route('admin.articles.create') }}" class="btn-primary">
            <i class="fa-solid fa-plus"></i> Tambah Artikel Baru
        </a>
        <a href="{{ route('admin.users.index') }}" class="btn-secondary">
            <i class="fa-solid fa-users"></i> Lihat Semua Akun
        </a>
    </div>
</div>

<!-- Content Grid -->
<div class="dashboard-grid">
    <!-- Recent Articles Table -->
    <div class="admin-card">
        <div class="card-header-box">
            <h3 class="card-title"><i class="fa-solid fa-clock-rotate-left"></i> Artikel Terbaru</h3>
            <a href="{{ route('admin.articles.index') }}" class="btn-secondary btn-sm">Lihat Semua</a>
        </div>
        @if($recentArticles->count() > 0)
            <div style="overflow-x: auto;">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Artikel</th>
                            <th>Kategori</th>
                            <th>Penulis</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentArticles as $art)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.8rem;">
                                        <img src="{{ $art->image_url }}" alt="{{ $art->title }}" class="article-thumb-mini" onerror="this.src='https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=150&q=80'">
                                        <div>
                                            <div style="font-weight: 600; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ $art->title }}
                                            </div>
                                            @if($art->is_featured)
                                                <span class="badge-featured"><i class="fa-solid fa-star" style="font-size: 0.65rem;"></i> Featured</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge-category">{{ $art->category }}</span></td>
                                <td><span style="font-size: 0.82rem; color: var(--text-muted);">{{ $art->author }}</span></td>
                                <td><span style="font-size: 0.82rem; color: var(--text-muted);">{{ $art->created_at->format('d M Y') }}</span></td>
                                <td>
                                    <a href="{{ route('admin.articles.edit', $art->id) }}" class="btn-secondary btn-sm" title="Edit Artikel">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p style="color: var(--text-muted); font-size: 0.9rem; text-align: center; padding: 2rem 0;">Belum ada artikel yang dipublikasikan.</p>
        @endif
    </div>

    <!-- Recent Users Sidebar Card -->
    <div class="admin-card">
        <div class="card-header-box">
            <h3 class="card-title"><i class="fa-solid fa-user-plus"></i> Akun Pengguna Baru</h3>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary btn-sm">Semua</a>
        </div>
        @if($recentUsers->count() > 0)
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @foreach($recentUsers as $usr)
                    <div style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 0.8rem; border-bottom: 1px solid var(--admin-border);">
                        <div class="user-item-mini">
                            <img src="{{ $usr->avatar_url }}" alt="{{ $usr->name }}" class="user-avatar-mini">
                            <div>
                                <div style="font-size: 0.88rem; font-weight: 600; color: var(--text-main);">{{ $usr->name }}</div>
                                <div style="font-size: 0.78rem; color: var(--text-sub);">{{ $usr->email }}</div>
                            </div>
                        </div>
                        <div>
                            @if($usr->isAdmin())
                                <span class="badge-role-admin">Admin</span>
                            @else
                                <span class="badge-role-user">User</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p style="color: var(--text-muted); font-size: 0.9rem; text-align: center; padding: 2rem 0;">Belum ada pengguna terdaftar.</p>
        @endif
    </div>
</div>
@endsection
