<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kundrew— Premium & Modern Furniture Collection</title>
    
    <!-- Meta Description for SEO -->
    <meta name="description" content="Koleksi furniture kayu jati dan desain interior modern mewah untuk rumah Anda. Kursi, meja makan, tempat tidur, & sofa berkualitas tinggi.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-primary: #FBF9F5;
            --bg-surface: #FFFFFF;
            --bg-card: #FFFFFF;
            --text-primary: #1C1917;
            --text-secondary: #78716C;
            --text-muted: #A8A29E;
            --accent-warm: #C59B27;
            --accent-hover: #A37F1D;
            --accent-light: #FDF8E8;
            --dark-primary: #1C1917;
            --dark-surface: #262320;
            --border-color: #E7E5E4;
            --shadow-sm: 0 2px 8px rgba(28, 25, 23, 0.04);
            --shadow-md: 0 10px 30px rgba(28, 25, 23, 0.08);
            --shadow-lg: 0 20px 40px rgba(28, 25, 23, 0.12);
            --radius-md: 12px;
            --radius-lg: 20px;
            --radius-full: 9999px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        h1, h2, h3, h4, .font-heading {
            font-family: 'Outfit', sans-serif;
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* Glassmorphism Navbar */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(251, 249, 245, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(231, 229, 228, 0.8);
            padding: 1.1rem 2rem;
            transition: var(--transition);
        }

        .navbar-container {
            max-width: 1280px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }

        .logo-brand {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            text-decoration: none;
            color: var(--text-primary);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: var(--dark-primary);
            color: var(--accent-warm);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .logo-text {
            font-family: 'Outfit', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--text-primary);
        }

        .logo-text span {
            color: var(--accent-warm);
        }

        .nav-search {
            flex: 1;
            max-width: 450px;
            position: relative;
        }

        .nav-search input {
            width: 100%;
            padding: 0.75rem 1.2rem 0.75rem 2.8rem;
            border-radius: var(--radius-full);
            border: 1px solid var(--border-color);
            background: var(--bg-surface);
            font-size: 0.92rem;
            color: var(--text-primary);
            outline: none;
            transition: var(--transition);
        }

        .nav-search input:focus {
            border-color: var(--accent-warm);
            box-shadow: 0 0 0 4px rgba(197, 155, 39, 0.12);
        }

        .nav-search i {
            position: absolute;
            left: 1.1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 0.9rem;
        }

        .btn-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: 1px solid var(--border-color);
            background: var(--bg-surface);
            color: var(--text-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            transition: var(--transition);
            text-decoration: none;
        }

        .btn-icon:hover {
            background: var(--dark-primary);
            color: #FFFFFF;
            border-color: var(--dark-primary);
            transform: translateY(-2px);
        }

        .cart-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: var(--accent-warm);
            color: #FFFFFF;
            font-size: 0.7rem;
            font-weight: 700;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid var(--bg-surface);
        }

        .btn-nav-login {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.55rem 1.1rem;
            border-radius: var(--radius-full);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            font-size: 0.88rem;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-nav-login:hover {
            background: var(--dark-primary);
            color: #FFFFFF;
            border-color: var(--dark-primary);
        }

        .btn-nav-register {
            display: inline-flex;
            align-items: center;
            padding: 0.55rem 1.2rem;
            border-radius: var(--radius-full);
            background: var(--accent-warm);
            color: #FFFFFF;
            font-size: 0.88rem;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-nav-register:hover {
            background: var(--accent-hover);
            transform: translateY(-1px);
        }

        .user-dropdown-container {
            position: relative;
        }

        .user-profile-btn {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            padding: 0.4rem 0.8rem 0.4rem 0.5rem;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-full);
            cursor: pointer;
            transition: var(--transition);
            color: var(--text-primary);
        }

        .user-profile-btn:hover {
            border-color: var(--accent-warm);
            box-shadow: var(--shadow-sm);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--dark-primary);
            color: var(--accent-warm);
            font-weight: 700;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-name {
            font-size: 0.88rem;
            font-weight: 600;
            max-width: 120px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-dropdown-menu {
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            width: 220px;
            background: var(--bg-surface);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-md);
            display: none;
            flex-direction: column;
            z-index: 120;
            overflow: hidden;
        }

        .user-dropdown-menu.show {
            display: flex;
        }

        .user-dropdown-header {
            padding: 0.9rem 1.1rem;
            background: var(--bg-primary);
        }

        .user-dropdown-name {
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--text-primary);
        }

        .user-dropdown-email {
            font-size: 0.78rem;
            color: var(--text-secondary);
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-dropdown-divider {
            height: 1px;
            background: var(--border-color);
        }

        .user-dropdown-item {
            width: 100%;
            padding: 0.75rem 1.1rem;
            border: none;
            background: transparent;
            text-align: left;
            font-size: 0.88rem;
            font-weight: 500;
            color: var(--text-primary);
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            transition: var(--transition);
        }

        .user-dropdown-item.logout-btn {
            color: #DC2626;
        }

        .user-dropdown-item:hover {
            background: rgba(28, 25, 23, 0.05);
        }

        .user-dropdown-item.logout-btn:hover {
            background: #FEF2F2;
        }

        .main-container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2rem 1.5rem 4rem 1.5rem;
        }

        /* Cart Drawer */
        .cart-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
        }

        .cart-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .cart-drawer {
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            max-width: 420px;
            height: 100vh;
            background: var(--bg-surface);
            z-index: 1000;
            box-shadow: var(--shadow-lg);
            display: flex;
            flex-direction: column;
            transform: translateX(100%);
            transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .cart-overlay.active .cart-drawer {
            transform: translateX(0);
        }

        .cart-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .cart-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
        }

        .btn-close {
            background: none;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            color: var(--text-muted);
            transition: var(--transition);
        }

        .btn-close:hover {
            color: var(--text-primary);
        }

        .cart-body {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .cart-empty {
            text-align: center;
            padding: 3rem 1rem;
            color: var(--text-muted);
        }

        .cart-empty i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--border-color);
        }

        .cart-item {
            display: flex;
            gap: 1rem;
            align-items: center;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .cart-item img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: var(--radius-md);
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-title {
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.2rem;
        }

        .cart-item-price {
            font-weight: 700;
            color: var(--accent-warm);
            font-size: 0.9rem;
        }

        .cart-footer {
            padding: 1.5rem;
            border-top: 1px solid var(--border-color);
            background: var(--bg-primary);
        }

        .cart-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.2rem;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .btn-checkout {
            width: 100%;
            padding: 0.9rem;
            background: var(--dark-primary);
            color: #FFFFFF;
            border: none;
            border-radius: var(--radius-full);
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            transition: var(--transition);
        }

        .btn-checkout:hover {
            background: var(--accent-warm);
        }

        /* Toast notification */
        .toast-notification {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            background: var(--dark-primary);
            color: #FFFFFF;
            padding: 0.9rem 1.4rem;
            border-radius: var(--radius-md);
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 0.8rem;
            z-index: 1050;
            transform: translateY(100px);
            opacity: 0;
            transition: var(--transition);
        }

        .toast-notification.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast-notification i {
            color: var(--accent-warm);
            font-size: 1.2rem;
        }

        /* Footer */
        .footer {
            background: var(--dark-primary);
            color: #A8A29E;
            padding: 4rem 2rem 2rem 2rem;
            margin-top: 4rem;
        }

        .footer-container {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 3rem;
            padding-bottom: 3rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .footer-brand h2 {
            color: #FFFFFF;
            font-size: 1.6rem;
            margin-bottom: 1rem;
        }

        .footer-brand p {
            font-size: 0.9rem;
            line-height: 1.7;
        }

        .footer-title {
            color: #FFFFFF;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0.7rem;
        }

        .footer-links a {
            color: #A8A29E;
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .footer-links a:hover {
            color: var(--accent-warm);
        }

        .footer-bottom {
            max-width: 1280px;
            margin: 0 auto;
            padding-top: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0.9rem 1.2rem;
            }
            .navbar-container {
                flex-wrap: wrap;
                gap: 0.8rem;
            }
            .nav-search {
                order: 3;
                max-width: 100%;
                margin-top: 0.2rem;
            }
            .main-container {
                padding: 1.5rem 1rem 3rem 1rem;
            }
            .footer-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 0.75rem 0.9rem;
            }
            .logo-text {
                font-size: 1.25rem;
            }
            .logo-icon {
                width: 34px;
                height: 34px;
                font-size: 1rem;
            }
            .nav-actions {
                gap: 0.5rem;
            }
            .btn-nav-login {
                padding: 0.45rem 0.8rem;
                font-size: 0.8rem;
            }
            .btn-nav-register {
                padding: 0.45rem 0.85rem;
                font-size: 0.8rem;
            }
            .user-name {
                display: none;
            }
            .user-profile-btn {
                padding: 0.3rem;
            }
            .cart-drawer {
                max-width: 100%;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Header Navigation -->
    <nav class="navbar">
        <div class="navbar-container">
            <a href="{{ route('home') }}" class="logo-brand">
                <div class="logo-icon"><i class="fa-solid fa-couch"></i></div>
                <div class="logo-text">DREW<span>WOOD</span></div>
            </a>

            <form action="{{ route('home') }}" method="GET" class="nav-search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari sofa, meja makan, tempat tidur..." id="search-input">
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
            </form>

            <div class="nav-actions">
                <a href="{{ route('articles.index') }}" class="btn-nav-login" style="border: none; background: transparent;">
                    <i class="fa-solid fa-book-open"></i> Artikel
                </a>

                <button class="btn-icon" id="cart-toggle" aria-label="Keranjang Belanja">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="cart-badge" id="cart-count">0</span>
                </button>

                @guest
                    <a href="{{ route('login') }}" class="btn-nav-login">
                        <i class="fa-regular fa-user"></i> Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn-nav-register">
                        Daftar
                    </a>
                @endguest

                @auth
                    <div class="user-dropdown-container">
                        <button class="user-profile-btn" id="user-menu-toggle">
                            <div class="user-avatar" style="overflow: hidden;">
                                <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1C1917&color=C59B27&bold=true';">
                            </div>
                            <span class="user-name">{{ Auth::user()->name }}</span>
                            <i class="fa-solid fa-chevron-down" style="font-size: 0.75rem;"></i>
                        </button>
                        <div class="user-dropdown-menu" id="user-dropdown-menu">
                            <div class="user-dropdown-header">
                                <div class="user-dropdown-name">{{ Auth::user()->name }}</div>
                                <div class="user-dropdown-email">{{ Auth::user()->email }}</div>
                            </div>
                            <div class="user-dropdown-divider"></div>
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="user-dropdown-item" style="text-decoration: none; color: var(--accent-warm); font-weight: 600;">
                                    <i class="fa-solid fa-gauge-high"></i> Dashboard Admin
                                </a>
                                <div class="user-dropdown-divider"></div>
                            @endif
                            <a href="{{ route('profile') }}" class="user-dropdown-item" style="text-decoration: none;">
                                <i class="fa-regular fa-user"></i> Profil Saya
                            </a>
                            <div class="user-dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="user-dropdown-item logout-btn">
                                    <i class="fa-solid fa-right-from-bracket"></i> Keluar (Logout)
                                </button>
                            </form>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="main-container">
        @yield('content')
    </main>

    <!-- Cart Side Drawer -->
    <div class="cart-overlay" id="cart-overlay">
        <div class="cart-drawer">
            <div class="cart-header">
                <h3>Keranjang Belanja (<span id="cart-drawer-count">0</span>)</h3>
                <button class="btn-close" id="cart-close"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="cart-body" id="cart-items-container">
                <div class="cart-empty">
                    <i class="fa-solid fa-basket-shopping"></i>
                    <p>Keranjang Anda masih kosong.</p>
                </div>
            </div>
            <div class="cart-footer">
                <div class="cart-total">
                    <span>Total Estimasi:</span>
                    <span id="cart-total-price" style="color: var(--accent-warm);">Rp 0</span>
                </div>
                <button class="btn-checkout" id="btn-checkout-whatsapp">
                    <i class="fa-brands fa-whatsapp"></i> Pesan via WhatsApp
                </button>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-notification" id="toast">
        <i class="fa-solid fa-circle-check"></i>
        <span id="toast-message">Produk telah ditambahkan ke keranjang!</span>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-brand">
                <h2>KUNDREWWOOD</h2>
                <p>Produsen dan penyedia furniture kayu kualitas ekspor dengan keahlian pengrajin profesional. Menghadirkan kemewahan & kenyamanan di setiap sudut ruangan Anda.</p>
            </div>
            <div>
                <h4 class="footer-title">Kategori</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('home', ['category' => 'Living Room']) }}">Ruang Tamu</a></li>
                    <li><a href="{{ route('home', ['category' => 'Dining Room']) }}">Ruang Makan</a></li>
                    <li><a href="{{ route('home', ['category' => 'Bedroom']) }}">Kamar Tidur</a></li>
                    <li><a href="{{ route('home', ['category' => 'Office']) }}">Perkantoran</a></li>
                    <li><a href="{{ route('home', ['category' => 'Outdoor']) }}">Outdoor & Taman</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">Layanan & Informasi</h4>
                <ul class="footer-links">
                    <li><a href="{{ route('articles.index') }}">Profil & Artikel Perusahaan</a></li>
                    <li><a href="#">Custom Furniture</a></li>
                    <li><a href="#">Konsultasi Desain Interior</a></li>
                    <li><a href="#">Garansi Kayu 5 Tahun</a></li>
                    <li><a href="#">Pengiriman Seluruh Indonesia</a></li>
                </ul>
            </div>
            <div>
                <h4 class="footer-title">Kontak Kami</h4>
                <ul class="footer-links">
                    <li><i class="fa-solid fa-location-dot" style="margin-right: 6px;"></i> Jl. Sariwangi RT 04 RW 08, Kecamatan Parongpong</li>
                    <li><i class="fa-solid fa-phone" style="margin-right: 6px;"></i> +62 857-2911-1190</li>
                    <li><i class="fa-solid fa-envelope" style="margin-right: 6px;"></i> info@drewood.com</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} LUXEWOOD Furniture. All rights reserved.</p>
            <p>Made with passion for Luxury Living.</p>
        </div>
    </footer>

    <!-- Global Cart & UI Script -->
    <script>
        let cart = JSON.parse(localStorage.getItem('luxewood_cart')) || [];

        function updateCartUI() {
            const countEl = document.getElementById('cart-count');
            const drawerCountEl = document.getElementById('cart-drawer-count');
            const containerEl = document.getElementById('cart-items-container');
            const totalPriceEl = document.getElementById('cart-total-price');

            const totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);
            countEl.textContent = totalItems;
            drawerCountEl.textContent = totalItems;

            if (cart.length === 0) {
                containerEl.innerHTML = `
                    <div class="cart-empty">
                        <i class="fa-solid fa-basket-shopping"></i>
                        <p>Keranjang Anda masih kosong.</p>
                    </div>
                `;
                totalPriceEl.textContent = 'Rp 0';
                return;
            }

            let totalPrice = 0;
            let html = '';

            cart.forEach((item, index) => {
                const itemTotal = item.price * item.quantity;
                totalPrice += itemTotal;

                html += `
                    <div class="cart-item">
                        <img src="${item.image_url}" alt="${item.name}">
                        <div class="cart-item-details">
                            <div class="cart-item-title">${item.name}</div>
                            <div class="cart-item-price">Rp ${item.price.toLocaleString('id-ID')} x ${item.quantity}</div>
                        </div>
                        <button onclick="removeFromCart(${index})" class="btn-close" style="font-size: 0.9rem;">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </div>
                `;
            });

            containerEl.innerHTML = html;
            totalPriceEl.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
        }

        function addToCart(product) {
            const existingIndex = cart.findIndex(item => item.id === product.id);
            if (existingIndex > -1) {
                cart[existingIndex].quantity += 1;
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    image_url: product.image_url,
                    quantity: 1
                });
            }

            localStorage.setItem('luxewood_cart', JSON.stringify(cart));
            updateCartUI();
            showToast(`"${product.name}" berhasil ditambahkan ke keranjang!`);
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            localStorage.setItem('luxewood_cart', JSON.stringify(cart));
            updateCartUI();
        }

        function showToast(message) {
            const toast = document.getElementById('toast');
            document.getElementById('toast-message').textContent = message;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 3000);
        }

        // Cart Drawer Toggles
        document.getElementById('cart-toggle').addEventListener('click', (e) => {
            e.preventDefault();
            document.getElementById('cart-overlay').classList.add('active');
        });

        document.getElementById('cart-close').addEventListener('click', () => {
            document.getElementById('cart-overlay').classList.remove('active');
        });

        document.getElementById('cart-overlay').addEventListener('click', (e) => {
            if (e.target.id === 'cart-overlay') {
                document.getElementById('cart-overlay').classList.remove('active');
            }
        });

        // WhatsApp Checkout Handler
        document.getElementById('btn-checkout-whatsapp').addEventListener('click', () => {
            if (cart.length === 0) {
                alert('Keranjang belanja Anda kosong!');
                return;
            }

            let message = "Halo LuxeWood Furniture, saya ingin memesan produk berikut:\n\n";
            let grandTotal = 0;

            cart.forEach((item, index) => {
                const subtotal = item.price * item.quantity;
                grandTotal += subtotal;
                message += `${index + 1}. ${item.name} (${item.quantity}x) = Rp ${subtotal.toLocaleString('id-ID')}\n`;
            });

            message += `\n*Total Estimasi: Rp ${grandTotal.toLocaleString('id-ID')}*\n\nMohon info ketersediaan stok & estimasi ongkir. Terima kasih!`;
            
            const encodedMessage = encodeURIComponent(message);
            window.open(`https://wa.me/6281234567890?text=${encodedMessage}`, '_blank');
        });

        // User Dropdown Handler
        const userToggle = document.getElementById('user-menu-toggle');
        const userMenu = document.getElementById('user-dropdown-menu');
        if (userToggle && userMenu) {
            userToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                userMenu.classList.toggle('show');
            });

            document.addEventListener('click', () => {
                userMenu.classList.remove('show');
            });
        }

        // Session Notifications
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', () => {
                showToast("{{ session('success') }}");
            });
        @endif
        @if(session('info'))
            document.addEventListener('DOMContentLoaded', () => {
                showToast("{{ session('info') }}");
            });
        @endif

        // Initialize UI
        document.addEventListener('DOMContentLoaded', updateCartUI);
    </script>
    @stack('scripts')
</body>
</html>
