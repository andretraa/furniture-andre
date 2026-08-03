@extends('layouts.app')

@push('styles')
<style>
    .auth-container {
        min-height: 75vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .auth-card {
        background: var(--bg-surface);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        width: 100%;
        max-width: 460px;
        padding: 2.5rem 2.2rem;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }

    .auth-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--dark-primary) 0%, var(--accent-warm) 100%);
    }

    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-header h1 {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 0.4rem;
        letter-spacing: -0.5px;
    }

    .auth-header p {
        color: var(--text-secondary);
        font-size: 0.92rem;
    }

    .auth-form {
        display: flex;
        flex-direction: column;
        gap: 1.3rem;
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
        font-size: 0.95rem;
        color: var(--text-primary);
        outline: none;
        transition: var(--transition);
    }

    .input-wrapper input:focus {
        border-color: var(--accent-warm);
        background: #FFFFFF;
        box-shadow: 0 0 0 4px rgba(197, 155, 39, 0.15);
    }

    .form-options {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-size: 0.88rem;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        color: var(--text-secondary);
    }

    .remember-me input[type="checkbox"] {
        accent-color: var(--accent-warm);
        width: 16px;
        height: 16px;
    }

    .btn-auth-submit {
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
        margin-top: 0.5rem;
    }

    .btn-auth-submit:hover {
        background: var(--accent-warm);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(197, 155, 39, 0.3);
    }

    .auth-footer {
        text-align: center;
        margin-top: 1.8rem;
        padding-top: 1.4rem;
        border-top: 1px dashed var(--border-color);
        font-size: 0.9rem;
        color: var(--text-secondary);
    }

    .auth-footer a {
        color: var(--accent-warm);
        font-weight: 600;
        text-decoration: none;
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }

    .error-alert {
        background: #FEF2F2;
        border: 1px solid #FCA5A5;
        color: #991B1B;
        padding: 0.85rem 1rem;
        border-radius: var(--radius-md);
        font-size: 0.88rem;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .input-error {
        color: #DC2626;
        font-size: 0.8rem;
        margin-top: 0.2rem;
    }

    @media (max-width: 480px) {
        .auth-card {
            padding: 1.8rem 1.3rem;
            border-radius: var(--radius-md);
        }
        .auth-header h1 {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h1>Selamat Datang Kembali</h1>
            <p>Masuk ke akun DrewWood Anda untuk melanjutkan belanja</p>
        </div>

        @if ($errors->any())
            <div class="error-alert">
                <i class="fa-solid fa-circle-exclamation"></i>
                <div>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autofocus>
                </div>
                @error('email')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
                @error('password')
                    <span class="input-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <span>Ingat Saya</span>
                </label>
            </div>

            <button type="submit" class="btn-auth-submit">
                Masuk Ke Akun <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>

        <div class="auth-footer">
            Belum memiliki akun DrewWood? <a href="{{ route('register') }}">Daftar Sekarang</a>
        </div>
    </div>
</div>
@endsection
