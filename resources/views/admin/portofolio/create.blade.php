@extends('layouts.admin')

@section('title', 'Tambah Portofolio')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.portofolio.index') }}" class="btn btn-outline btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.portofolio.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="gambar" class="form-label">Foto Hasil Cetak/Jilid <span class="text-red-500">*</span></label>
                    <input type="file" name="gambar" id="gambar" class="form-control" accept="image/jpeg,image/png,image/jpg" required onchange="previewImage(this)">
                    <p class="text-xs text-muted mt-1">Format: JPG/PNG, Maksimal: 2MB.</p>
                    <img id="img-preview" src="#" alt="Preview" class="mt-3 rounded shadow-sm hidden max-w-full h-auto max-h-64 object-cover">
                </div>

                <div class="form-group">
                    <label for="judul" class="form-label">Judul Portofolio <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul') }}" required placeholder="Contoh: Cetak Buku Tahunan SMA N 1">
                </div>

                <div class="form-group">
                    <label for="kategori" class="form-label">Kategori (Opsional)</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="{{ old('kategori') }}" placeholder="Contoh: Jilid Hardcover, Cetak Undangan">
                </div>

                <div class="form-group">
                    <label for="deskripsi" class="form-label">Deskripsi Tambahan</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="form-group mt-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" id="is_active" class="form-checkbox text-primary rounded focus:ring-primary h-5 w-5" checked>
                        <span class="font-medium">Tampilkan di Web</span>
                    </label>
                    <p class="text-xs text-muted ml-7 mt-1">Jika dicentang, portofolio ini akan muncul di halaman depan.</p>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-6 text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Portofolio
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function previewImage(input) {
        const preview = document.getElementById('img-preview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.classList.add('hidden');
        }
    }
</script>
@endpush
@endsection
