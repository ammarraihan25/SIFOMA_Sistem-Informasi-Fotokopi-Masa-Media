@extends('layouts.app')

@section('title', 'Cek Status Pesanan')

@section('content')
<section class="py-12 md:py-20 bg-main min-h-[70vh] flex items-center">
    <div class="container">
        <div class="max-w-xl mx-auto">
            <div class="text-center mb-8 animate-on-scroll">
                <div class="w-20 h-20 bg-primary-light text-primary rounded-full flex items-center justify-center text-3xl mx-auto mb-6">
                    <i class="fas fa-search-location"></i>
                </div>
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Lacak Pesanan Anda</h1>
                <p class="text-muted">Masukkan Kode Pesanan (No. Nota) untuk mengetahui status pengerjaan secara real-time.</p>
            </div>
            
            <div class="card p-8 shadow-lg animate-on-scroll" style="animation-delay: 0.2s;">
                <form action="{{ route('pesanan.cek.post') }}" method="POST">
                    @csrf
                    <div class="form-group mb-6">
                        <label for="kode_pesanan" class="form-label text-lg">Kode Pesanan</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fas fa-receipt text-gray-400"></i>
                            </div>
                            <input type="text" 
                                   name="kode_pesanan" 
                                   id="kode_pesanan" 
                                   class="form-control pl-12 py-4 text-lg font-bold tracking-wider uppercase" 
                                   placeholder="MM-YYYYMMDD-XXXX" 
                                   value="{{ old('kode_pesanan') }}"
                                   required 
                                   autofocus>
                        </div>
                        <p class="text-sm text-muted mt-2"><i class="fas fa-info-circle"></i> Kode pesanan dapat ditemukan pada nota fisik atau struk digital Anda.</p>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i class="fas fa-search"></i> Cek Status Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
