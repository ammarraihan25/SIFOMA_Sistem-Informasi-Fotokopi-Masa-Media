@extends('layouts.admin')

@section('title', 'Pengaturan Toko')

@section('content')
<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.pengaturan.update') }}" method="POST">
        @csrf
        @method('PUT')
        
        <!-- Informasi Umum -->
        <div class="card mb-6">
            <div class="card-header">
                <h3 class="font-bold"><i class="fas fa-store text-primary"></i> Informasi Umum</h3>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label for="nama_toko" class="form-label">Nama Toko</label>
                        <input type="text" name="pengaturan[nama_toko]" id="nama_toko" class="form-control" value="{{ $pengaturan['nama_toko'] ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="tagline" class="form-label">Tagline (Slogan)</label>
                        <input type="text" name="pengaturan[tagline]" id="tagline" class="form-control" value="{{ $pengaturan['tagline'] ?? '' }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="deskripsi_singkat" class="form-label">Deskripsi Singkat (Beranda & Footer)</label>
                    <textarea name="pengaturan[deskripsi_singkat]" id="deskripsi_singkat" class="form-control" rows="2">{{ $pengaturan['deskripsi_singkat'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="sejarah" class="form-label">Sejarah / Tentang Toko (Halaman Tentang Kami)</label>
                    <textarea name="pengaturan[sejarah]" id="sejarah" class="form-control" rows="4">{{ $pengaturan['sejarah'] ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Kontak & Lokasi -->
        <div class="card mb-6">
            <div class="card-header">
                <h3 class="font-bold"><i class="fas fa-map-marker-alt text-primary"></i> Kontak & Lokasi</h3>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label for="telepon" class="form-label">Telepon (Teks)</label>
                        <input type="text" name="pengaturan[telepon]" id="telepon" class="form-control" value="{{ $pengaturan['telepon'] ?? '' }}" placeholder="Contoh: 0812-3456-7890">
                    </div>
                    <div class="form-group">
                        <label for="whatsapp" class="form-label">Nomor WhatsApp (Angka untuk Link)</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-500">
                                wa.me/
                            </div>
                            <input type="text" name="pengaturan[whatsapp]" id="whatsapp" class="form-control pl-16" value="{{ $pengaturan['whatsapp'] ?? '' }}" placeholder="6281234567890">
                        </div>
                        <p class="text-xs text-muted mt-1">Gunakan format 62xxx tanpa spasi atau +</p>
                    </div>
                    <div class="form-group">
                        <label for="facebook" class="form-label">Link Facebook</label>
                        <input type="url" name="pengaturan[facebook]" id="facebook" class="form-control" value="{{ $pengaturan['facebook'] ?? '' }}">
                    </div>
                    <div class="form-group">
                        <label for="instagram" class="form-label">Link Instagram</label>
                        <input type="url" name="pengaturan[instagram]" id="instagram" class="form-control" value="{{ $pengaturan['instagram'] ?? '' }}">
                    </div>
                </div>
                
                <div class="form-group mt-6">
                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                    <textarea name="pengaturan[alamat]" id="alamat" class="form-control" rows="2">{{ $pengaturan['alamat'] ?? '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="google_maps_embed" class="form-label">Link Embed Google Maps (Src dari iframe)</label>
                    <input type="url" name="pengaturan[google_maps_embed]" id="google_maps_embed" class="form-control" value="{{ $pengaturan['google_maps_embed'] ?? '' }}" placeholder="https://www.google.com/maps/embed?pb=...">
                </div>
            </div>
        </div>

        <!-- Jam Operasional -->
        <div class="card mb-6">
            <div class="card-header">
                <h3 class="font-bold"><i class="fas fa-clock text-primary"></i> Jam Operasional</h3>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label for="jam_buka" class="form-label">Ringkasan Jam Buka</label>
                        <input type="text" name="pengaturan[jam_buka]" id="jam_buka" class="form-control" value="{{ $pengaturan['jam_buka'] ?? '' }}" placeholder="Contoh: Buka Setiap Hari (24 Jam)">
                    </div>
                    <div class="form-group">
                        <label for="jam_buka_detail" class="form-label">Detail Jam Buka</label>
                        <input type="text" name="pengaturan[jam_buka_detail]" id="jam_buka_detail" class="form-control" value="{{ $pengaturan['jam_buka_detail'] ?? '' }}" placeholder="Contoh: Senin - Minggu: 08.00 - 22.00 WIB">
                    </div>
                </div>
            </div>
        </div>

        <!-- Keunggulan (Beranda) -->
        <div class="card mb-6">
            <div class="card-header flex justify-between items-center">
                <h3 class="font-bold"><i class="fas fa-star text-primary"></i> Keunggulan (Ditampilkan di Beranda)</h3>
            </div>
            <div class="card-body">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Keunggulan 1 -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <h4 class="font-bold text-center mb-3">Kolom 1</h4>
                        <div class="form-group">
                            <label class="form-label text-sm">Judul</label>
                            <input type="text" name="pengaturan[keunggulan_1]" class="form-control text-sm" value="{{ $pengaturan['keunggulan_1'] ?? '' }}">
                        </div>
                        <div class="form-group mb-0">
                            <label class="form-label text-sm">Deskripsi</label>
                            <textarea name="pengaturan[keunggulan_1_desc]" class="form-control text-sm" rows="3">{{ $pengaturan['keunggulan_1_desc'] ?? '' }}</textarea>
                        </div>
                    </div>
                    
                    <!-- Keunggulan 2 -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <h4 class="font-bold text-center mb-3">Kolom 2</h4>
                        <div class="form-group">
                            <label class="form-label text-sm">Judul</label>
                            <input type="text" name="pengaturan[keunggulan_2]" class="form-control text-sm" value="{{ $pengaturan['keunggulan_2'] ?? '' }}">
                        </div>
                        <div class="form-group mb-0">
                            <label class="form-label text-sm">Deskripsi</label>
                            <textarea name="pengaturan[keunggulan_2_desc]" class="form-control text-sm" rows="3">{{ $pengaturan['keunggulan_2_desc'] ?? '' }}</textarea>
                        </div>
                    </div>

                    <!-- Keunggulan 3 -->
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <h4 class="font-bold text-center mb-3">Kolom 3</h4>
                        <div class="form-group">
                            <label class="form-label text-sm">Judul</label>
                            <input type="text" name="pengaturan[keunggulan_3]" class="form-control text-sm" value="{{ $pengaturan['keunggulan_3'] ?? '' }}">
                        </div>
                        <div class="form-group mb-0">
                            <label class="form-label text-sm">Deskripsi</label>
                            <textarea name="pengaturan[keunggulan_3_desc]" class="form-control text-sm" rows="3">{{ $pengaturan['keunggulan_3_desc'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-right mb-12">
            <button type="submit" class="btn btn-primary btn-lg shadow-lg">
                <i class="fas fa-save"></i> Simpan Semua Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
