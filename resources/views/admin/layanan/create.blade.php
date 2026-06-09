@extends('layouts.admin')

@section('title', 'Tambah Layanan Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.layanan.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="kategori_layanan_id" class="form-label">Kategori Layanan <span class="text-red-500">*</span></label>
                    <select name="kategori_layanan_id" id="kategori_layanan_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kategori_layanan_id') == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="nama" class="form-label">Nama Layanan <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label for="harga" class="form-label">Harga <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
                                Rp
                            </div>
                            <input type="number" name="harga" id="harga" class="form-control pl-10" value="{{ old('harga') }}" min="0" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="satuan" class="form-label">Satuan <span class="text-red-500">*</span></label>
                        <input type="text" name="satuan" id="satuan" class="form-control" value="{{ old('satuan', 'lembar') }}" required placeholder="Contoh: lembar, buku, rim">
                    </div>
                </div>

                <div class="form-group">
                    <label for="deskripsi" class="form-label">Deskripsi Tambahan</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="form-group flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1" class="w-4 h-4 text-primary" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label for="is_active" class="form-label mb-0 cursor-pointer text-gray-700">Layanan Aktif (Tampilkan di halaman publik)</label>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-6 text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Layanan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
