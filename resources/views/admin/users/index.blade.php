@extends('layouts.admin')

@section('title', 'Daftar Akun Pengguna Admin')
@section('page-title', 'Akun Pengguna Terdaftar')

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
        max-width: 550px;
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

    .select-role {
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

    .user-avatar-table {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid var(--admin-border);
    }

    .badge-role-admin {
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        background: var(--admin-gold-bg);
        color: var(--admin-gold);
        border: 1px solid rgba(197, 155, 39, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-role-user {
        font-size: 0.75rem;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.08);
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .pagination-wrapper {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
    }
</style>
@endpush

@section('content')
<!-- Filter Bar -->
<div class="filter-bar">
    <form action="{{ route('admin.users.index') }}" method="GET" class="search-box">
        <input type="text" name="q" value="{{ $searchQuery }}" placeholder="Cari berdasarkan nama pengguna atau email..." class="input-search">
        
        <select name="role" onchange="this.form.submit()" class="select-role">
            <option value="all" {{ $selectedRole === 'all' ? 'selected' : '' }}>Semua Peran</option>
            <option value="admin" {{ $selectedRole === 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ $selectedRole === 'user' ? 'selected' : '' }}>User Regular</option>
        </select>
        
        <button type="submit" class="btn-secondary" style="padding: 0.7rem 1rem;">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </form>

    <div style="font-size: 0.9rem; color: var(--text-muted);">
        Total Akun Terdaftar: <strong style="color: var(--admin-gold);">{{ $users->total() }}</strong>
    </div>
</div>

<!-- Users Table Card -->
<div class="admin-card">
    @if($users->count() > 0)
        <div style="overflow-x: auto;">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Pengguna</th>
                        <th>Alamat Email</th>
                        <th>Peran (Role)</th>
                        <th>Tanggal Terdaftar</th>
                        <th style="text-align: right;">Kelola Peran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $index => $usr)
                        <tr>
                            <td><span style="color: var(--text-sub); font-size: 0.85rem;">{{ $users->firstItem() + $index }}</span></td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.9rem;">
                                    <img src="{{ $usr->avatar_url }}" alt="{{ $usr->name }}" class="user-avatar-table">
                                    <div>
                                        <div style="font-weight: 700; color: var(--text-main); font-size: 0.95rem;">
                                            {{ $usr->name }}
                                            @if($usr->id === Auth::id())
                                                <span style="font-size: 0.7rem; background: var(--admin-gold-bg); color: var(--admin-gold); padding: 2px 6px; border-radius: 4px; margin-left: 4px;">Saya</span>
                                            @endif
                                        </div>
                                        <div style="font-size: 0.78rem; color: var(--text-sub);">ID: #{{ $usr->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span style="font-size: 0.9rem; color: var(--text-main);">{{ $usr->email }}</span>
                            </td>
                            <td>
                                @if($usr->isAdmin())
                                    <span class="badge-role-admin"><i class="fa-solid fa-shield-halved"></i> Admin</span>
                                @else
                                    <span class="badge-role-user"><i class="fa-regular fa-user"></i> User</span>
                                @endif
                            </td>
                            <td>
                                <span style="font-size: 0.85rem; color: var(--text-muted);">
                                    {{ $usr->created_at->format('d M Y, H:i') }}
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; justify-content: flex-end;">
                                    @if($usr->id !== Auth::id())
                                        <form action="{{ route('admin.users.toggle-role', $usr->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin mengubah peran pengguna {{ $usr->name }} menjadi {{ $usr->isAdmin() ? 'USER' : 'ADMIN' }}?');" style="margin: 0;">
                                            @csrf
                                            @method('PATCH')
                                            @if($usr->isAdmin())
                                                <button type="submit" class="btn-secondary btn-sm" title="Ubah menjadi User Biasa">
                                                    <i class="fa-solid fa-user-minus"></i> Ubah ke User
                                                </button>
                                            @else
                                                <button type="submit" class="btn-primary btn-sm" title="Jadikan Admin">
                                                    <i class="fa-solid fa-user-shield"></i> Jadikan Admin
                                                </button>
                                            @endif
                                        </form>
                                    @else
                                        <span style="font-size: 0.78rem; color: var(--text-sub); font-style: italic;">Akun Aktif Anda</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $users->links() }}
        </div>
    @else
        <div style="text-align: center; padding: 3rem 1rem;">
            <i class="fa-solid fa-users-slash" style="font-size: 3rem; color: var(--text-sub); margin-bottom: 1rem;"></i>
            <h3 class="font-heading" style="color: var(--text-main); margin-bottom: 0.5rem;">Pengguna Tidak Ditemukan</h3>
            <p style="color: var(--text-muted); max-width: 400px; margin: 0 auto; font-size: 0.9rem;">
                Tidak ada pengguna yang cocok dengan kriteria pencarian Anda.
            </p>
        </div>
    @endif
</div>
@endsection
