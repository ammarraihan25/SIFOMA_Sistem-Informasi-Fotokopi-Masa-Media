<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesanan;
use App\Models\Layanan;
use App\Models\Promo;
use App\Models\Portofolio;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPesananHariIni = Pesanan::whereDate('created_at', today())->count();
        $pesananProses = Pesanan::where('status', 'proses')->count();
        $pesananAntre = Pesanan::where('status', 'antre')->count();
        $totalLayanan = Layanan::where('is_active', true)->count();
        $promoAktif = Promo::active()->count();
        $totalPortofolio = Portofolio::active()->count();

        $pesananTerbaru = Pesanan::with('items.layanan')
            ->latest()
            ->take(10)
            ->get();

        // Stats for last 7 days
        $pesananPerHari = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $pesananPerHari[] = [
                'tanggal' => $date->format('d M'),
                'jumlah' => Pesanan::whereDate('created_at', $date)->count(),
            ];
        }

        $pendapatanHariIni = Pesanan::whereDate('created_at', today())
            ->whereIn('status', ['selesai', 'diambil'])
            ->sum('total_biaya');

        return view('admin.dashboard', compact(
            'totalPesananHariIni',
            'pesananProses',
            'pesananAntre',
            'totalLayanan',
            'promoAktif',
            'totalPortofolio',
            'pesananTerbaru',
            'pesananPerHari',
            'pendapatanHariIni'
        ));
    }
}
