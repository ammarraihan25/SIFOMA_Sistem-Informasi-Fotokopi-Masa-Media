<?php

namespace Database\Seeders;

use App\Models\Pesanan;
use App\Models\PesananItem;
use App\Models\Layanan;
use Illuminate\Database\Seeder;

class PesananSeeder extends Seeder
{
    public function run(): void
    {
        $layanans = Layanan::all();

        $pesananData = [
            [
                'kode_pesanan' => 'MM-' . date('Ymd') . '-0001',
                'nama_pelanggan' => 'Budi Santoso',
                'no_telepon' => '081234567001',
                'catatan' => 'Jilid hardcover warna biru',
                'status' => 'proses',
                'items' => [
                    ['nama' => 'Print Hitam Putih A4', 'jumlah' => 120, 'keterangan' => 'Skripsi 120 halaman'],
                    ['nama' => 'Jilid Hardcover', 'jumlah' => 3, 'keterangan' => '3 eksemplar'],
                ],
            ],
            [
                'kode_pesanan' => 'MM-' . date('Ymd') . '-0002',
                'nama_pelanggan' => 'Siti Rahayu',
                'no_telepon' => '081234567002',
                'catatan' => null,
                'status' => 'antre',
                'items' => [
                    ['nama' => 'Fotokopi HVS A4', 'jumlah' => 200, 'keterangan' => 'Materi seminar'],
                    ['nama' => 'Jilid Spiral', 'jumlah' => 5, 'keterangan' => null],
                ],
            ],
            [
                'kode_pesanan' => 'MM-' . date('Ymd') . '-0003',
                'nama_pelanggan' => 'Ahmad Fauzi',
                'no_telepon' => '081234567003',
                'catatan' => 'Ambil besok pagi',
                'status' => 'selesai',
                'items' => [
                    ['nama' => 'Print Warna A4', 'jumlah' => 10, 'keterangan' => 'Poster A4'],
                    ['nama' => 'Laminating A4', 'jumlah' => 10, 'keterangan' => null],
                ],
            ],
        ];

        foreach ($pesananData as $data) {
            $totalBiaya = 0;
            $items = [];

            foreach ($data['items'] as $itemData) {
                $layanan = $layanans->where('nama', $itemData['nama'])->first();
                if ($layanan) {
                    $subtotal = $layanan->harga * $itemData['jumlah'];
                    $totalBiaya += $subtotal;
                    $items[] = [
                        'layanan_id' => $layanan->id,
                        'keterangan' => $itemData['keterangan'],
                        'jumlah' => $itemData['jumlah'],
                        'harga_satuan' => $layanan->harga,
                        'subtotal' => $subtotal,
                    ];
                }
            }

            $pesanan = Pesanan::updateOrCreate(
                ['kode_pesanan' => $data['kode_pesanan']],
                [
                    'nama_pelanggan' => $data['nama_pelanggan'],
                    'no_telepon' => $data['no_telepon'],
                    'catatan' => $data['catatan'],
                    'status' => $data['status'],
                    'total_biaya' => $totalBiaya,
                ]
            );

            $pesanan->items()->delete();
            foreach ($items as $item) {
                $pesanan->items()->create($item);
            }
        }
    }
}
