<?php

namespace Database\Seeders;

use App\Models\KategoriLayanan;
use Illuminate\Database\Seeder;

class KategoriLayananSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            ['nama' => 'Print', 'slug' => 'print', 'icon' => 'fas fa-print', 'urutan' => 1],
            ['nama' => 'Fotokopi', 'slug' => 'fotokopi', 'icon' => 'fas fa-copy', 'urutan' => 2],
            ['nama' => 'Jilid', 'slug' => 'jilid', 'icon' => 'fas fa-book', 'urutan' => 3],
            ['nama' => 'Laminating', 'slug' => 'laminating', 'icon' => 'fas fa-layer-group', 'urutan' => 4],
            ['nama' => 'ATK', 'slug' => 'atk', 'icon' => 'fas fa-pen', 'urutan' => 5],
        ];

        foreach ($kategoris as $kategori) {
            KategoriLayanan::updateOrCreate(['slug' => $kategori['slug']], $kategori);
        }
    }
}
