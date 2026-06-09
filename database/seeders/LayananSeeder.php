<?php

namespace Database\Seeders;

use App\Models\KategoriLayanan;
use App\Models\Layanan;
use Illuminate\Database\Seeder;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $print = KategoriLayanan::where('slug', 'print')->first();
        $fotokopi = KategoriLayanan::where('slug', 'fotokopi')->first();
        $jilid = KategoriLayanan::where('slug', 'jilid')->first();
        $laminating = KategoriLayanan::where('slug', 'laminating')->first();
        $atk = KategoriLayanan::where('slug', 'atk')->first();

        $layanans = [
            // Print
            ['kategori_layanan_id' => $print->id, 'nama' => 'Print Hitam Putih A4', 'harga' => 500, 'satuan' => 'lembar', 'deskripsi' => 'Print dokumen hitam putih kertas A4 70gsm'],
            ['kategori_layanan_id' => $print->id, 'nama' => 'Print Hitam Putih F4/Folio', 'harga' => 600, 'satuan' => 'lembar', 'deskripsi' => 'Print dokumen hitam putih kertas F4'],
            ['kategori_layanan_id' => $print->id, 'nama' => 'Print Warna A4', 'harga' => 1500, 'satuan' => 'lembar', 'deskripsi' => 'Print dokumen berwarna kertas A4'],
            ['kategori_layanan_id' => $print->id, 'nama' => 'Print Warna F4/Folio', 'harga' => 2000, 'satuan' => 'lembar', 'deskripsi' => 'Print dokumen berwarna kertas F4'],
            ['kategori_layanan_id' => $print->id, 'nama' => 'Print Foto A4', 'harga' => 8000, 'satuan' => 'lembar', 'deskripsi' => 'Cetak foto kualitas tinggi ukuran A4'],
            ['kategori_layanan_id' => $print->id, 'nama' => 'Print Foto 3x4 / 4x6', 'harga' => 5000, 'satuan' => 'lembar', 'deskripsi' => 'Cetak pas foto'],
            ['kategori_layanan_id' => $print->id, 'nama' => 'Print Banner A3', 'harga' => 15000, 'satuan' => 'lembar', 'deskripsi' => 'Cetak banner ukuran A3'],

            // Fotokopi
            ['kategori_layanan_id' => $fotokopi->id, 'nama' => 'Fotokopi HVS A4', 'harga' => 200, 'satuan' => 'lembar', 'deskripsi' => 'Fotokopi hitam putih kertas HVS A4'],
            ['kategori_layanan_id' => $fotokopi->id, 'nama' => 'Fotokopi HVS F4/Folio', 'harga' => 250, 'satuan' => 'lembar', 'deskripsi' => 'Fotokopi hitam putih kertas HVS F4'],
            ['kategori_layanan_id' => $fotokopi->id, 'nama' => 'Fotokopi A3', 'harga' => 500, 'satuan' => 'lembar', 'deskripsi' => 'Fotokopi hitam putih kertas A3'],
            ['kategori_layanan_id' => $fotokopi->id, 'nama' => 'Fotokopi Warna A4', 'harga' => 1000, 'satuan' => 'lembar', 'deskripsi' => 'Fotokopi berwarna kertas A4'],
            ['kategori_layanan_id' => $fotokopi->id, 'nama' => 'Fotokopi Bolak-Balik A4', 'harga' => 350, 'satuan' => 'lembar', 'deskripsi' => 'Fotokopi dua sisi kertas A4'],

            // Jilid
            ['kategori_layanan_id' => $jilid->id, 'nama' => 'Jilid Softcover', 'harga' => 15000, 'satuan' => 'buku', 'deskripsi' => 'Jilid softcover untuk laporan, makalah'],
            ['kategori_layanan_id' => $jilid->id, 'nama' => 'Jilid Hardcover', 'harga' => 35000, 'satuan' => 'buku', 'deskripsi' => 'Jilid hardcover untuk skripsi, tesis'],
            ['kategori_layanan_id' => $jilid->id, 'nama' => 'Jilid Spiral', 'harga' => 8000, 'satuan' => 'buku', 'deskripsi' => 'Jilid spiral kawat plastik'],
            ['kategori_layanan_id' => $jilid->id, 'nama' => 'Jilid Lakban', 'harga' => 5000, 'satuan' => 'buku', 'deskripsi' => 'Jilid lakban sederhana'],

            // Laminating
            ['kategori_layanan_id' => $laminating->id, 'nama' => 'Laminating A4', 'harga' => 3000, 'satuan' => 'lembar', 'deskripsi' => 'Laminating dokumen ukuran A4'],
            ['kategori_layanan_id' => $laminating->id, 'nama' => 'Laminating F4', 'harga' => 4000, 'satuan' => 'lembar', 'deskripsi' => 'Laminating dokumen ukuran F4'],
            ['kategori_layanan_id' => $laminating->id, 'nama' => 'Laminating KTP/ID Card', 'harga' => 2000, 'satuan' => 'lembar', 'deskripsi' => 'Laminating ukuran kecil KTP'],

            // ATK
            ['kategori_layanan_id' => $atk->id, 'nama' => 'Map Plastik', 'harga' => 2000, 'satuan' => 'buah', 'deskripsi' => 'Map plastik bening'],
            ['kategori_layanan_id' => $atk->id, 'nama' => 'Amplop Coklat Besar', 'harga' => 2500, 'satuan' => 'buah', 'deskripsi' => 'Amplop coklat ukuran besar'],
            ['kategori_layanan_id' => $atk->id, 'nama' => 'Kertas HVS A4 (rim)', 'harga' => 55000, 'satuan' => 'rim', 'deskripsi' => 'Kertas HVS A4 80gsm 1 rim (500 lembar)'],
            ['kategori_layanan_id' => $atk->id, 'nama' => 'Materai 10000', 'harga' => 12000, 'satuan' => 'buah', 'deskripsi' => 'Materai tempel 10.000'],
        ];

        foreach ($layanans as $layanan) {
            Layanan::updateOrCreate(
                ['nama' => $layanan['nama'], 'kategori_layanan_id' => $layanan['kategori_layanan_id']],
                $layanan
            );
        }
    }
}
