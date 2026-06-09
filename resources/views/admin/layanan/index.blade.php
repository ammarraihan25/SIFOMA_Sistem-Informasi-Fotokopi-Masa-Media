@extends('layouts.admin')

@section('title', 'Layanan & Harga')

@section('content')
<div class="card">
    <div class="card-header flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <form action="{{ route('admin.layanan.index') }}" method="GET" class="flex flex-col md:flex-row gap-2 w-full md:w-auto flex-1">
            <select name="kategori" class="form-control w-full md:w-48" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                @endforeach
            </select>
            <div class="search-box flex-1">
                <input type="text" name="cari" class="form-control" placeholder="Cari nama layanan..." value="{{ request('cari') }}">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
            @if(request('kategori') || request('cari'))
                <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline btn-sm">Reset</a>
            @endif
        </form>
        <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Layanan
        </a>
    </div>

    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Layanan & Kategori</th>
                    <th>Deskripsi</th>
                    <th class="text-right">Harga</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanans as $layanan)
                <tr>
                    <td>
                        <div class="font-bold">{{ $layanan->nama }}</div>
                        <div class="text-xs text-muted flex items-center gap-1">
                            <i class="{{ $layanan->kategori->icon ?? 'fas fa-tag' }}"></i> {{ $layanan->kategori->nama ?? '-' }}
                        </div>
                    </td>
                    <td class="text-sm text-muted">{{ Str::limit($layanan->deskripsi, 50) ?: '-' }}</td>
                    <td class="text-right">
                        <div class="font-bold text-primary">Rp{{ number_format($layanan->harga, 0, ',', '.') }}</div>
                        <div class="text-xs text-muted">/ {{ $layanan->satuan }}</div>
                    </td>
                    <td class="text-center">
                        @if($layanan->is_active)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Nonaktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="btn btn-sm btn-outline" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?');" class="inline-block">
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
                    <td colspan="5" class="text-center py-8">
                        <div class="text-4xl text-gray-300 mb-3"><i class="fas fa-box-open"></i></div>
                        <p class="text-muted">Data layanan tidak ditemukan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($layanans->hasPages())
    <div class="card-footer">
        {{ $layanans->links() }}
    </div>
    @endif
</div>
@endsection
