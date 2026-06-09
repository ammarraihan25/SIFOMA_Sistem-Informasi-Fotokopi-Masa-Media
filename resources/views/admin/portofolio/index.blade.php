@extends('layouts.admin')

@section('title', 'Galeri Portofolio')

@section('content')
<div class="card">
    <div class="card-header flex justify-between items-center">
        <h3 class="font-bold">Daftar Portofolio Hasil Cetak</h3>
        <a href="{{ route('admin.portofolio.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Portofolio
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 p-6">
        @forelse($portofolios as $porto)
        <div class="card overflow-hidden h-full flex flex-col group relative">
            <div class="h-48 overflow-hidden bg-gray-100 relative">
                <img src="{{ Storage::url($porto->gambar) }}" alt="{{ $porto->judul }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                    <a href="{{ route('admin.portofolio.edit', $porto->id) }}" class="btn btn-sm btn-info text-white">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.portofolio.destroy', $porto->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus portofolio ini?');" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body flex-1 p-4">
                @if($porto->kategori)
                    <span class="badge bg-gray-100 text-gray-600 mb-2">{{ $porto->kategori }}</span>
                @endif
                <h4 class="font-bold text-gray-800 leading-tight mb-2">{{ $porto->judul }}</h4>
                <p class="text-xs text-muted line-clamp-2">{{ $porto->deskripsi }}</p>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12">
            <div class="text-4xl text-gray-300 mb-3"><i class="fas fa-images"></i></div>
            <p class="text-muted">Belum ada data portofolio. Silakan tambahkan karya hasil cetak Anda.</p>
        </div>
        @endforelse
    </div>
    
    @if($portofolios->hasPages())
    <div class="card-footer border-t border-gray-100 p-6">
        {{ $portofolios->links() }}
    </div>
    @endif
</div>
@endsection
