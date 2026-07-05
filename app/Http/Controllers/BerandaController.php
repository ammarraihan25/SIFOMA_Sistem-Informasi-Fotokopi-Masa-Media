<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Pengaturan;
use App\Models\KategoriLayanan;

class BerandaController extends Controller
{
    public function index()
    {
        $kategoris = KategoriLayanan::with(['layanans' => function($q) {
            $q->where('is_active', true)->limit(3);
        }])->orderBy('urutan')->get();

        $promos = Promo::active()->latest()->take(3)->get();
        $portofolios = \App\Models\Portofolio::active()->latest()->take(8)->get();

        $pengaturan = Pengaturan::pluck('value', 'key');

        return view('public.beranda', compact('kategoris', 'promos', 'pengaturan', 'portofolios'));
    }
}
