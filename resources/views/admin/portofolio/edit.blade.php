@extends('layouts.admin')

@section('title', 'Edit Portofolio')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.portofolio.index') }}" class="btn btn-outline btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.portofolio.update', $portofolio->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="gambar" class="form-label">Foto Hasil Cetak/Jilid</label>
                    <input type="file" name="gambar" id="gambar" class="form-control" accept="image/jpeg,image/png,image/jpg" onchange="previewImage(this)">
                    <p class="text-xs text-muted mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    
                    <div class="mt-3 flex gap-4">
                        @if($portofolio->gambar)
                        <div>
                            <p class="text-sm font-semibold mb-1 text-gray-500">Gambar Saat Ini:</p>
                            <img src="{{ Storage::url($portofolio->gambar) }}" alt="Current" class="rounded shadow-sm max-w-full h-auto max-h-48 object-cover">
                        </div>
                        @endif
                        
                        <div>
                            <p id="new-preview-label" class="text-sm font-semibold mb-1 text-primary hidden">Gambar Baru:</p>
                            <img id="img-preview" src="#" alt="New Preview" class="rounded shadow-sm hidden max-w-full h-auto max-h-48 object-cover border-2 border-primary border-dashed">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="judul" class="form-label">Judul Portofolio <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $portofolio->judul) }}" required>
                </div>

                <div class="form-group">
                    <label for="kategori" class="form-label">Kategori (Opsional)</label>
                    <input type="text" name="kategori" id="kategori" class="form-control" value="{{ old('kategori', $portofolio->kategori) }}">
                </div>

                <div class="form-group">
                    <label for="deskripsi" class="form-label">Deskripsi Tambahan</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3">{{ old('deskripsi', $portofolio->deskripsi) }}</textarea>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-6 text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Perbarui Portofolio
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
        const label = document.getElementById('new-preview-label');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                label.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.src = '#';
            preview.classList.add('hidden');
            label.classList.add('hidden');
        }
    }
</script>
@endpush
@endsection
