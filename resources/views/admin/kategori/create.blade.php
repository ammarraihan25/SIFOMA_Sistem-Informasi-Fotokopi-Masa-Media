@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.kategori.index') }}" class="btn btn-outline btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="nama" class="form-label">Nama Kategori <span class="text-red-500">*</span></label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama') }}" required>
                </div>

                <div class="form-group">
                    <label for="icon" class="form-label">Class Icon (FontAwesome)</label>
                    <div class="flex gap-2">
                        <input type="text" name="icon" id="icon" class="form-control" value="{{ old('icon', 'fas fa-file') }}" placeholder="Contoh: fas fa-print">
                        <div class="w-12 h-12 shrink-0 bg-gray-100 rounded flex items-center justify-center text-xl text-gray-600" id="icon-preview">
                            <i class="{{ old('icon', 'fas fa-file') }}"></i>
                        </div>
                    </div>
                    <p class="text-xs text-muted mt-1">Referensi icon: <a href="https://fontawesome.com/v6/search?m=free" target="_blank" class="text-primary hover:underline">FontAwesome Free</a></p>
                </div>

                <div class="form-group">
                    <label for="urutan" class="form-label">Urutan Tampil (Angka)</label>
                    <input type="number" name="urutan" id="urutan" class="form-control" value="{{ old('urutan', 0) }}" min="0">
                </div>

                <div class="mt-8 border-t border-gray-100 pt-6 text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('icon').addEventListener('input', function(e) {
        document.getElementById('icon-preview').innerHTML = '<i class="' + (e.target.value || 'fas fa-file') + '"></i>';
    });
</script>
@endpush
@endsection
