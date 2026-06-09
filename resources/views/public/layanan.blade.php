@extends('layouts.app')

@section('title', 'Layanan & Harga')

@section('content')
<section class="bg-primary-light py-12">
    <div class="container">
        <div class="text-center max-w-2xl mx-auto animate-on-scroll">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 text-primary-dark">Daftar Layanan & Harga</h1>
            <p class="text-muted">Temukan harga transparan untuk semua kebutuhan cetak dan fotokopi Anda.</p>
        </div>
    </div>
</section>

<section class="py-12">
    <div class="container">
        <!-- Filter & Search -->
        <div class="card mb-8 animate-on-scroll">
            <div class="card-body">
                <form action="{{ route('layanan') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="flex flex-wrap gap-2">
                            <a href="{{ route('layanan') }}" class="badge {{ !request('kategori') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} px-4 py-2 text-sm rounded-full">
                                Semua
                            </a>
                            @foreach($kategoris as $kat)
                            <a href="{{ route('layanan', ['kategori' => $kat->slug] + request()->except('kategori')) }}" class="badge {{ request('kategori') == $kat->slug ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }} px-4 py-2 text-sm rounded-full">
                                <i class="{{ $kat->icon }} mr-1"></i> {{ $kat->nama }}
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="w-full md:w-1/3">
                        <div class="search-box">
                            <input type="text" name="cari" class="form-control rounded-full" placeholder="Cari layanan..." value="{{ request('cari') }}">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Pricelist -->
        <div class="animate-on-scroll">
            @forelse($layanans as $kategoriId => $items)
                @php $kategori = $kategoris->firstWhere('id', $kategoriId); @endphp
                <div class="mb-10">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-3">
                        <span class="w-10 h-10 rounded bg-primary-light text-primary flex items-center justify-center">
                            <i class="{{ $kategori->icon ?? 'fas fa-file' }}"></i>
                        </span>
                        {{ $kategori->nama ?? 'Lainnya' }}
                    </h2>
                    
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Nama Layanan</th>
                                        <th class="hidden md:table-cell">Deskripsi</th>
                                        <th class="text-right">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $layanan)
                                    <tr>
                                        <td class="font-semibold">{{ $layanan->nama }}</td>
                                        <td class="hidden md:table-cell text-muted text-sm">{{ $layanan->deskripsi ?: '-' }}</td>
                                        <td class="text-right">
                                            <div class="font-bold text-primary whitespace-nowrap">
                                                Rp{{ number_format($layanan->harga, 0, ',', '.') }}
                                            </div>
                                            <div class="text-xs text-muted">/ {{ $layanan->satuan }}</div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <div class="text-6xl text-gray-300 mb-4"><i class="fas fa-search"></i></div>
                    <h3 class="text-xl font-bold mb-2">Layanan tidak ditemukan</h3>
                    <p class="text-muted">Coba ubah kata kunci pencarian atau filter kategori.</p>
                    <a href="{{ route('layanan') }}" class="btn btn-outline mt-4">Reset Pencarian</a>
                </div>
            @endforelse
        </div>
        
        <div class="mt-12 bg-accent-light rounded-xl p-8 text-center animate-on-scroll border border-accent/20">
            <h3 class="text-xl font-bold mb-2 text-accent-dark">Butuh Pesanan Partai Besar?</h3>
            <p class="text-gray-700 mb-4">Hubungi kami untuk mendapatkan harga negosiasi spesial untuk pesanan dalam jumlah besar.</p>
            @if($wa = \App\Models\Pengaturan::getValue('whatsapp'))
            <a href="https://wa.me/{{ $wa }}" target="_blank" class="btn btn-accent">
                <i class="fab fa-whatsapp"></i> Hubungi WhatsApp
            </a>
            @endif
        </div>
    </div>
</section>
@endsection
