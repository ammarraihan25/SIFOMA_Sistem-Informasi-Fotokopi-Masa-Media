<aside id="admin-sidebar" class="admin-sidebar">
    <div class="admin-brand">
        SIFOMA Admin
    </div>
    
    <nav class="admin-nav">
        <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
        
        <a href="{{ route('admin.pesanan.index') }}" class="admin-nav-item {{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart"></i>
            <span>Kelola Pesanan</span>
        </a>
        
        <a href="{{ route('admin.layanan.index') }}" class="admin-nav-item {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i>
            <span>Layanan & Harga</span>
        </a>
        
        <a href="{{ route('admin.kategori.index') }}" class="admin-nav-item {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
            <i class="fas fa-layer-group"></i>
            <span>Kategori Layanan</span>
        </a>
        
        <a href="{{ route('admin.promo.index') }}" class="admin-nav-item {{ request()->routeIs('admin.promo.*') ? 'active' : '' }}">
            <i class="fas fa-percentage"></i>
            <span>Kelola Promo</span>
        </a>
        
        <a href="{{ route('admin.portofolio.index') }}" class="admin-nav-item {{ request()->routeIs('admin.portofolio.*') ? 'active' : '' }}">
            <i class="fas fa-images"></i>
            <span>Galeri Portofolio</span>
        </a>
        
        <a href="{{ route('admin.pengaturan.index') }}" class="admin-nav-item {{ request()->routeIs('admin.pengaturan.*') ? 'active' : '' }}">
            <i class="fas fa-cog"></i>
            <span>Pengaturan Toko</span>
        </a>
    </nav>
</aside>
