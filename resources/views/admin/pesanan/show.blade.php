@extends('layouts.admin')

@section('title', 'Detail Pesanan')

@section('content')
<div class="flex justify-between items-center mb-6">
    <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline btn-sm">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    
    <div class="flex gap-2">
        <a href="{{ route('admin.pesanan.edit', $pesanan->id) }}" class="btn btn-primary btn-sm">
            <i class="fas fa-edit"></i> Edit Pesanan
        </a>
        <button type="button" onclick="window.print()" class="btn btn-accent btn-sm">
            <i class="fas fa-print"></i> Cetak Nota
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6" id="print-area">
    <div class="lg:col-span-1">
        <div class="card mb-6">
            <div class="card-header bg-gray-50 flex justify-between items-center">
                <h3 class="font-bold">Info Pelanggan</h3>
                <span class="badge badge-{{ $pesanan->status_color }}">{{ $pesanan->status_label }}</span>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <p class="text-sm text-muted mb-1">Nama</p>
                    <p class="font-bold text-lg">{{ $pesanan->nama_pelanggan }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-sm text-muted mb-1">WhatsApp / Telepon</p>
                    <p class="font-semibold flex items-center gap-2">
                        <i class="fab fa-whatsapp text-green-500"></i> 
                        {{ $pesanan->no_telepon ?: '-' }}
                        @if($pesanan->no_telepon)
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $pesanan->no_telepon)) }}" target="_blank" class="text-xs text-primary hover:underline ml-2">Chat</a>
                        @endif
                    </p>
                </div>
                <div class="mb-4">
                    <p class="text-sm text-muted mb-1">Catatan</p>
                    <p class="bg-yellow-50 p-3 rounded border border-yellow-100 text-sm italic">{{ $pesanan->catatan ?: 'Tidak ada catatan.' }}</p>
                </div>
                <div>
                    <p class="text-sm text-muted mb-1">Waktu Pemesanan</p>
                    <p class="font-mono text-sm">{{ $pesanan->created_at->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
        </div>

        <!-- Quick Status Update -->
        <div class="card no-print">
            <div class="card-header">
                <h3 class="font-bold">Ubah Status Cepat</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pesanan.status', $pesanan->id) }}" method="POST" class="flex flex-col gap-2">
                    @csrf
                    @method('PATCH')
                    
                    <button type="submit" name="status" value="antre" class="btn w-full justify-start {{ $pesanan->status == 'antre' ? 'btn-warning' : 'bg-gray-100 text-gray-600 hover:bg-yellow-50' }}">
                        <i class="fas {{ $pesanan->status == 'antre' ? 'fa-check-circle' : 'fa-circle text-gray-300' }} w-5"></i> Antre
                    </button>
                    
                    <button type="submit" name="status" value="proses" class="btn w-full justify-start {{ $pesanan->status == 'proses' ? 'btn-info' : 'bg-gray-100 text-gray-600 hover:bg-blue-50' }}">
                        <i class="fas {{ $pesanan->status == 'proses' ? 'fa-check-circle' : 'fa-circle text-gray-300' }} w-5"></i> Sedang Diproses
                    </button>
                    
                    <button type="submit" name="status" value="selesai" class="btn w-full justify-start {{ $pesanan->status == 'selesai' ? 'btn-success' : 'bg-gray-100 text-gray-600 hover:bg-green-50' }}">
                        <i class="fas {{ $pesanan->status == 'selesai' ? 'fa-check-circle' : 'fa-circle text-gray-300' }} w-5"></i> Selesai (Siap Diambil)
                    </button>
                    
                    <button type="submit" name="status" value="diambil" class="btn w-full justify-start {{ $pesanan->status == 'diambil' ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                        <i class="fas {{ $pesanan->status == 'diambil' ? 'fa-check-circle' : 'fa-circle text-gray-300' }} w-5"></i> Sudah Diambil
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="lg:col-span-2">
        <div class="card h-full">
            <div class="card-header bg-gray-50 flex justify-between items-center border-b-2 border-primary">
                <div>
                    <h2 class="font-black text-2xl font-mono text-primary">{{ $pesanan->kode_pesanan }}</h2>
                    <p class="text-xs text-muted">INVOICE / NOTA PESANAN</p>
                </div>
                <div class="text-right">
                    <h3 class="font-bold text-lg">{{ \App\Models\Pengaturan::getValue('nama_toko', 'SIFOMA') }}</h3>
                </div>
            </div>
            
            <div class="p-6">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr class="bg-gray-100">
                                <th>Deskripsi Layanan</th>
                                <th class="text-right">Harga (@)</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pesanan->items as $item)
                            <tr class="border-b border-dashed border-gray-200">
                                <td>
                                    <div class="font-bold text-gray-800">{{ $item->layanan->nama ?? 'Layanan Dihapus' }}</div>
                                    @if($item->keterangan)
                                        <div class="text-sm text-muted mt-1 italic">{{ $item->keterangan }}</div>
                                    @endif
                                </td>
                                <td class="text-right">
                                    Rp{{ number_format($item->harga_satuan, 0, ',', '.') }}<br>
                                    <span class="text-xs text-muted">/ {{ $item->layanan->satuan ?? '-' }}</span>
                                </td>
                                <td class="text-center font-bold">{{ $item->jumlah }}</td>
                                <td class="text-right font-bold text-gray-800">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right font-bold py-4 text-lg">TOTAL BIAYA</td>
                                <td class="text-right font-black text-primary text-xl py-4 bg-primary-light rounded-r">
                                    Rp{{ number_format($pesanan->total_biaya, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="mt-12 pt-6 border-t text-center text-sm text-muted">
                    <p>Terima kasih telah menggunakan layanan {{ \App\Models\Pengaturan::getValue('nama_toko', 'SIFOMA') }}.</p>
                    <p>Cek status pengerjaan pesanan Anda secara online di: <br><strong class="text-primary">{{ route('pesanan.cek') }}</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body * { visibility: hidden; }
        #print-area, #print-area * { visibility: visible; }
        #print-area { position: absolute; left: 0; top: 0; width: 100%; }
        .no-print { display: none !important; }
        .card { box-shadow: none !important; border: 1px solid #ddd !important; }
        .admin-sidebar, .admin-header { display: none !important; }
        .admin-main { margin-left: 0 !important; }
    }
</style>
@endsection
