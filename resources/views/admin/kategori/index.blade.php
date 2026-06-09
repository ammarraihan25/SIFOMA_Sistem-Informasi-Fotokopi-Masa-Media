@extends('layouts.admin')

@section('title', 'Kategori Layanan')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="card">
        <div class="card-header flex justify-between items-center">
            <h3 class="font-bold">Daftar Kategori</h3>
            <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>

        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th width="10%" class="text-center">Urutan</th>
                        <th>Nama Kategori</th>
                        <th class="text-center">Icon</th>
                        <th class="text-center">Total Layanan</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $kategori)
                    <tr>
                        <td class="text-center font-bold text-gray-400">{{ $kategori->urutan }}</td>
                        <td class="font-bold">{{ $kategori->nama }}</td>
                        <td class="text-center">
                            <div class="w-10 h-10 mx-auto rounded bg-primary-light text-primary flex items-center justify-center">
                                <i class="{{ $kategori->icon ?? 'fas fa-folder' }}"></i>
                            </div>
                        </td>
                        <td class="text-center font-semibold">
                            {{ $kategori->layanans_count }} item
                        </td>
                        <td class="text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-sm btn-outline" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini? Pastikan tidak ada layanan yang terhubung.');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger {{ $kategori->layanans_count > 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $kategori->layanans_count > 0 ? 'disabled' : '' }} title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-8 text-muted">Belum ada data kategori.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
