@extends('layouts.app')

@section('title', 'Promo & Portofolio')

@section('content')
<section class="bg-primary-light py-12">
    <div class="container">
        <div class="text-center max-w-2xl mx-auto animate-on-scroll">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 text-primary-dark">Promo & Galeri Kami</h1>
            <p class="text-muted">Dapatkan penawaran terbaik dan lihat hasil karya cetak unggulan kami.</p>
        </div>
    </div>
</section>

<!-- Promo Section -->
@if($promos->count() > 0)
<section class="py-16">
    <div class="container">
        <h2 class="text-2xl font-bold mb-8 flex items-center gap-3 animate-on-scroll">
            <i class="fas fa-tags text-accent"></i> Promo & Diskon Spesial
        </h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($promos as $promo)
            <div class="card overflow-hidden animate-on-scroll border-t-4 border-t-accent h-full flex flex-col">
                @if($promo->gambar)
                <img src="{{ Storage::url($promo->gambar) }}" alt="{{ $promo->judul }}" class="w-full h-48 object-cover">
                @else
                <div class="w-full h-32 bg-accent/10 flex flex-col items-center justify-center text-accent">
                    <i class="fas fa-gift text-4xl mb-2"></i>
                    @if($promo->diskon_persen)
                    <span class="font-black text-2xl">{{ floatval($promo->diskon_persen) }}% OFF</span>
                    @endif
                </div>
                @endif
                
                <div class="card-body flex-1 flex flex-col">
                    <div class="flex justify-between items-start mb-3">
                        <h3 class="text-lg font-bold">{{ $promo->judul }}</h3>
                        @if($promo->diskon_persen && $promo->gambar)
                        <span class="badge bg-accent text-white">{{ floatval($promo->diskon_persen) }}% OFF</span>
                        @endif
                    </div>
                    <p class="text-muted text-sm mb-4 flex-1">{{ $promo->deskripsi }}</p>
                    <div class="pt-4 border-t border-gray-100 flex items-center text-xs text-gray-500 gap-2">
                        <i class="fas fa-calendar-alt text-primary"></i> 
                        Berlaku s/d {{ \Carbon\Carbon::parse($promo->tanggal_selesai)->translatedFormat('d M Y') }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Portfolio Section -->
<section class="py-16 bg-white">
    <div class="container">
        <h2 class="text-2xl font-bold mb-8 flex items-center gap-3 animate-on-scroll">
            <i class="fas fa-images text-primary"></i> Galeri Hasil Cetak & Jilid
        </h2>
        
        @if($portofolios->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($portofolios as $porto)
            <div class="group relative overflow-hidden rounded-xl shadow-sm border border-gray-100 animate-on-scroll cursor-pointer">
                <img src="{{ Storage::url($porto->gambar) }}" alt="{{ $porto->judul }}" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                    @if($porto->kategori)
                    <span class="badge bg-primary text-white self-start mb-2">{{ $porto->kategori }}</span>
                    @endif
                    <h3 class="text-white font-bold text-lg leading-tight mb-1 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">{{ $porto->judul }}</h3>
                    @if($porto->deskripsi)
                    <p class="text-gray-200 text-sm line-clamp-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300 delay-75">{{ $porto->deskripsi }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-300">
            <div class="text-4xl text-gray-300 mb-3"><i class="fas fa-camera"></i></div>
            <p class="text-muted">Galeri portofolio belum tersedia.</p>
        </div>
        @endif
    </div>
</section>
@endsection
