@extends('layouts.app')

@push('styles')
<style>
    .profile-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 1rem 0 3rem 0;
    }

    .profile-header {
        margin-bottom: 2.5rem;
    }

    .profile-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--text-primary);
        letter-spacing: -0.5px;
        margin-bottom: 0.3rem;
    }

    .profile-header p {
        color: var(--text-secondary);
        font-size: 0.98rem;
    }

    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 1.3fr;
        gap: 2.5rem;
        align-items: start;
    }

    .card-box {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 2.2rem;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }

    .card-box:hover {
        box-shadow: var(--shadow-md);
    }

    .card-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding-bottom: 0.9rem;
        border-bottom: 1px solid var(--border-color);
    }

    .card-title i {
        color: var(--accent-warm);
    }

    /* Avatar Upload Section */
    .avatar-section {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 2rem;
        text-align: center;
    }

    .avatar-preview-container {
        position: relative;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        margin-bottom: 1.2rem;
        border: 3px solid var(--accent-warm);
        box-shadow: 0 8px 25px rgba(197, 155, 39, 0.25);
        overflow: hidden;
        background: var(--dark-primary);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-fallback {
        font-size: 3rem;
        font-weight: 800;
        color: var(--accent-warm);
        text-transform: uppercase;
    }

    .avatar-upload-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.55rem 1.2rem;
        background: var(--bg-primary);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-full);
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        color: var(--text-primary);
    }

    .avatar-upload-btn:hover {
        background: var(--dark-primary);
        color: #FFFFFF;
        border-color: var(--dark-primary);
    }

    .avatar-file-input {
        display: none;
    }

    /* Form Inputs */
    .profile-form {
        display: flex;
        flex-direction: column;
        gap: 1.2rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .form-group label {
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--text-primary);
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-wrapper i {
        position: absolute;
        left: 1rem;
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .input-wrapper input {
        width: 100%;
        padding: 0.85rem 1rem 0.85rem 2.6rem;
        border-radius: var(--radius-md);
        border: 1px solid var(--border-color);
        background: var(--bg-primary);
        font-size: 0.92rem;
        color: var(--text-primary);
        outline: none;
        transition: var(--transition);
    }

    .input-wrapper input:focus {
        border-color: var(--accent-warm);
        background: #FFFFFF;
        box-shadow: 0 0 0 4px rgba(197, 155, 39, 0.15);
    }

    .btn-save-profile {
        background: var(--dark-primary);
        color: #FFFFFF;
        border: none;
        padding: 0.95rem;
        border-radius: var(--radius-full);
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 0.8rem;
    }

    .btn-save-profile:hover {
        background: var(--accent-warm);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(197, 155, 39, 0.3);
    }

    /* Saved Cart Items Section */
    .profile-cart-list {
        display: flex;
        flex-direction: column;
        gap: 1.1rem;
        max-height: 440px;
        overflow-y: auto;
        padding-right: 0.5rem;
    }

    .profile-cart-item {
        display: flex;
        align-items: center;
        gap: 1.2rem;
        padding: 0.9rem;
        border-radius: var(--radius-md);
        border: 1px solid var(--border-color);
        background: var(--bg-primary);
        transition: var(--transition);
    }

    .profile-cart-item:hover {
        border-color: var(--accent-warm);
        background: #FFFFFF;
    }

    .profile-cart-item img {
        width: 65px;
        height: 65px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid var(--border-color);
    }

    .profile-cart-details {
        flex: 1;
    }

    .profile-cart-title {
        font-weight: 700;
        font-size: 0.95rem;
        color: var(--text-primary);
        margin-bottom: 0.2rem;
    }

    .profile-cart-price {
        font-size: 0.88rem;
        color: var(--accent-warm);
        font-weight: 600;
    }

    .cart-summary-box {
        margin-top: 1.5rem;
        padding-top: 1.2rem;
        border-top: 1px dashed var(--border-color);
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 1.2rem;
    }

    .btn-profile-checkout {
        width: 100%;
        background: #25D366;
        color: #FFFFFF;
        border: none;
        padding: 0.9rem;
        border-radius: var(--radius-full);
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        transition: var(--transition);
        text-decoration: none;
    }

    .btn-profile-checkout:hover {
        background: #1EBE57;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.3);
    }

    .empty-cart-state {
        text-align: center;
        padding: 3rem 1rem;
        color: var(--text-muted);
    }

    .empty-cart-state i {
        font-size: 3rem;
        margin-bottom: 0.8rem;
        display: block;
    }

    .input-error {
        color: #DC2626;
        font-size: 0.8rem;
        margin-top: 0.2rem;
    }

    @media (max-width: 850px) {
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .card-box {
            padding: 1.5rem 1.1rem;
            border-radius: var(--radius-md);
        }
        .profile-header h1 {
            font-size: 1.7rem;
        }
        .profile-cart-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.8rem;
        }
        .profile-cart-item img {
            width: 100%;
            height: 140px;
        }
    }
</style>
@endpush

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <h1>Profil Saya</h1>
        <p>Kelola informasi pribadi, foto profil, dan lihat item di keranjang belanja Anda</p>
    </div>

    @if (session('success'))
        <div style="background: #ECFDF5; border: 1px solid #6EE7B7; color: #065F46; padding: 1rem 1.2rem; border-radius: var(--radius-md); margin-bottom: 1.8rem; display: flex; align-items: center; gap: 0.8rem;">
            <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="profile-grid">
        <!-- Section 1: Edit Informasi Pengguna & Avatar -->
        <div class="card-box">
            <div class="card-title">
                <i class="fa-regular fa-user"></i> Data Pribadi & Foto Profil
            </div>

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
                @csrf

                <!-- Avatar Preview & Upload -->
                <div class="avatar-section">
                    <div class="avatar-preview-container">
                        <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" id="avatar-preview-img" onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=1C1917&color=C59B27&bold=true';">
                    </div>

                    <label class="avatar-upload-btn">
                        <i class="fa-solid fa-camera"></i> Unggah Foto Baru
                        <input type="file" name="avatar" class="avatar-file-input" id="avatar-input" accept="image/*">
                    </label>
                    @error('avatar')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input Nama Lengkap -->
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-id-card"></i>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    </div>
                    @error('name')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input Email -->
                <div class="form-group">
                    <label for="email">Alamat Email</label>
                    <div class="input-wrapper">
                        <i class="fa-regular fa-envelope"></i>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </div>
                    @error('email')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Ubah Password (Opsional) -->
                <div class="form-group" style="margin-top: 0.5rem;">
                    <label for="password">Kata Sandi Baru (Opsional)</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password" name="password" placeholder="Kosongkan jika tidak ingin diubah">
                    </div>
                    @error('password')
                        <span class="input-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                    <div class="input-wrapper">
                        <i class="fa-solid fa-lock-open"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi baru">
                    </div>
                </div>

                <button type="submit" class="btn-save-profile">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan
                </button>
            </form>
        </div>

        <!-- Section 2: Keranjang Belanja Pengguna -->
        <div class="card-box">
            <div class="card-title">
                <i class="fa-solid fa-basket-shopping"></i> Keranjang Belanja Saya
            </div>

            <div id="profile-cart-container">
                <div class="empty-cart-state">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                    <p>Memuat keranjang belanja Anda...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Live Avatar Preview Handler
    const avatarInput = document.getElementById('avatar-input');
    const avatarPreviewImg = document.getElementById('avatar-preview-img');
    const avatarFallbackText = document.getElementById('avatar-fallback-text');

    if (avatarInput) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    avatarPreviewImg.src = evt.target.result;
                    avatarPreviewImg.style.display = 'block';
                    if (avatarFallbackText) {
                        avatarFallbackText.style.display = 'none';
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Render Saved Cart Items in Profile Page
    function renderProfileCart() {
        const cartContainer = document.getElementById('profile-cart-container');
        const cartData = JSON.parse(localStorage.getItem('luxewood_cart')) || [];

        if (cartData.length === 0) {
            cartContainer.innerHTML = `
                <div class="empty-cart-state">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <h4 style="font-weight: 700; color: var(--text-primary); margin-bottom: 0.3rem;">Keranjang Anda Kosong</h4>
                    <p style="font-size: 0.9rem; margin-bottom: 1.5rem;">Anda belum menambahkan produk apapun ke keranjang.</p>
                    <a href="{{ route('home') }}" class="btn-nav-register" style="display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem;">
                        <i class="fa-solid fa-couch"></i> Jelajahi Katalog Furniture
                    </a>
                </div>
            `;
            return;
        }

        let totalPrice = 0;
        let html = '<div class="profile-cart-list">';

        cartData.forEach((item, index) => {
            const subtotal = item.price * item.quantity;
            totalPrice += subtotal;

            html += `
                <div class="profile-cart-item">
                    <img src="${item.image_url}" alt="${item.name}">
                    <div class="profile-cart-details">
                        <div class="profile-cart-title">${item.name}</div>
                        <div class="profile-cart-price">Rp ${item.price.toLocaleString('id-ID')} x ${item.quantity} unit</div>
                    </div>
                    <div style="font-weight: 700; font-size: 0.95rem; color: var(--text-primary);">
                        Rp ${subtotal.toLocaleString('id-ID')}
                    </div>
                </div>
            `;
        });

        html += '</div>';

        html += `
            <div class="cart-summary-box">
                <div class="summary-row">
                    <span>Total Estimasi:</span>
                    <span style="color: var(--accent-warm);">Rp ${totalPrice.toLocaleString('id-ID')}</span>
                </div>
                <button class="btn-profile-checkout" onclick="document.getElementById('btn-checkout-whatsapp').click()">
                    <i class="fa-brands fa-whatsapp"></i> Pesan Semua via WhatsApp
                </button>
            </div>
        `;

        cartContainer.innerHTML = html;
    }

    document.addEventListener('DOMContentLoaded', renderProfileCart);
</script>
@endpush
