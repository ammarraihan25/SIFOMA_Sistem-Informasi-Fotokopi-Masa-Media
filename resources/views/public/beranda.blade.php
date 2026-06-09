@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section class="hero text-center">
    <div class="container animate-on-scroll">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white rounded-full shadow-sm text-sm font-bold text-primary mb-6">
            <span class="relative flex h-3 w-3">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
              <span class="relative inline-flex rounded-full h-3 w-3 bg-primary"></span>
            </span>
            {{ $pengaturan['tagline'] ?? 'Cepat, Rapi, Terpercaya' }}
        </div>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6">
            Pusat Layanan <span class="text-primary">Fotokopi</span> & <br><span class="text-accent">Percetakan</span> Terbaik
        </h1>
        <p class="text-lg md:text-xl text-muted mb-8 max-w-2xl mx-auto">
            {{ $pengaturan['deskripsi_singkat'] ?? 'Melayani kebutuhan cetak, fotokopi, dan penjilidan dengan kualitas premium dan pengerjaan kilat.' }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('layanan') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-search"></i> Lihat Daftar Harga
            </a>
            <a href="{{ route('pesanan.cek') }}" class="btn btn-outline btn-lg bg-white">
                <i class="fas fa-search-location"></i> Cek Status Pesanan
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="container">
        <div class="text-center mb-12 animate-on-scroll">
            <h2 class="text-3xl font-bold mb-4">Mengapa Memilih Kami?</h2>
            <div class="w-24 h-1 bg-primary mx-auto rounded-full"></div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="card p-8 text-center animate-on-scroll" style="animation-delay: 0.1s;">
                <div class="w-16 h-16 bg-primary-light text-primary rounded-full flex items-center justify-center text-2xl mx-auto mb-6">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">{{ $pengaturan['keunggulan_1'] ?? 'Pengerjaan Kilat' }}</h3>
                <p class="text-muted">{{ $pengaturan['keunggulan_1_desc'] ?? 'Pesanan selesai dalam hitungan menit untuk kepuasan Anda.' }}</p>
            </div>
            <div class="card p-8 text-center animate-on-scroll" style="animation-delay: 0.2s;">
                <div class="w-16 h-16 bg-accent-light text-accent rounded-full flex items-center justify-center text-2xl mx-auto mb-6">
                    <i class="fas fa-print"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">{{ $pengaturan['keunggulan_2'] ?? 'Mesin Berteknologi Tinggi' }}</h3>
                <p class="text-muted">{{ $pengaturan['keunggulan_2_desc'] ?? 'Kualitas cetak tajam dan konsisten berkat mesin modern.' }}</p>
            </div>
            <div class="card p-8 text-center animate-on-scroll" style="animation-delay: 0.3s;">
                <div class="w-16 h-16 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-2xl mx-auto mb-6">
                    <i class="fas fa-tags"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">{{ $pengaturan['keunggulan_3'] ?? 'Harga Bersahabat' }}</h3>
                <p class="text-muted">{{ $pengaturan['keunggulan_3_desc'] ?? 'Harga kompetitif, kualitas premium, pas di kantong mahasiswa.' }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Popular Services Section -->
<section class="py-20 bg-main">
    <div class="container">
        <div class="flex justify-between items-end mb-12 animate-on-scroll">
            <div>
                <h2 class="text-3xl font-bold mb-4">Layanan Unggulan Kami</h2>
                <div class="w-24 h-1 bg-primary rounded-full"></div>
            </div>
            <a href="{{ route('layanan') }}" class="btn btn-outline hidden md:inline-flex">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($kategoris as $kategori)
                @if($kategori->layanans->count() > 0)
                <div class="card animate-on-scroll">
                    <div class="card-header flex items-center gap-3 bg-white">
                        <div class="w-10 h-10 rounded bg-primary-light text-primary flex items-center justify-center">
                            <i class="{{ $kategori->icon ?? 'fas fa-file' }}"></i>
                        </div>
                        <h3 class="text-lg font-bold">{{ $kategori->nama }}</h3>
                    </div>
                    <div class="p-0">
                        <table class="table w-full text-sm mb-0">
                            <tbody>
                                @foreach($kategori->layanans as $layanan)
                                <tr>
                                    <td class="font-medium border-0 py-3">{{ $layanan->nama }}</td>
                                    <td class="text-right font-bold text-primary border-0 py-3">
                                        Rp{{ number_format($layanan->harga, 0, ',', '.') }}<span class="text-muted font-normal text-xs">/{{ $layanan->satuan }}</span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white border-t border-gray-100 p-4">
                        <a href="{{ route('layanan', ['kategori' => $kategori->slug]) }}" class="text-sm font-semibold text-primary hover:underline">
                            Lihat semua {{ strtolower($kategori->nama) }} &rarr;
                        </a>
                    </div>
                </div>
                @endif
            @endforeach
        </div>
        
        <div class="text-center mt-8 md:hidden">
            <a href="{{ route('layanan') }}" class="btn btn-outline btn-block">Lihat Semua Layanan</a>
        </div>
    </div>
</section>

<!-- Promo Alert Section -->
@if($promos->count() > 0)
<section class="py-12 bg-primary text-white">
    <div class="container text-center animate-on-scroll">
        <h2 class="text-2xl font-bold mb-6 text-white">Promo Spesial Untuk Anda!</h2>
        <div class="flex flex-wrap justify-center gap-4">
            @foreach($promos as $promo)
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-lg p-6 max-w-sm text-left">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-lg font-bold text-white">{{ $promo->judul }}</h3>
                    @if($promo->diskon_persen)
                    <span class="badge bg-accent text-white">{{ floatval($promo->diskon_persen) }}% OFF</span>
                    @endif
                </div>
                <p class="text-sm text-blue-100 mb-4">{{ Str::limit($promo->deskripsi, 80) }}</p>
                <div class="text-xs text-blue-200">
                    <i class="fas fa-clock"></i> Berlaku s/d {{ \Carbon\Carbon::parse($promo->tanggal_selesai)->translatedFormat('d F Y') }}
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-8">
            <a href="{{ route('promo') }}" class="btn bg-white text-primary hover:bg-gray-100 font-bold">
                Lihat Semua Promo
            </a>
        </div>
    </div>
</section>
@endif
@endsection
