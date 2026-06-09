@extends('layouts.app')

@section('title', 'Status Pesanan ' . $pesanan->kode_pesanan)

@section('content')
<section class="py-12 bg-main min-h-[70vh]">
    <div class="container">
        <div class="max-w-3xl mx-auto animate-on-scroll">
            
            <a href="{{ route('pesanan.cek') }}" class="btn btn-outline btn-sm mb-6 bg-white">
                <i class="fas fa-arrow-left"></i> Cek Pesanan Lain
            </a>
            
            <div class="card mb-8 shadow-lg overflow-hidden border-t-4 border-t-{{ $pesanan->status_color }}">
                <div class="bg-gray-50 p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <p class="text-sm text-muted mb-1">Kode Pesanan</p>
                        <h2 class="text-2xl font-black font-mono tracking-wider">{{ $pesanan->kode_pesanan }}</h2>
                    </div>
                    <div class="text-left md:text-right">
                        <p class="text-sm text-muted mb-1">Status Saat Ini</p>
                        <span class="badge badge-{{ $pesanan->status_color }} text-sm px-4 py-2 text-lg">
                            {{ $pesanan->status_label }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <p class="text-sm text-muted mb-1">Nama Pelanggan</p>
                            <p class="font-semibold">{{ $pesanan->nama_pelanggan }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-muted mb-1">Tanggal Pesanan</p>
                            <p class="font-semibold">{{ $pesanan->created_at->translatedFormat('d F Y, H:i') }} WIB</p>
                        </div>
                    </div>

                    <!-- Visual Timeline -->
                    <h3 class="font-bold text-lg mb-4">Progres Pengerjaan</h3>
                    <div class="flex flex-col md:flex-row justify-between items-center mb-8 relative">
                        <!-- Connecting Line (Background) -->
                        <div class="hidden md:block absolute top-1/2 left-0 right-0 h-1 bg-gray-200 -z-10 -translate-y-1/2"></div>
                        
                        <!-- Connecting Line (Active) -->
                        @php
                            $progress = 0;
                            if($pesanan->status == 'proses') $progress = 33;
                            if($pesanan->status == 'selesai') $progress = 66;
                            if($pesanan->status == 'diambil') $progress = 100;
                        @endphp
                        <div class="hidden md:block absolute top-1/2 left-0 h-1 bg-primary -z-10 -translate-y-1/2 transition-all duration-1000" style="width: {{ $progress }}%"></div>

                        <!-- Step 1: Antre -->
                        <div class="flex flex-row md:flex-col items-center gap-4 md:gap-2 mb-4 md:mb-0 w-full md:w-auto bg-white p-2 z-10">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ in_array($pesanan->status, ['antre', 'proses', 'selesai', 'diambil']) ? 'bg-primary text-white shadow-glow' : 'bg-gray-200 text-gray-400' }}">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <span class="font-semibold text-sm {{ in_array($pesanan->status, ['antre', 'proses', 'selesai', 'diambil']) ? 'text-primary' : 'text-gray-400' }}">Antre</span>
                        </div>
                        
                        <!-- Step 2: Proses -->
                        <div class="flex flex-row md:flex-col items-center gap-4 md:gap-2 mb-4 md:mb-0 w-full md:w-auto bg-white p-2 z-10">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ in_array($pesanan->status, ['proses', 'selesai', 'diambil']) ? 'bg-info text-white shadow-glow' : 'bg-gray-200 text-gray-400' }}">
                                <i class="fas fa-cog {{ $pesanan->status == 'proses' ? 'fa-spin' : '' }}"></i>
                            </div>
                            <span class="font-semibold text-sm {{ in_array($pesanan->status, ['proses', 'selesai', 'diambil']) ? 'text-info' : 'text-gray-400' }}">Diproses</span>
                        </div>

                        <!-- Step 3: Selesai -->
                        <div class="flex flex-row md:flex-col items-center gap-4 md:gap-2 mb-4 md:mb-0 w-full md:w-auto bg-white p-2 z-10">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ in_array($pesanan->status, ['selesai', 'diambil']) ? 'bg-success text-white shadow-glow' : 'bg-gray-200 text-gray-400' }}">
                                <i class="fas fa-check"></i>
                            </div>
                            <span class="font-semibold text-sm {{ in_array($pesanan->status, ['selesai', 'diambil']) ? 'text-success' : 'text-gray-400' }}">Selesai</span>
                        </div>

                        <!-- Step 4: Diambil -->
                        <div class="flex flex-row md:flex-col items-center gap-4 md:gap-2 w-full md:w-auto bg-white p-2 z-10">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $pesanan->status == 'diambil' ? 'bg-gray-800 text-white shadow-glow' : 'bg-gray-200 text-gray-400' }}">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <span class="font-semibold text-sm {{ $pesanan->status == 'diambil' ? 'text-gray-800' : 'text-gray-400' }}">Sudah Diambil</span>
                        </div>
                    </div>
                    
                    @if($pesanan->status == 'selesai')
                        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-lg flex items-start gap-3 mb-8">
                            <i class="fas fa-info-circle mt-1"></i>
                            <div>
                                <p class="font-bold">Pesanan Siap Diambil!</p>
                                <p class="text-sm">Silakan datang ke toko untuk mengambil pesanan Anda dengan menunjukkan nota fisik atau halaman ini.</p>
                            </div>
                        </div>
                    @endif

                    <h3 class="font-bold text-lg mb-4 border-b pb-2">Rincian Pesanan</h3>
                    <div class="table-responsive">
                        <table class="table mb-0 text-sm">
                            <thead>
                                <tr>
                                    <th>Layanan</th>
                                    <th>Keterangan</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-right">Harga</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesanan->items as $item)
                                <tr>
                                    <td class="font-medium">{{ $item->layanan->nama ?? 'Layanan Dihapus' }}</td>
                                    <td class="text-muted">{{ $item->keterangan ?: '-' }}</td>
                                    <td class="text-center">{{ $item->jumlah }} {{ $item->layanan->satuan ?? '' }}</td>
                                    <td class="text-right">Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                                    <td class="text-right font-semibold">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4" class="text-right font-bold py-4">TOTAL BIAYA:</td>
                                    <td class="text-right font-black text-primary text-lg py-4">Rp{{ number_format($pesanan->total_biaya, 0, ',', '.') }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="text-center text-sm text-muted">
                Jika ada kendala, hubungi kami via 
                @if($wa = \App\Models\Pengaturan::getValue('whatsapp'))
                <a href="https://wa.me/{{ $wa }}" class="text-green-600 font-bold hover:underline"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                @else
                Admin toko
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
