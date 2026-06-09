<nav class="navbar">
    <div class="container">
        <a href="{{ route('beranda') }}" class="nav-brand">
            <i class="fas fa-print"></i>
            {{ \App\Models\Pengaturan::getValue('nama_toko', 'SIFOMA') }}
        </a>
        
        <button id="nav-toggle" class="nav-toggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <ul id="nav-menu" class="nav-menu">
            <li><a href="{{ route('beranda') }}" class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('layanan') }}" class="nav-link {{ request()->routeIs('layanan') ? 'active' : '' }}">Layanan & Harga</a></li>
            <li><a href="{{ route('pesanan.cek') }}" class="nav-link {{ request()->routeIs('pesanan.*') ? 'active' : '' }}">Cek Pesanan</a></li>
            <li><a href="{{ route('promo') }}" class="nav-link {{ request()->routeIs('promo') ? 'active' : '' }}">Promo & Portofolio</a></li>
            <li><a href="{{ route('tentang-kami') }}" class="nav-link {{ request()->routeIs('tentang-kami') ? 'active' : '' }}">Tentang Kami</a></li>
            <li><a href="{{ route('kontak') }}" class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a></li>
        </ul>
    </div>
</nav>
