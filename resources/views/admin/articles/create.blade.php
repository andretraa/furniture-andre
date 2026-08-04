@extends('layouts.admin')

@section('title', 'Tambah Artikel Baru Admin')
@section('page-title', 'Tambah Artikel Baru')

@push('styles')
<style>
    .form-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.4rem;
    }

    .form-label {
        display: block;
        font-size: 0.88rem;
        font-weight: 600;
        color: var(--text-main);
        margin-bottom: 0.5rem;
    }

    .form-label span {
        color: var(--admin-gold);
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        background: var(--admin-bg);
        border: 1px solid var(--admin-border);
        border-radius: var(--radius-md);
        color: var(--text-main);
        font-size: 0.92rem;
        outline: none;
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--admin-gold);
        box-shadow: 0 0 0 3px var(--admin-gold-bg);
    }

    textarea.form-control {
        min-height: 110px;
        resize: vertical;
        line-height: 1.6;
    }

    .image-preview-container {
        width: 100%;
        height: 200px;
        background: var(--admin-bg);
        border: 2px dashed var(--admin-border);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-top: 0.5rem;
        position: relative;
    }

    .image-preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .preview-placeholder {
        text-align: center;
        color: var(--text-sub);
        font-size: 0.85rem;
    }

    .error-msg {
        color: var(--danger);
        font-size: 0.8rem;
        margin-top: 0.4rem;
        display: block;
    }

    .checkbox-custom {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        cursor: pointer;
        padding: 0.8rem 1rem;
        background: var(--admin-bg);
        border: 1px solid var(--admin-border);
        border-radius: var(--radius-md);
    }

    .checkbox-custom input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: var(--admin-gold);
        cursor: pointer;
    }

    @media (max-width: 992px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<form action="{{ route('admin.articles.store') }}" method="POST">
    @csrf

    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
        <div>
            <a href="{{ route('admin.articles.index') }}" class="btn-secondary btn-sm" style="margin-bottom: 0.5rem; display: inline-flex;">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Artikel
            </a>
            <h2 class="font-heading" style="font-size: 1.3rem;">Formulir Artikel Baru</h2>
        </div>
        <div style="display: flex; gap: 0.8rem;">
            <a href="{{ route('admin.articles.index') }}" class="btn-secondary">Batal</a>
            <button type="submit" class="btn-primary">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Artikel
            </button>
        </div>
    </div>

    <div class="form-grid">
        <!-- Main Content Inputs -->
        <div class="admin-card">
            <div class="form-group">
                <label class="form-label">Judul Artikel <span>*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: 5 Tips Memilih Meja Makan Kayu Jati Minimalis" class="form-control" required>
                @error('title') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Ringkasan Singkat (Excerpt) <span>*</span></label>
                <textarea name="excerpt" placeholder="Tuliskan ringkasan singkat artikel yang akan muncul di kartu artikel..." class="form-control" required>{{ old('excerpt') }}</textarea>
                @error('excerpt') <span class="error-msg">{{ $message }}</span> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Konten Lengkap Artikel <span>*</span></label>
                <textarea name="content" style="min-height: 320px;" placeholder="Tuliskan isi lengkap artikel di sini. Anda dapat menggunakan paragraf teks..." class="form-control" required>{{ old('content') }}</textarea>
                @error('content') <span class="error-msg">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Sidebar Inputs (Category, Image, Author, Meta) -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div class="admin-card">
                <h4 class="font-heading" style="font-size: 1rem; margin-bottom: 1.2rem; border-bottom: 1px solid var(--admin-border); padding-bottom: 0.6rem;">
                    <i class="fa-solid fa-sliders" style="color: var(--admin-gold);"></i> Pengaturan Artikel
                </h4>

                <div class="form-group">
                    <label class="form-label">Kategori Artikel <span>*</span></label>
                    <select name="category" class="form-control" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('category') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Penulis (Author) <span>*</span></label>
                    <input type="text" name="author" value="{{ old('author', 'Tim Redaksi DrewWood') }}" class="form-control" required>
                    @error('author') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Estimasi Waktu Baca <span>*</span></label>
                    <input type="text" name="read_time" value="{{ old('read_time', '5 min baca') }}" placeholder="Contoh: 4 min baca" class="form-control" required>
                    @error('read_time') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="checkbox-custom">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                        <div>
                            <div style="font-size: 0.88rem; font-weight: 600; color: var(--text-main);">Tampilkan di Featured</div>
                            <div style="font-size: 0.75rem; color: var(--text-sub);">Artikel akan disorot di bagian atas halaman artikel.</div>
                        </div>
                    </label>
                </div>
            </div>

            <div class="admin-card">
                <h4 class="font-heading" style="font-size: 1rem; margin-bottom: 1rem; border-bottom: 1px solid var(--admin-border); padding-bottom: 0.6rem;">
                    <i class="fa-regular fa-image" style="color: var(--admin-gold);"></i> Gambar Header Artikel
                </h4>

                <div class="form-group">
                    <label class="form-label">URL Gambar (Unsplash / Direct Link) <span>*</span></label>
                    <input type="url" name="image_url" id="image_url" value="{{ old('image_url', 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=800&q=80') }}" placeholder="https://..." class="form-control" required>
                    @error('image_url') <span class="error-msg">{{ $message }}</span> @enderror
                </div>

                <label class="form-label" style="font-size: 0.8rem; color: var(--text-sub);">Pratinjau Gambar:</label>
                <div class="image-preview-container">
                    <img id="img-preview" src="{{ old('image_url', 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?auto=format&fit=crop&w=800&q=80') }}" alt="Preview" onerror="this.style.display='none'; document.getElementById('preview-fallback').style.display='block';">
                    <div id="preview-fallback" class="preview-placeholder" style="display: none;">
                        <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.5rem; color: var(--admin-gold); margin-bottom: 0.3rem;"></i>
                        <div>URL Gambar tidak dapat dimuat</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    const imgUrlInput = document.getElementById('image_url');
    const imgPreview = document.getElementById('img-preview');
    const previewFallback = document.getElementById('preview-fallback');

    if (imgUrlInput && imgPreview) {
        imgUrlInput.addEventListener('input', (e) => {
            const val = e.target.value.trim();
            if (val) {
                imgPreview.src = val;
                imgPreview.style.display = 'block';
                previewFallback.style.display = 'none';
            }
        });
    }
</script>
@endpush
