<?php

namespace App\Http\Controllers;

use App\Models\KategoriLayanan;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index(Request $request)
    {
        $kategoris = KategoriLayanan::orderBy('urutan')->get();

        $query = Layanan::with('kategori')->where('is_active', true);

        if ($request->filled('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        if ($request->filled('cari')) {
            $query->where('nama', 'like', '%' . $request->cari . '%');
        }

        $layanans = $query->orderBy('kategori_layanan_id')->orderBy('nama')->get()->groupBy('kategori_layanan_id');

        return view('public.layanan', compact('kategoris', 'layanans'));
    }
}
