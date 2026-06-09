<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        $promos = [
            [
                'judul' => 'Diskon Mahasiswa 10%',
                'deskripsi' => 'Tunjukkan KTM (Kartu Tanda Mahasiswa) dan dapatkan diskon 10% untuk semua layanan print dan fotokopi. Berlaku untuk semua universitas!',
                'diskon_persen' => 10,
                'tanggal_mulai' => now()->subDays(30)->toDateString(),
                'tanggal_selesai' => now()->addMonths(3)->toDateString(),
                'is_active' => true,
            ],
            [
                'judul' => 'Paket Jilid Skripsi Hemat',
                'deskripsi' => 'Paket print + jilid hardcover 3 eksemplar hanya Rp 150.000. Sudah termasuk print dan jilid hardcover warna. Cocok untuk sidang skripsi!',
                'diskon_persen' => null,
                'tanggal_mulai' => now()->subDays(10)->toDateString(),
                'tanggal_selesai' => now()->addMonths(6)->toDateString(),
                'is_active' => true,
            ],
            [
                'judul' => 'Gratis Laminating untuk Print 50+ Lembar',
                'deskripsi' => 'Setiap print minimal 50 lembar, dapatkan gratis laminating 1 lembar A4. Berlaku untuk print warna maupun hitam putih.',
                'diskon_persen' => null,
                'tanggal_mulai' => now()->toDateString(),
                'tanggal_selesai' => now()->addMonth()->toDateString(),
                'is_active' => true,
            ],
        ];

        foreach ($promos as $promo) {
            Promo::updateOrCreate(['judul' => $promo['judul']], $promo);
        }
    }
}
