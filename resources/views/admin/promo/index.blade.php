@extends('layouts.admin')

@section('title', 'Kelola Promo')

@section('content')
<div class="card">
    <div class="card-header flex justify-between items-center">
        <h3 class="font-bold">Daftar Promo</h3>
        <a href="{{ route('admin.promo.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Promo
        </a>
    </div>

    <div class="table-responsive">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Judul Promo</th>
                    <th>Diskon</th>
                    <th>Periode</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($promos as $promo)
                <tr>
                    <td>
                        @if($promo->gambar)
                            <img src="{{ Storage::url($promo->gambar) }}" alt="Promo" class="w-16 h-12 object-cover rounded">
                        @else
                            <div class="w-16 h-12 bg-gray-200 rounded flex items-center justify-center text-gray-400">
                                <i class="fas fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="font-bold">{{ $promo->judul }}</div>
                        <div class="text-xs text-muted">{{ Str::limit($promo->deskripsi, 50) }}</div>
                    </td>
                    <td class="font-bold text-accent">
                        {{ $promo->diskon_persen ? floatval($promo->diskon_persen) . '%' : '-' }}
                    </td>
                    <td class="text-sm">
                        {{ \Carbon\Carbon::parse($promo->tanggal_mulai)->format('d/m/Y') }} - <br>
                        {{ \Carbon\Carbon::parse($promo->tanggal_selesai)->format('d/m/Y') }}
                    </td>
                    <td class="text-center">
                        @if($promo->is_active)
                            <span class="badge badge-success">Aktif</span>
                        @else
                            <span class="badge badge-danger">Nonaktif</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.promo.edit', $promo->id) }}" class="btn btn-sm btn-outline" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.promo.destroy', $promo->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus promo ini?');" class="inline-block">
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
                        <div class="text-4xl text-gray-300 mb-3"><i class="fas fa-tags"></i></div>
                        <p class="text-muted">Belum ada data promo.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($promos->hasPages())
    <div class="card-footer">
        {{ $promos->links() }}
    </div>
    @endif
</div>
@endsection
