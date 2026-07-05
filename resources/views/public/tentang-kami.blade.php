@extends('layouts.app')

@section('title', 'Tentang Kami')

@section('content')
<section class="hero text-center" style="padding: 4rem 0;">
    <div class="container animate-on-scroll">
        <h1 class="text-3xl md:text-5xl font-bold mb-4 text-bg-dark">Tentang <span class="text-primary">{{ $pengaturan['nama_toko'] ?? 'SIFOMA' }}</span></h1>
        <p class="text-lg text-muted max-w-2xl mx-auto">{{ $pengaturan['deskripsi_singkat'] ?? '' }}</p>
    </div>
</section>

<section class="py-16 bg-white">
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll flex justify-center w-full">
                <div class="rounded-2xl overflow-hidden shadow-xl border-4 border-white transform rotate-2 max-w-sm md:max-w-md mx-auto">
                    <img src="{{ asset('toko.png') }}" alt="SIFOMA Store" class="w-full h-auto object-cover">
                </div>
            </div>
            
            <div class="animate-on-scroll" style="animation-delay: 0.2s;">
                <h2 class="text-3xl font-bold mb-6 flex items-center gap-3">
                    <i class="fas fa-history text-accent"></i> Sejarah Kami
                </h2>
                <div class="prose prose-lg text-gray-600">
                    <p class="leading-relaxed mb-4">
                        {{ $pengaturan['sejarah'] ?? 'Informasi sejarah belum tersedia.' }}
                    </p>
                    <p class="leading-relaxed">
                        Kami terus berinovasi dan memperbarui peralatan kami untuk memastikan bahwa setiap dokumen yang Anda percayakan kepada kami dicetak dengan kualitas terbaik.
                    </p>
                </div>
                
                <div class="grid grid-cols-2 gap-6 mt-8 border-t pt-8 border-gray-100">
                    <div>
                        <div class="text-4xl font-black text-primary mb-2">10+</div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wide">Tahun Pengalaman</div>
                    </div>
                    <div>
                        <div class="text-4xl font-black text-accent mb-2">10K+</div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-wide">Pelanggan Puas</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
