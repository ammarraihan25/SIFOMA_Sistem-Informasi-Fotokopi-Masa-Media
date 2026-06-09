@extends('layouts.app')

@section('title', 'Kontak & Lokasi')

@section('content')
<section class="py-12 md:py-20 bg-main">
    <div class="container">
        <div class="text-center mb-12 animate-on-scroll">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Hubungi Kami</h1>
            <p class="text-muted max-w-2xl mx-auto">Punya pertanyaan atau ingin mengirim file pesanan? Jangan ragu untuk menghubungi kami melalui kontak di bawah ini atau kunjungi langsung toko kami.</p>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 flex flex-col gap-6">
                <!-- Info Box 1 -->
                <div class="card p-6 flex items-start gap-4 animate-on-scroll" style="animation-delay: 0.1s;">
                    <div class="w-12 h-12 bg-primary-light text-primary rounded-full flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Alamat Toko</h3>
                        <p class="text-muted text-sm">{{ $pengaturan['alamat'] ?? 'Alamat belum diatur' }}</p>
                    </div>
                </div>
                
                <!-- Info Box 2 -->
                <div class="card p-6 flex items-start gap-4 animate-on-scroll" style="animation-delay: 0.2s;">
                    <div class="w-12 h-12 bg-accent-light text-accent rounded-full flex items-center justify-center text-xl shrink-0">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">WhatsApp & Telepon</h3>
                        <p class="text-muted text-sm mb-2">{{ $pengaturan['telepon'] ?? '-' }}</p>
                        @if($wa = \App\Models\Pengaturan::getValue('whatsapp'))
                        <a href="https://wa.me/{{ $wa }}" target="_blank" class="text-accent font-bold text-sm hover:underline">Chat Sekarang &rarr;</a>
                        @endif
                    </div>
                </div>
                
                <!-- Info Box 3 -->
                <div class="card p-6 flex items-start gap-4 animate-on-scroll" style="animation-delay: 0.3s;">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg mb-1">Jam Operasional</h3>
                        <p class="font-semibold text-sm">{{ $pengaturan['jam_buka'] ?? '-' }}</p>
                        <p class="text-muted text-sm">{{ $pengaturan['jam_buka_detail'] ?? '' }}</p>
                    </div>
                </div>
            </div>
            
            <div class="lg:col-span-2 card p-2 overflow-hidden shadow-md animate-on-scroll" style="animation-delay: 0.4s; min-height: 400px;">
                @if($maps = \App\Models\Pengaturan::getValue('google_maps_embed'))
                    <iframe src="{{ $maps }}" width="100%" height="100%" style="border:0; min-height: 400px; border-radius: 0.5rem;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                @else
                    <div class="w-full h-full min-h-[400px] bg-gray-100 flex flex-col items-center justify-center text-gray-400 rounded-lg">
                        <i class="fas fa-map-marked-alt text-5xl mb-4"></i>
                        <p>Peta lokasi belum diatur</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
