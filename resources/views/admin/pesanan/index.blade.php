@extends('layouts.admin')

@section('title', 'Kelola Pesanan')

@section('content')
<div class="card">
    <div class="card-header flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <form action="{{ route('admin.pesanan.index') }}" method="GET" class="flex flex-col md:flex-row gap-2 w-full md:w-auto flex-1">
            <select name="status" class="form-control w-full md:w-48" onchange="this.form.submit()">
                <option value="">Semua Status</option>
                <option value="antre" {{ request('status') == 'antre' ? 'selected' : '' }}>Antre</option>
                <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Sedang Diproses</option>
                <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="diambil" {{ request('status') == 'diambil' ? 'selected' : '' }}>Sudah Diambil</option>
            </select>
            <div class="search-box flex-1">
                <input type="text" name="cari" class="form-control" placeholder="Cari kode/nama/telepon..." value="{{ request('cari') }}">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
            @if(request('status') || request('cari'))
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline btn-sm">Reset</a>
            @endif
        </form>
        <a href="{{ route('admin.pesanan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Pesanan Baru
        </a>
    </div>

    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Kode Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Item Layanan</th>
                    <th class="text-right">Total Biaya</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pesanans as $pesanan)
                <tr>
                    <td>
                        <div class="font-bold text-primary font-mono">{{ $pesanan->kode_pesanan }}</div>
                        <div class="text-xs text-muted">{{ $pesanan->created_at->format('d/m/Y H:i') }}</div>
                    </td>
                    <td>
                        <div class="font-semibold">{{ $pesanan->nama_pelanggan }}</div>
                        <div class="text-xs text-muted"><i class="fab fa-whatsapp"></i> {{ $pesanan->no_telepon ?: '-' }}</div>
                    </td>
                    <td>
                        <div class="text-sm">
                            @foreach($pesanan->items->take(2) as $item)
                                <div>&bull; {{ $item->layanan->nama ?? 'Layanan Dihapus' }} ({{ $item->jumlah }})</div>
                            @endforeach
                            @if($pesanan->items->count() > 2)
                                <div class="text-xs text-muted italic">... +{{ $pesanan->items->count() - 2 }} item lainnya</div>
                            @endif
                        </div>
                    </td>
                    <td class="text-right font-bold">
                        Rp{{ number_format($pesanan->total_biaya, 0, ',', '.') }}
                    </td>
                    <td class="text-center">
                        <div class="dropdown inline-block relative">
                            <button type="button" class="badge badge-{{ $pesanan->status_color }} cursor-pointer hover:opacity-80" onclick="this.nextElementSibling.classList.toggle('hidden')">
                                {{ $pesanan->status_label }} <i class="fas fa-caret-down ml-1"></i>
                            </button>
                            <div class="hidden absolute right-0 mt-1 w-40 bg-white rounded-md shadow-lg border border-gray-100 z-10 text-left">
                                <form action="{{ route('admin.pesanan.status', $pesanan->id) }}" method="POST" class="py-1">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" name="status" value="antre" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $pesanan->status == 'antre' ? 'font-bold' : '' }}">Antre</button>
                                    <button type="submit" name="status" value="proses" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $pesanan->status == 'proses' ? 'font-bold' : '' }}">Sedang Diproses</button>
                                    <button type="submit" name="status" value="selesai" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $pesanan->status == 'selesai' ? 'font-bold' : '' }}">Selesai</button>
                                    <button type="submit" name="status" value="diambil" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ $pesanan->status == 'diambil' ? 'font-bold' : '' }}">Sudah Diambil</button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.pesanan.show', $pesanan->id) }}" class="btn btn-sm btn-info bg-blue-100 text-blue-700 hover:bg-blue-200" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.pesanan.edit', $pesanan->id) }}" class="btn btn-sm btn-outline" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.pesanan.destroy', $pesanan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan ini?');" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-8">
                        <div class="text-4xl text-gray-300 mb-3"><i class="fas fa-inbox"></i></div>
                        <p class="text-muted">Belum ada data pesanan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($pesanans->hasPages())
    <div class="card-footer">
        {{ $pesanans->links() }}
    </div>
    @endif
</div>
@endsection
