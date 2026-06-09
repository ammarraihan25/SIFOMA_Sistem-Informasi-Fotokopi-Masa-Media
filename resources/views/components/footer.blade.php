<footer class="footer">
    <div class="container">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-1 md:col-span-2">
                <a href="{{ route('beranda') }}" class="nav-brand mb-4 text-white">
                    <i class="fas fa-print"></i>
                    {{ \App\Models\Pengaturan::getValue('nama_toko', 'SIFOMA') }}
                </a>
                <p class="mb-4 text-muted" style="max-width: 400px;">
                    {{ \App\Models\Pengaturan::getValue('deskripsi_singkat', 'Layanan fotokopi dan percetakan profesional.') }}
                </p>
                <div class="flex gap-4">
                    @if($fb = \App\Models\Pengaturan::getValue('facebook'))
                        <a href="{{ $fb }}" target="_blank" rel="noopener" class="text-2xl"><i class="fab fa-facebook"></i></a>
                    @endif
                    @if($ig = \App\Models\Pengaturan::getValue('instagram'))
                        <a href="{{ $ig }}" target="_blank" rel="noopener" class="text-2xl"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if($wa = \App\Models\Pengaturan::getValue('whatsapp'))
                        <a href="https://wa.me/{{ $wa }}" target="_blank" rel="noopener" class="text-2xl"><i class="fab fa-whatsapp"></i></a>
                    @endif
                </div>
            </div>
            
            <div>
                <h3>Tautan Cepat</h3>
                <ul class="flex flex-col gap-2">
                    <li><a href="{{ route('layanan') }}">Daftar Layanan & Harga</a></li>
                    <li><a href="{{ route('pesanan.cek') }}">Cek Status Pesanan</a></li>
                    <li><a href="{{ route('promo') }}">Promo Terbaru</a></li>
                    <li><a href="{{ route('tentang-kami') }}">Tentang Kami</a></li>
                </ul>
            </div>
            
            <div>
                <h3>Kontak Kami</h3>
                <ul class="flex flex-col gap-4">
                    <li class="flex gap-2 items-start">
                        <i class="fas fa-map-marker-alt mt-1"></i>
                        <span>{{ \App\Models\Pengaturan::getValue('alamat', 'Alamat belum diatur') }}</span>
                    </li>
                    <li class="flex gap-2 items-center">
                        <i class="fas fa-phone"></i>
                        <span>{{ \App\Models\Pengaturan::getValue('telepon', '-') }}</span>
                    </li>
                    <li class="flex gap-2 items-start">
                        <i class="fas fa-clock mt-1"></i>
                        <div>
                            <div>{{ \App\Models\Pengaturan::getValue('jam_buka', '-') }}</div>
                            <div class="text-sm">{{ \App\Models\Pengaturan::getValue('jam_buka_detail', '') }}</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ \App\Models\Pengaturan::getValue('nama_toko', 'SIFOMA') }}. All rights reserved.</p>
        </div>
    </div>
</footer>
