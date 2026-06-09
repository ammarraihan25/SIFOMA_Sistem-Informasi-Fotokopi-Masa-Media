@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<!-- Stats Row -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat 1 -->
    <div class="card p-6 border-l-4 border-l-primary flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-muted uppercase tracking-wider mb-1">Pesanan Hari Ini</p>
            <h3 class="text-3xl font-black text-gray-800">{{ $totalPesananHariIni }}</h3>
        </div>
        <div class="w-12 h-12 rounded-full bg-primary-light text-primary flex items-center justify-center text-xl">
            <i class="fas fa-shopping-bag"></i>
        </div>
    </div>
    
    <!-- Stat 2 -->
    <div class="card p-6 border-l-4 border-l-info flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-muted uppercase tracking-wider mb-1">Sedang Diproses</p>
            <h3 class="text-3xl font-black text-gray-800">{{ $pesananProses }}</h3>
        </div>
        <div class="w-12 h-12 rounded-full bg-blue-100 text-info flex items-center justify-center text-xl">
            <i class="fas fa-cog fa-spin"></i>
        </div>
    </div>

    <!-- Stat 3 -->
    <div class="card p-6 border-l-4 border-l-warning flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-muted uppercase tracking-wider mb-1">Antrean Baru</p>
            <h3 class="text-3xl font-black text-gray-800">{{ $pesananAntre }}</h3>
        </div>
        <div class="w-12 h-12 rounded-full bg-yellow-100 text-warning flex items-center justify-center text-xl">
            <i class="fas fa-clipboard-list"></i>
        </div>
    </div>

    <!-- Stat 4 -->
    <div class="card p-6 border-l-4 border-l-success flex items-center justify-between">
        <div>
            <p class="text-sm font-bold text-muted uppercase tracking-wider mb-1">Pendapatan Hari Ini</p>
            <h3 class="text-2xl font-black text-gray-800">Rp{{ number_format($pendapatanHariIni, 0, ',', '.') }}</h3>
            <p class="text-xs text-muted mt-1">Dari pesanan selesai/diambil</p>
        </div>
        <div class="w-12 h-12 rounded-full bg-green-100 text-success flex items-center justify-center text-xl">
            <i class="fas fa-wallet"></i>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Recent Orders -->
    <div class="lg:col-span-2">
        <div class="card h-full">
            <div class="card-header flex justify-between items-center">
                <h3 class="text-lg font-bold">10 Pesanan Terbaru</h3>
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline btn-sm">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table text-sm mb-0">
                    <thead>
                        <tr>
                            <th>Kode & Pelanggan</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th class="text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesananTerbaru as $pesanan)
                        <tr>
                            <td>
                                <div class="font-bold text-primary font-mono">{{ $pesanan->kode_pesanan }}</div>
                                <div class="text-muted">{{ $pesanan->nama_pelanggan }}</div>
                            </td>
                            <td>{{ $pesanan->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge badge-{{ $pesanan->status_color }}">{{ $pesanan->status_label }}</span>
                            </td>
                            <td class="text-right font-semibold">Rp{{ number_format($pesanan->total_biaya, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-muted">Belum ada pesanan masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Chart / Info Widget -->
    <div>
        <div class="card mb-6">
            <div class="card-header">
                <h3 class="text-lg font-bold">Pesanan 7 Hari Terakhir</h3>
            </div>
            <div class="card-body">
                <div class="flex flex-col gap-3">
                    @foreach($pesananPerHari as $data)
                    <div class="flex items-center gap-3">
                        <div class="w-12 text-sm font-semibold text-gray-600">{{ $data['tanggal'] }}</div>
                        <div class="flex-1 bg-gray-100 rounded-full h-4 overflow-hidden relative">
                            @php 
                                $max = collect($pesananPerHari)->max('jumlah') ?: 1;
                                $width = ($data['jumlah'] / $max) * 100;
                            @endphp
                            <div class="bg-primary h-full rounded-full transition-all duration-1000" style="width: {{ $width }}%"></div>
                        </div>
                        <div class="w-8 text-right font-bold text-primary">{{ $data['jumlah'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="card bg-gradient-to-br from-primary to-primary-dark text-white">
            <div class="card-body">
                <h3 class="text-lg font-bold mb-4 flex items-center gap-2"><i class="fas fa-info-circle"></i> Ringkasan Sistem</h3>
                <ul class="flex flex-col gap-3">
                    <li class="flex justify-between border-b border-white/20 pb-2">
                        <span>Total Layanan Aktif:</span>
                        <span class="font-bold">{{ $totalLayanan }}</span>
                    </li>
                    <li class="flex justify-between border-b border-white/20 pb-2">
                        <span>Promo Berjalan:</span>
                        <span class="font-bold">{{ $promoAktif }}</span>
                    </li>
                    <li class="flex justify-between pb-1">
                        <span>Item Portofolio:</span>
                        <span class="font-bold">{{ $totalPortofolio }}</span>
                    </li>
                </ul>
                <a href="{{ route('admin.pesanan.create') }}" class="btn bg-white text-primary btn-block mt-6 shadow-lg hover:bg-gray-100">
                    <i class="fas fa-plus"></i> Buat Pesanan Baru
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
