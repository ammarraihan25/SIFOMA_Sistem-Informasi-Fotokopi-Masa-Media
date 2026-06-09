<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'nama_toko' => 'Fotokopi Masa Media',
            'tagline' => 'Cepat, Rapi, Terpercaya',
            'alamat' => 'Jl. Contoh Alamat No. 123, Kecamatan, Kota, Provinsi',
            'telepon' => '081234567890',
            'whatsapp' => '6281234567890',
            'email' => 'info@masamedia.com',
            'jam_buka' => 'Senin - Sabtu: 07.00 - 22.00 WIB',
            'jam_buka_detail' => 'Minggu: 08.00 - 20.00 WIB',
            'google_maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0!2d106.8!3d-6.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMDAuMCJTIDEwNsKwNDgnMDAuMCJF!5e0!3m2!1sid!2sid!4v1600000000000!5m2!1sid!2sid',
            'deskripsi_singkat' => 'Fotokopi Masa Media adalah pusat layanan cetak, fotokopi, dan jilid terlengkap. Melayani mahasiswa, instansi, dan umum dengan kualitas terbaik dan harga terjangkau.',
            'sejarah' => 'Fotokopi Masa Media berdiri sejak tahun 2010 dengan komitmen memberikan pelayanan cetak dan fotokopi terbaik. Berawal dari usaha kecil, kini kami telah melayani ribuan pelanggan dengan peralatan modern dan tenaga profesional.',
            'keunggulan_1' => 'Mesin Berteknologi Tinggi',
            'keunggulan_1_desc' => 'Menggunakan mesin fotokopi dan printer terbaru untuk hasil yang tajam dan konsisten.',
            'keunggulan_2' => 'Pengerjaan Kilat',
            'keunggulan_2_desc' => 'Pesanan reguler selesai dalam hitungan menit, partai besar diproses dengan cepat.',
            'keunggulan_3' => 'Harga Bersahabat',
            'keunggulan_3_desc' => 'Harga kompetitif dengan kualitas premium, tersedia diskon untuk mahasiswa dan partai besar.',
            'instagram' => 'https://instagram.com/masamedia',
            'facebook' => 'https://facebook.com/masamedia',
        ];

        foreach ($settings as $key => $value) {
            Pengaturan::setValue($key, $value);
        }
    }
}
