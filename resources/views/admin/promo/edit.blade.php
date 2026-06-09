@extends('layouts.admin')

@section('title', 'Edit Promo')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.promo.index') }}" class="btn btn-outline btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.promo.update', $promo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="judul" class="form-label">Judul Promo <span class="text-red-500">*</span></label>
                    <input type="text" name="judul" id="judul" class="form-control" value="{{ old('judul', $promo->judul) }}" required>
                </div>

                <div class="form-group">
                    <label for="deskripsi" class="form-label">Deskripsi Promo <span class="text-red-500">*</span></label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi', $promo->deskripsi) }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="form-group">
                        <label for="diskon_persen" class="form-label">Diskon (%)</label>
                        <div class="relative">
                            <input type="number" name="diskon_persen" id="diskon_persen" class="form-control" value="{{ old('diskon_persen', floatval($promo->diskon_persen)) }}" min="0" max="100" step="0.01">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none text-gray-500">%</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_mulai" class="form-label">Tanggal Mulai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" value="{{ old('tanggal_mulai', $promo->tanggal_mulai) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_selesai" class="form-label">Tanggal Selesai <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" value="{{ old('tanggal_selesai', $promo->tanggal_selesai) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="gambar" class="form-label">Banner Promo (Opsional)</label>
                    <input type="file" name="gambar" id="gambar" class="form-control" accept="image/jpeg,image/png,image/jpg" onchange="previewImage(this)">
                    <p class="text-xs text-muted mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                    
                    @if($promo->gambar)
                    <div class="mt-3">
                        <p class="text-sm font-semibold mb-1">Gambar saat ini:</p>
                        <img src="{{ Storage::url($promo->gambar) }}" alt="Current Promo" class="rounded shadow-sm max-w-full h-auto max-h-48 object-cover">
                    </div>
                    @endif
                    
                    <img id="img-preview" src="#" alt="New Preview" class="mt-3 rounded shadow-sm hidden max-w-full h-auto max-h-48 object-cover border-2 border-primary border-dashed">
                </div>

                <div class="form-group flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1" class="w-4 h-4 text-primary" {{ old('is_active', $promo->is_active) ? 'checked' : '' }}>
                    <label for="is_active" class="form-label mb-0 cursor-pointer text-gray-700">Promo Aktif (Tampilkan di halaman publik)</label>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-6 text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Perbarui Promo
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
